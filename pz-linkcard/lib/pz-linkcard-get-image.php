<?php defined('ABSPATH' ) || wp_die; ?>
<?php

	if	(!isset($thumbnail_url ) || !$thumbnail_url || $thumbnail_url == 'https://s0.wp.com/i/blank.jpg' ) {
		return	null;
	}

	// サムネイルのディレクトリとディレクトリURL
	$file_dir		=	PZLKC_DIR_CACHE;
	$file_dir_url	=	PZLKC_URL_CACHE;
	if	(!$file_dir || !$file_dir_url ) {
		return			null;
	}

	// 画像URLを元にしてファイル名を生成
	$file_name		=	bin2hex(hash('sha256', esc_url($thumbnail_url ), true ) );	// ファイル名（URLをハッシュしてファイル名にする）
	$file_path_webp	=	$file_dir.$file_name.'.webp';					    		// ファイルのフルパス
	$file_path_jpeg	=	$file_dir.$file_name.'.jpeg';					    		// ファイルのフルパス（旧バージョン）
	$file_url   	=	$file_dir_url.$file_name.'.webp';				       		// 画像URL

	// 旧バージョンのJPEGファイルをWebPに変換
	if	(file_exists($file_path_jpeg ) ) {										// ファイルが見つかった（拡張子あり）
		$file_time_jpeg	=	filemtime($file_path_jpeg );						// 旧JPEGファイルのタイムスタンプ
		if	(function_exists('imagewebp' ) ) {
			$image_jpeg	=	@imagecreatefromjpeg($file_path_jpeg );		    	// JPEG画像読み込み
			if	($image_jpeg ) {
				$result_jpeg	=	imagewebp($image_jpeg, $file_path_webp );	// WebPで保存
				imagedestroy($image_jpeg );
				if	($result_jpeg && file_exists($file_path_webp ) && filesize($file_path_webp ) >= 12 ) {
					touch($file_path_webp, $file_time_jpeg );						// 旧JPEGファイルのタイムスタンプを引き継ぐ
					unlink($file_path_jpeg );									// 変換できたJPEGファイルを削除
				}
			} else {
				unlink($file_path_jpeg );   									// 変換できたJPEGファイルを削除
			}
		}
	}

	// ファイル名が見つかったときの処理
	if	(!$force ) {		// 強制取得の指定なし
		if	(file_exists	($file_path_webp ) ) {							// ファイルが見つかった（拡張子あり）
			if	(filesize($file_path_webp ) < 12 ) {						// WebPのヘッダが12バイトなので、それ未満は取得できていないファイル
				return	null;
			}
			if	($stamp === true ) {
				$file_url	.=	'?'.date('yyyymmdd-his', filemtime($file_path_webp ) );	// ファイルスタンプ
			}
			return		$file_url;
		}
	}

	// cURLで画像取得
	$ch			=	curl_init();
	curl_setopt($ch, CURLOPT_URL, $thumbnail_url );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );		// リダイレクトを処理する
	curl_setopt($ch, CURLOPT_MAXREDIRS, 8 );				// リダイレクトを処理する階層
	curl_setopt($ch, CURLOPT_AUTOREFERER, true );			// リダイレクト用リファラを自動セット

	curl_setopt($ch, CURLOPT_TIMEOUT, 10 );
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3 );
	$body		=	curl_exec($ch );
	$header		=	curl_getinfo($ch );
	curl_close($ch );
	if	($header['http_code']	>=	400 ) {					// 指定されたURLの画像が存在しない
		touch($file_path_webp );							// 空ファイル作成
		return	null;
	}

	// 画像生成
	$image			=	@imagecreatefromstring($body );		// 画像読み込み
	if	($image		===	false ) {
		touch($file_path_webp );							// 空ファイル作成
		return	null;
	}

	$image_width	=	@imagesx($image );					// 画像の横
	$image_height	=	@imagesy($image );					// 画像の縦
	if	($image_width === false || $image_height === false || $image_width < 8 || $image_height < 8 ) {		// 8x8未満は画像ではないと見なす
		touch($file_path_webp );							// 空ファイル作成
		return	null;
	}

	// 変換後の画像サイズ
	switch	($this->options['ex-thumbnail-size']) {
	case	'thumbnail':
		$new_width	=	150;	// 幅
		$new_height	=	150;	// 高さ
		break;
	case	'medium':
		$new_width	=	300;
		$new_height	=	300;
		break;
	case	'large':
		$new_width	=	1024;
		$new_height	=	1024;
		break;
	case	'full':
		$new_width	=	$image_width;
		$new_height	=	$image_height;
		break;
	default:
		$new_width	=	150;
		$new_height	=	150;
		break;
	}

	// 縦横比を保つ
	if			($image_width > $image_height ) {									// 幅の方が大きい
		$new_height	=	intval($image_height * ($new_width  / $image_width ) );		// 幅に合わせる
	} elseif	($image_width < $image_height ) {									// 高さの方が大きい
		$new_width	=	intval($image_width  * ($new_height / $image_height ) );	// 高さに合わせる
	}
	if	($new_width <= 1 || $new_height <= 1 ) {
		touch($file_path_webp );													// 空ファイル作成
		return	null;
	}

	// パレットを用意
	if	(!function_exists('imagewebp' ) ) {
		touch($file_path_webp );													// 空ファイル作成
		return	null;
	}
	$image_pallet	=	imagecreatetruecolor($new_width, $new_height );
	if	(!$image_pallet ) {
		touch($file_path_webp );													// 空ファイル作成
		return	null;
	}
	// 画像ファイルを保存
	imagealphablending($image_pallet, false );							    		// アルファチャンネルを保持する
	imagesavealpha($image_pallet, true );
	$image_pallet_bg	=	imagecolorallocatealpha($image_pallet, 0, 0, 0, 127 );	// 背景色を透明に設定
	imagefill($image_pallet, 0, 0, $image_pallet_bg );
	imagecopyresampled($image_pallet, $image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height );	// サイズ変更してコピー
	if	(!imagewebp($image_pallet, $file_path_webp ) ) {							// WebPで保存
		touch($file_path_webp );										    		// 空ファイル作成
		return	null;
	}

	if	($stamp === true ) {
		$file_url	.=	'?'.date('yyyymmdd-his', filemtime($file_path_webp ) );		// ファイルスタンプ
	}
	return	$file_url;																// 画像URLを返す
