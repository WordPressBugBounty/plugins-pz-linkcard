<?php defined('ABSPATH' ) || wp_die; ?>
<?php

	if	(!isset($thumbnail_url ) || !$thumbnail_url || $thumbnail_url == 'https://s0.wp.com/i/blank.jpg' ) {
		return	null;
	}

	// Thumbnail cache directory and URL.
	$file_dir		=	PZLKC_DIR_CACHE;
	$file_dir_url	=	PZLKC_URL_CACHE;
	if	(!$file_dir || !$file_dir_url ) {
		return			null;
	}

	// Generate a stable cache filename from the image URL.
	$file_name		=	bin2hex(hash('sha256', esc_url($thumbnail_url ), true ) );
	$file_path_webp	=	$file_dir.$file_name.'.webp';
	$file_path_jpeg	=	$file_dir.$file_name.'.jpeg';
	$file_url   	=	$file_dir_url.$file_name.'.webp';

	// Convert old JPEG cache files to WebP.
	if	(file_exists($file_path_jpeg ) ) {
		$file_time_jpeg	=	filemtime($file_path_jpeg );
		if	(function_exists('imagewebp' ) ) {
			$image_jpeg	=	@imagecreatefromjpeg($file_path_jpeg );
			if	($image_jpeg ) {
				$result_jpeg	=	imagewebp($image_jpeg, $file_path_webp );
				imagedestroy($image_jpeg );
				if	($result_jpeg && file_exists($file_path_webp ) && filesize($file_path_webp ) >= 12 ) {
					touch($file_path_webp, $file_time_jpeg );
					unlink($file_path_jpeg );
				}
			} else {
				unlink($file_path_jpeg );
			}
		}
	}

	// Use cached file when available.
	if	(!$force ) {
		if	(file_exists($file_path_webp ) ) {
			if	(filesize($file_path_webp ) < 12 ) {
				return	null;
			}
			if	($stamp === true ) {
				$file_url	.=	'?'.date('yyyymmdd-his', filemtime($file_path_webp ) );
			}
			return		$file_url;
		}
	}

	// Fetch image through WordPress HTTP API with safe URL checks.
	$thumbnail_url	=	$this->pz_EncodeURL($thumbnail_url, true );
	if	($this->pz_IsLocalAddress($thumbnail_url ) ) {
		touch($file_path_webp );
		return	null;
	}

	global	$wp_version;
	$rget_args							=	array();
	$rget_args['timeout']				=	10;
	$rget_args['redirection']			=	$this->options['flg-redir']		?	8		:	0;
	$rget_args['limit_response_size']	=	defined('MB_IN_BYTES' ) ? MB_IN_BYTES * 5 : 5242880;
	$rget_args['user-agent']			=	$this->options['flg-agent']		?	$this->options['user-agent']
																						:	'WordPress/'.$wp_version.'; '.get_bloginfo('url' );
	$rget_args['sslverify']				=	$this->options['flg-ssl']		?	false	:	true ;

	$rget_data	=	wp_safe_remote_get($thumbnail_url, $rget_args );
	if	(is_wp_error($rget_data ) ) {
		touch($file_path_webp );
		return	null;
	}

	$http_code	=	intval(wp_remote_retrieve_response_code($rget_data ) );
	$body		=	wp_remote_retrieve_body($rget_data );
	if	($http_code >= 400 || !$body ) {
		touch($file_path_webp );
		return	null;
	}

	// Decode fetched image.
	$image			=	@imagecreatefromstring($body );
	if	($image		===	false ) {
		touch($file_path_webp );
		return	null;
	}

	$image_width	=	@imagesx($image );
	$image_height	=	@imagesy($image );
	if	($image_width === false || $image_height === false || $image_width < 8 || $image_height < 8 ) {
		touch($file_path_webp );
		return	null;
	}

	// Resize to configured maximum.
	switch	($this->options['ex-thumbnail-size']) {
	case	'thumbnail':
		$new_width	=	150;
		$new_height	=	150;
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

	// Preserve aspect ratio.
	if			($image_width > $image_height ) {
		$new_height	=	intval($image_height * ($new_width  / $image_width ) );
	} elseif	($image_width < $image_height ) {
		$new_width	=	intval($image_width  * ($new_height / $image_height ) );
	}
	if	($new_width <= 1 || $new_height <= 1 ) {
		touch($file_path_webp );
		return	null;
	}

	if	(!function_exists('imagewebp' ) ) {
		touch($file_path_webp );
		return	null;
	}
	$image_pallet	=	imagecreatetruecolor($new_width, $new_height );
	if	(!$image_pallet ) {
		touch($file_path_webp );
		return	null;
	}

	imagealphablending($image_pallet, false );
	imagesavealpha($image_pallet, true );
	$image_pallet_bg	=	imagecolorallocatealpha($image_pallet, 0, 0, 0, 127 );
	imagefill($image_pallet, 0, 0, $image_pallet_bg );
	imagecopyresampled($image_pallet, $image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height );
	if	(!imagewebp($image_pallet, $file_path_webp ) ) {
		touch($file_path_webp );
		return	null;
	}

	if	($stamp === true ) {
		$file_url	.=	'?'.date('yyyymmdd-his', filemtime($file_path_webp ) );
	}
	return	$file_url;
