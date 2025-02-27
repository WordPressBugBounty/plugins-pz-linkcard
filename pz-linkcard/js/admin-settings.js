(function() {
	// Pz-LinkCardの設定画面のときのみ動作
	if	(jQuery('.pz-dashboard').is('*') ) {
		// WordPress標準のカラーピッカー
		// jQuery('.wp-color-picker').wpColorPicker();
		jQuery('.pz-wp-color-picker').wpColorPicker();

		// スクロール位置の調整
		jQuery(window).scrollTop(jQuery('input[name="scroll-now"]').val());
	}

	// 画面表示された時に実行
	jQuery(window).load(function() {

		if	(jQuery('.pz-dashboard').is('*') ) {
			jQuery('#pz-overlay-proc').hide();

			// 項目の有効化／無効化
			var rs = switch_enabled();

			// 一番上に行くボタンをクリック
			jQuery('.pz-button-top').on('click', button_top_click);

			// 一番上に行くボタンをスクロール位置で「TOP」ボタンを表示／非表示
			jQuery(window).scroll(top_button_scroll);

			// イベント：ショートコードをコピーする
			jQuery('.pz-shortcode-1').on('keyup', copy_shortcode);

			// イベント：ショートコードの入力チェック
			jQuery('input[name="properties[code1]"]:text').on('keydown', check_shortcode_key);
			jQuery('input[name="properties[code2]"]:text').on('keydown', check_shortcode_key);
			jQuery('input[name="properties[code3]"]:text').on('keydown', check_shortcode_key);
			jQuery('input[name="properties[code4]"]:text').on('keydown', check_shortcode_key);

			// イベント：カラーピッカーとテキストボックスの同期
			jQuery('.pz-sync-text').on('keyup change', sync_color);

			// イベント：すべてのWP-Cronスケジュールを表示する
			jQuery('.pz-cron-all').on('change', show_all_cron);

			// submitをクリックしたら
			jQuery('form').submit( function() {
				jQuery('input[name="scroll-now"]').val(jQuery(window).scrollTop());
				if	(jQuery('input[name="properties[flg-inhibit]"]:checkbox').prop('checked') == true) {
					jQuery('#pz-overlay-proc').show();
				}
			});

			// クリックしたらテキスト全選択
			jQuery('.pz-click-all-select').on('click', all_select);

			// イベント：ReadOnlyになったチェックボックスを動作させなくする
			jQuery('input:checkbox').on('click', checkbox_readonly);

			// 自動変換のチェックが入っているときだけ、オプション設定を有効化
			jQuery('.pz-sync-check,.pz-show').on('change', switch_enabled);

			// 設定画面＆管理画面
			//if	(jQuery('.pz-man-count-list').is('*') != false) {
			//	// イベント：カラーピッカーとテキストボックスの同期
			//	jQuery('.pz-sync-text').on('keyup change', sync_color);
			//}

			// 画面表示する
			jQuery('#pz-overlay-proc').hide();
		}
	});

	// スクロールしていた位置
	function to_scroll() {
		var pos_y = jQuery('input[name="scroll-now"]').val();
		jQuery(window).scrollTop(pos_y);
	}

	// textarea で Tab 入力
	function textarea_ex(e) {
		if	(e.key == 'Tab' && !e.shiftKey && !e.ctrlKey && !e.altKey) {
			e.preventDefault();
			document.execCommand('insertText', false, '\t');
		}
	}

	// 一番上へ行くボタンをクリック
	function button_top_click() {
		jQuery('body, html').animate({ scrollTop: 0 }, 200);
		return false;
	}

	// 一番上へ行くボタンの表示・非表示
	function top_button_scroll() {
		if	(jQuery(window).scrollTop() > 80) {
			jQuery('.pz-button-top').fadeIn('slow');
		} else {
			jQuery('.pz-button-top').fadeOut('slow');
		}
	}

	// 特定の項目の値によって、連動する項目を有効化／無効化する
	function switch_enabled() {
		// 記事取得方法によってカスタムフィールドを有効／無効
		if	(jQuery('select[name="properties[in-get]"]').val() == 3) {
			var flags = false;
		} else {
			var flags = true;
		}
		jQuery('input[name="properties[in-field-title]"]').prop('disabled', flags);
		jQuery('input[name="properties[in-field-excerpt]"]').prop('disabled', flags);
		
		// 外部サイト・サムネイル選択によって、サムネイルサイズを有効／無効
		if	(jQuery('select[name="properties[ex-thumbnail]"]').val() == 1 || jQuery('select[name="properties[ex-thumbnail]"]').val() == 13) {
			var flags = false;
		} else {
			var flags = true;
		}
		jQuery('select[name="properties[ex-thumbnail-size]"]').prop('disabled', flags);
		
		// 内部サイト・サムネイル選択によって、サムネイルサイズを有効／無効
		if	(jQuery('select[name="properties[in-thumbnail]"]').val() == 1 || jQuery('select[name="properties[in-thumbnail]"]').val() == 13) {
			var flags = false;
		} else {
			var flags = true;
		}
		jQuery('select[name="properties[in-thumbnail-size]"]').prop('disabled', flags);
		
		// リンク検査：ユーザーエージェント使用選択によってユーザーエージェント文字列を有効／無効
		if	(jQuery('input[name="properties[flg-agent]"]:checkbox').prop('checked') == true) {
			var flags = false;
		} else {
			var flags = true;
		}
		jQuery('input[name="properties[user-agent]"]').prop('readonly', flags);
		
		// エディタまたは自動変換選択によって、外部のみとショートコード実行を有効／無効
		if	(jQuery('input[name="properties[auto-atag]"]:checkbox').prop('checked') == true  || jQuery('input[name="properties[auto-url]"]:checkbox').prop('checked') == true) {
			var flags = false;
			var color = '#444';
		} else {
			var flags = true;
			var color = '#ddd';
		}
		jQuery('input[name="properties[auto-external]"]').prop('disabled', flags);
		jQuery('input[name="properties[auto-external]"]').prop('readonly', flags);
		jQuery('input[name="properties[auto-external]"]').parent().css('color', color);
		jQuery('input[name="properties[flg-do-shortcode]"]').prop('disabled', flags);
		jQuery('input[name="properties[flg-do-shortcode]"]').prop('readonly', flags);
		jQuery('input[name="properties[flg-do-shortcode]"]').parent().css('color', color);

		// ふちどりの色（文字）
		jQuery('input[name="properties[title-outline-color]"]').prop('disabled', jQuery('input[name="properties[title-outline]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[url-outline-color]"]').prop('disabled', jQuery('input[name="properties[url-outline]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[excerpt-outline-color]"]').prop('disabled', jQuery('input[name="properties[excerpt-outline]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[date-outline-color]"]').prop('disabled', jQuery('input[name="properties[date-outline]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[info-outline-color]"]').prop('disabled', jQuery('input[name="properties[info-outline]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[added-outline-color]"]').prop('disabled', jQuery('input[name="properties[added-outline]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[heading-outline-color]"]').prop('disabled', jQuery('input[name="properties[heading-outline]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[more-outline-color]"]').prop('disabled', jQuery('input[name="properties[more-outline]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[cat-outline-color]"]').prop('disabled', jQuery('input[name="properties[cat-outline]"]:checkbox').prop('checked') == false );

		// 背景色（文字）
		jQuery('input[name="properties[title-bg-color]"]').prop('disabled', jQuery('input[name="properties[title-bg]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[url-bg-color]"]').prop('disabled', jQuery('input[name="properties[url-bg]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[excerpt-bg-color]"]').prop('disabled', jQuery('input[name="properties[excerpt-bg]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[date-bg-color]"]').prop('disabled', jQuery('input[name="properties[date-bg]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[info-bg-color]"]').prop('disabled', jQuery('input[name="properties[info-bg]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[added-bg-color]"]').prop('disabled', jQuery('input[name="properties[added-bg]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[heading-bg-color]"]').prop('disabled', jQuery('input[name="properties[heading-bg]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[more-bg-color]"]').prop('disabled', jQuery('input[name="properties[more-bg]"]:checkbox').prop('checked') == false );
		jQuery('input[name="properties[cat-bg-color]"]').prop('disabled', jQuery('input[name="properties[cat-bg]"]:checkbox').prop('checked') == false );

		// 背景色（リンク種別別）
		jQuery('input[name="properties[ex-bg-color]"]').prop('disabled', jQuery('input[name="properties[ex-bg]"]:checkbox').prop('checked') == false );
	}

	// ショートコードをコピーする
	function copy_shortcode() {
		var t = jQuery(this).val();
		jQuery('.pz-shortcode-copy').each(function() {
			jQuery(this).text(t);
			if	(t.length == 0) {
				jQuery('.pz-shortcode-enabled').prop('disabled', true);
			} else {
				jQuery('.pz-shortcode-enabled').prop('disabled', false);
			}
		})
	}

	// ショートコードの入力チェック
	function check_shortcode_key(e) {
		switch (e.keyCode) {
		case 32:						// [Space]
			return	false;
		}
	}

	// すべてのWP-Cronスケジュールを表示する
	function show_all_cron() {
		if	(jQuery(this).prop('checked') == true) {
			jQuery('.pz-cron-list-other').show();
			jQuery('.pz-cron-list-other').removeClass('pz-hide');
			jQuery('.pz-cron-list-other').addClass('pz-show');
		} else {
			jQuery('.pz-cron-list-other').hide();
			jQuery('.pz-cron-list-other').removeClass('pz-show');
			jQuery('.pz-cron-list-other').addClass('pz-hide');
		}
	}

	// カラーピッカーとテキストボックスの同期
	function sync_color() {
		var name = jQuery(this).attr('name');
		var value = jQuery(this).val();
		jQuery('input[name="' + name + '"]').each(function() {jQuery(this).val(value);});
	}

	// readonlyのチェックボックスを動作させない
	function checkbox_readonly() {
		if	(jQuery(this).prop('readonly') == true) {
			return false;
		}
	}

	// テキストを全選択
	function all_select() {
		switch (jQuery(this).prop('tagName')) {
		case 'INPUT':
			jQuery(this).select();
			break;
		case 'DIV':
			var range = document.createRange();
			range.selectNodeContents(this);
			var selection = window.getSelection();
			selection.removeAllRanges();
			selection.addRange(range);
			break;
		}
	}

})(jQuery);
