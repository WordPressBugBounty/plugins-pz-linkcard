<?php defined('ABSPATH' ) || wp_die; ?>
<div class="pz-page" id="pz-etc">
	<div class="pz-submit-float"><?php submit_button(); ?></div>
	<h2><?php echo	__('Stylesheet Settings', PZLKC_TEXT_DOMAIN ).$help_open.'css'.$help_close; ?></h2>
	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Stylesheet URL to Add', PZLKC_TEXT_DOMAIN ); ?></th>
			<td><input name="properties[css-add-url]"	type="url"  size="120" title="<?php echo	esc_attr($prop['css-add-url'] ); ?>" value="<?php echo	esc_attr($prop['css-add-url'] ); ?>" /><br><p><?php echo	__('(', PZLKC_TEXT_DOMAIN ).__('ex.', PZLKC_TEXT_DOMAIN ).' '.$this->home_url.'/style.css '.__(')', PZLKC_TEXT_DOMAIN ); ?></p></td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Stylesheet Text to Add', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<textarea name="properties[css-add]" maxlength="1024" class="pz-css-add"><?php echo	esc_attr($prop['css-add'] ); ?></textarea>
			</td>
		</tr>
		<tr class="pz-debug-only">
			<th scope="row"><?php _e('Stylesheet Version', PZLKC_TEXT_DOMAIN ); ?></th>
			<td><input name="properties[css-count]"		type="text" size="10" title="<?php echo	esc_attr($prop['css-count'] ); ?>" value="<?php echo	esc_attr($prop['css-count'] ); ?>" readonly="readonly" <?php if ($prop['admin-mode'] ) { echo	'onDblClick="this.readOnly=false;" '; }?>/></td>
		</tr>
		<tr class="pz-debu-only">
			<th scope="row"><?php echo __('CSS File URL', PZLKC_TEXT_DOMAIN ); ?></th>
			<td><input name=""							type="text" size="120" title="<?php echo esc_attr(PZLKC_DIR_STYLE.'style.css'     ); ?>" class="pz-click-all-select" value="<?php echo	esc_attr(PZLKC_DIR_STYLE.'style.css'     ); ?>" readonly="readonly" /></td>
		</tr>
		<tr class="pz-debug-only">
			<th scope="row"><?php echo __('CSS File URL', PZLKC_TEXT_DOMAIN ).' '.__('(Compressed)', PZLKC_TEXT_DOMAIN ); ?></th>
			<td><input name="" 							type="text" size="120" title="<?php echo esc_attr(PZLKC_DIR_STYLE.'style.min.css' ); ?>" class="pz-click-all-select" value="<?php echo	esc_attr(PZLKC_DIR_STYLE.'style.min.css' ); ?>" readonly="readonly" /></td>
		</tr>
		<tr class="pz-debug-only">
			<th scope="row"><?php _e('Stylesheet Template File', PZLKC_TEXT_DOMAIN ); ?></th>
			<td><input name=""	type="text" size="120" title="<?php echo esc_attr(PZLKC_FILE_TEMPLATE ); ?>" class="pz-click-all-select" value="<?php echo esc_attr(PZLKC_FILE_TEMPLATE ); ?>" readonly="readonly" /></td>
		</tr>

	</table>
	<?php submit_button(); ?>

	<h2><?php echo	__('Web-API Settings', PZLKC_TEXT_DOMAIN ).$help_open.'web-api'.$help_close; ?></h2>
	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Site Icon API', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<input name="properties[favicon-api]" type="url" size="120" class="pz-click-all-select" value="<?php echo	esc_attr($prop['favicon-api'] ); ?>" />
				<p><?php echo	__('%DOMAIN% replace to domain name.', PZLKC_TEXT_DOMAIN ).' '.__('(', PZLKC_TEXT_DOMAIN ).__('ex.', PZLKC_TEXT_DOMAIN ).' '.$pz_domain.' '.__(')', PZLKC_TEXT_DOMAIN ).'<br>'.__('%DOMAIN_URL% replace to domain URL.').' '.__('(', PZLKC_TEXT_DOMAIN ).__('ex.', PZLKC_TEXT_DOMAIN ).' '.$pz_domain_url.' '.__(')', PZLKC_TEXT_DOMAIN ).'<br>'.__('%URL% replace to URL.', PZLKC_TEXT_DOMAIN ).' '.__('(', PZLKC_TEXT_DOMAIN ).__('ex.', PZLKC_TEXT_DOMAIN ).' '.$pz_url.self::PLUGIN_PATH.' '.__(')', PZLKC_TEXT_DOMAIN ); ?>
				<p><?php _e('ex1.', PZLKC_TEXT_DOMAIN ); ?><input name="" type="text" size="70" class="pz-click-all-select" value="https://www.google.com/s2/favicons?domain=%DOMAIN%" readonly="readonly" /></p>
				<p><?php _e('ex2.', PZLKC_TEXT_DOMAIN ); ?><input name="" type="text" size="70" class="pz-click-all-select" value="https://favicon.hatena.ne.jp/?url=%URL%" readonly="readonly" /></p>
			</td>
		</tr>
		<tr>
			<th scope="row" rowspan="3"><?php _e('Thumbnail API', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<input name="properties[thumbnail-api]" type="url" size="120" class="pz-click-all-select" value="<?php echo	esc_attr($prop['thumbnail-api'] ); ?>" />
				<p><?php echo	__('%URL% replace to URL.', PZLKC_TEXT_DOMAIN ).' '.__('(', PZLKC_TEXT_DOMAIN ).__('ex.', PZLKC_TEXT_DOMAIN ).' '.$pz_url.self::PLUGIN_PATH.' '.__(')', PZLKC_TEXT_DOMAIN ); ?></p>
				<p><?php _e('ex1.', PZLKC_TEXT_DOMAIN ); ?><input name="" type="text" size="70" class="pz-click-all-select" value="https://s.wordpress.com/mshots/v1/%URL%?w=200" readonly="readonly" /></p>
				<p><?php _e('ex2.', PZLKC_TEXT_DOMAIN ); ?><input name="" type="text" size="70" class="pz-click-all-select" value="https://capture.heartrails.com/200x200?%URL%" readonly="readonly" /></p>
			</td>
		</tr>
	</table>
	<?php submit_button(); ?>

	<h2><?php echo	__('Image Settings', PZLKC_TEXT_DOMAIN ).$help_open.'image'.$help_close; ?></h2>
	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Image Cache URL', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<p><input name="" type="url" title="<?php echo	PZLKC_URL_CACHE; ?>" class="pz-click-all-select" value="<?php echo PZLKC_URL_CACHE; ?>" size="120" readonly="readonly" /></p>
				<p><?php _e('Schemes (http and https) are omitted.', PZLKC_TEXT_DOMAIN ); ?></p>
				<p><?php $size = pz_GetDirSize(PZLKC_DIR_CACHE ); echo	__('Used', PZLKC_TEXT_DOMAIN ).__(': ', PZLKC_TEXT_DOMAIN ).'<span class="pz-monospace">'.pz_GetSizeStringSi($size).' ('.pz_GetStringBytes($size).')'; ?></span></p>
			</td>
		</tr>
		<tr class="pz-debug-only">
			<th scope="row"><?php _e('Image Cache Directory', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<p><input name="" type="text" title="<?php echo PZLKC_DIR_CACHE; ?>" class="pz-click-all-select" value="<?php echo PZLKC_DIR_CACHE; ?>" size="120" readonly="readonly" /></p>
			</td>
		</tr>
	</table>
	<?php submit_button(); ?>

	<div class="pz-debug-only">
		<h2><?php echo	__('Survey Settings', PZLKC_TEXT_DOMAIN ); ?></h2>
		<table class="form-table">
			<tr class="pz-debug-only">
				<th scope="row"><?php _e('Log URL', PZLKC_TEXT_DOMAIN ); ?></th>
				<td>
					<p><input name="" type="url" title="<?php echo PZLKC_URL_DEBUG; ?>" class="pz-click-all-select" value="<?php echo PZLKC_URL_DEBUG; ?>" size="120" readonly="readonly" /></p>
					<p><?php _e('Schemes (http and https) are omitted.', PZLKC_TEXT_DOMAIN ); ?></p>
					<p><?php $size = pz_GetDirSize(PZLKC_DIR_DEBUG ); echo __('Used', PZLKC_TEXT_DOMAIN ).__(': ', PZLKC_TEXT_DOMAIN ).'<span class="pz-monospace">'.pz_GetSizeStringSi($size).' ('.pz_GetStringBytes($size).')'; ?></span></p>
					<p><button type="button" name="action" value="clear-log" class="pz-button" onclick="return confirm('<?php _e('(Unimplemented)', PZLKC_TEXT_DOMAIN ); ?>');"><?php _e('Clear LOG File', PZLKC_TEXT_DOMAIN ); ?></button><?php _e('(Unimplemented)', PZLKC_TEXT_DOMAIN ); ?></p>
				</td>
			</tr>
			<tr class="pz-debug-only">
				<th scope="row"><?php _e('Log Directory', PZLKC_TEXT_DOMAIN ); ?></th>
				<td>
					<p><input name="" type="text" title="<?php echo	PZLKC_DIR_DEBUG; ?>" class="pz-click-all-select" value="<?php echo PZLKC_DIR_DEBUG; ?>" size="120" readonly="readonly" /></p>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</div>
</div>
