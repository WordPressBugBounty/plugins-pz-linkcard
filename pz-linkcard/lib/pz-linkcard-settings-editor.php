<?php defined('ABSPATH' ) || wp_die; ?>
<div class="pz-page" id="pz-editor">
	<div class="pz-submit-float"><?php submit_button(); ?></div>
	<h2><?php echo	__('Convert Settings', PZLKC_TEXT_DOMAIN ).$help_open.'editor'.$help_close; ?></h2>
	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Convert from Text Link', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<label>
					<input type="hidden"   name="properties[auto-atag]" value="" />
					<input type="checkbox" name="properties[auto-atag]" value="1" <?php checked($prop['auto-atag'] ); ?> class="pz-sync-check" />
					<?php _e('Convert lines with text link only to Linkcard.', PZLKC_TEXT_DOMAIN ); ?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Convert from URL', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<label>
					<input type="hidden"   name="properties[auto-url]" value="" />
					<input type="checkbox" name="properties[auto-url]" value="1" <?php checked($prop['auto-url'] ); ?> class="pz-sync-check" />
					<?php _e('Convert lines with URL only to Linkcard.', PZLKC_TEXT_DOMAIN ); ?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Do Shortcode', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<label>
					<input type="hidden"   name="properties[flg-do-shortcode]" value="" />
					<input type="checkbox" name="properties[flg-do-shortcode]" value="1" <?php checked($prop['flg-do-shortcode'] ); ?> />
					<?php _e('Force shortcode development.', PZLKC_TEXT_DOMAIN ); ?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('External Link Only', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<label>
					<input type="hidden"   name="properties[auto-external]" value="" />
					<input type="checkbox" name="properties[auto-external]" value="1" <?php checked($prop['auto-external'] ); ?> />
					<?php _e('Convert only external links.', PZLKC_TEXT_DOMAIN ); ?>
				</label>
			</td>
		</tr>
	</table>
	<?php submit_button(); ?>

	<h2><?php echo	__('Editor Settings', PZLKC_TEXT_DOMAIN ).$help_open.'editor'.$help_close; ?></h2>
	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Add Insert Button', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<label>
					<input type="hidden"   name="properties[flg-edit-insert]" value="" />
					<input type="checkbox" name="properties[flg-edit-insert]" value="1" <?php checked($prop['flg-edit-insert'] ); ?> />
					<?php _e('Add insert button to visual editor.', PZLKC_TEXT_DOMAIN ); ?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Add Quick Tag', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<label>
					<input type="hidden"   name="properties[flg-edit-qtag]" value="" />
					<input type="checkbox" name="properties[flg-edit-qtag]" value="1" <?php checked($prop['flg-edit-qtag'] ); ?> />
					<?php _e('Add quick tag button to text editor.', PZLKC_TEXT_DOMAIN ); ?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Clear Excerpt', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<label>
					<input type="hidden"   name="properties[flg-clear-excerpt]" value="" />
					<input type="checkbox" name="properties[flg-clear-excerpt]" value="1" <?php checked($prop['flg-clear-excerpt'] ); ?> />
					<?php _e('If TITLE parameter is specified, EXCERPT is also cleared.', PZLKC_TEXT_DOMAIN ); ?>
				</label>
			</td>
		</tr>
		</table>
	<?php submit_button(); ?>

	<h2><?php echo	__('Shortcode Settings', PZLKC_TEXT_DOMAIN ).$help_open.'editor'.$help_close; ?></h2>
	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('ShortCode 1', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>[<input name="properties[code1]" type="text" class="pz-shortcode pz-shortcode-1" value="<?php echo	esc_attr($prop['code1'] ); ?>" /> url="http://popozure.info" <span class="pz-shortcode-title"><span class="pz-shortcode-parameter">title</span>="xxxxxx"</span> <span class="pz-shortcode-content"><span class="pz-shortcode-parameter">content</span>="xxxxxx"</span>]<p><?php _e('Case-sensitive', PZLKC_TEXT_DOMAIN ); ?></p></td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Use InLineText', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				[<span class="pz-shortcode-copy"><?php echo	esc_attr($prop['code1'] ); ?></span> url="http://xxx"]
				<select name="properties[use-inline]" class="pz-shortcode-enabled">
					<option value=""	<?php selected($prop['use-inline'] == ''  ); ?>><?php _e('No use',			PZLKC_TEXT_DOMAIN ); ?></option>
					<option value="1"	<?php selected($prop['use-inline'] == '1' ); ?>><?php _e('Use to excerpt',	PZLKC_TEXT_DOMAIN ); ?></option>
					<option value="2"	<?php selected($prop['use-inline'] == '2' ); ?>><?php _e('Use to title',	PZLKC_TEXT_DOMAIN ); ?></option>
				</select>
				[/<span class="pz-shortcode-copy"><?php echo	esc_attr($prop['code1'] ); ?></span>]
				<p><?php _e('This setting applies only to the Shortcode1', PZLKC_TEXT_DOMAIN ); ?></p></td>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('ShortCode 2', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>[<input name="properties[code2]" type="text" class="pz-shortcode" value="<?php echo	esc_attr($prop['code2'] ); ?>" /> url="http://popozure.info" <span class="pz-shortcode-title"><span class="pz-shortcode-parameter">title</span>="xxxxxx"</span> <span class="pz-shortcode-content"><span class="pz-shortcode-parameter">content</span>="xxxxxx"</span>]<p><?php _e('Case-sensitive', PZLKC_TEXT_DOMAIN ); ?></p></td>
		</tr>
		<tr>
			<th scope="row"><?php _e('ShortCode 3', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>[<input name="properties[code3]" type="text" class="pz-shortcode" value="<?php echo	esc_attr($prop['code3'] ); ?>" /> url="http://popozure.info" <span class="pz-shortcode-title"><span class="pz-shortcode-parameter">title</span>="xxxxxx"</span> <span class="pz-shortcode-content"><span class="pz-shortcode-parameter">content</span>="xxxxxx"</span>]<p><?php _e('Case-sensitive', PZLKC_TEXT_DOMAIN ); ?></p></td>
		</tr>
		<tr class="pz-admin-only">
			<th scope="row"><?php _e('ShortCode 4', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>[<input name="properties[code4]" type="text" class="pz-shortcode" value="<?php echo	esc_attr($prop['code4'] ); ?>" /> url="http://popozure.info" <span class="pz-shortcode-title"><span class="pz-shortcode-parameter">title</span>="xxxxxx"</span> <span class="pz-shortcode-content"><span class="pz-shortcode-parameter">content</span>="xxxxxx"</span>]<p><?php _e('Case-sensitive', PZLKC_TEXT_DOMAIN ); ?></p></td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Example Entry', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<p><?php echo __('ex1.', PZLKC_TEXT_DOMAIN ).'&ensp;'.__('Specify only URL parameters.', PZLKC_TEXT_DOMAIN ); ?><div class="pz-shortcode-example pz-click-all-select">[<span class="pz-shortcode-copy"><?php echo esc_attr($prop['code1'] ); ?></span> url="https://xxx"]</div></p>
				<p><?php echo __('ex2.', PZLKC_TEXT_DOMAIN ).'&ensp;'.__('Specify URL and title parameters.', PZLKC_TEXT_DOMAIN ); ?><div class="pz-shortcode-example pz-click-all-select">[<span class="pz-shortcode-copy"><?php echo esc_attr($prop['code1'] ); ?></span> url="https://xxx" <span class="pz-shortcode-title"><span class="pz-shortcode-parameter">title</span>="xxxxxx"</span>]</div></p>
				<p><?php echo __('ex3.', PZLKC_TEXT_DOMAIN ).'&ensp;'.__('Specify URL, title and content parameters.', PZLKC_TEXT_DOMAIN ); ?><div class="pz-shortcode-example pz-click-all-select">[<span class="pz-shortcode-copy"><?php echo esc_attr($prop['code1'] ); ?></span> url="https://xxx" <span class="pz-shortcode-title"><span class="pz-shortcode-parameter">title</span>="xxxxxx"</span> <span class="pz-shortcode-content"><span class="pz-shortcode-parameter">content</span>="xxxxxx"</span>]</div></p>
				<p><?php _e('For any shortcode you can change the title and excerpt with `title` parameter and `content` parameter', PZLKC_TEXT_DOMAIN ); ?></p>
			</td>
		</tr>
	</table>
	<?php submit_button(); ?>
</div>