<?php defined('ABSPATH' ) || wp_die; ?>
<div class="pz-page" id="pz-letter">
	<div class="pz-submit-float"><?php submit_button(); ?></div>
	<h2><?php echo	__('Letter Settings', PZLKC_TEXT_DOMAIN ).$help_open.'letter'.$help_close; ?></h2>
	<table class="pz-letter-table form-table">
		<tr class="pz-letter-head">
			<th></th>
			<th><?php _e('Letter Color',		PZLKC_TEXT_DOMAIN ); ?></th>
			<th><?php _e('Outline Color',		PZLKC_TEXT_DOMAIN ); ?></th>
			<th><?php _e('Background Color',	PZLKC_TEXT_DOMAIN ); ?></th>
			<th><?php _e('Size',				PZLKC_TEXT_DOMAIN ); ?></th>
			<th><?php _e('Line Height',			PZLKC_TEXT_DOMAIN ); ?></th>
			<th><?php _e('Line Limit',			PZLKC_TEXT_DOMAIN ); ?></th>
			<th><?php _e('Length',				PZLKC_TEXT_DOMAIN ); ?></th>
			<th><?php _e('Bold',				PZLKC_TEXT_DOMAIN ); ?></th>
			<th><?php _e('Italic',				PZLKC_TEXT_DOMAIN ); ?></th>
			<th><?php _e('Underline',			PZLKC_TEXT_DOMAIN ); ?></th>
			<th><?php _e('Underline<br>On Hover',			PZLKC_TEXT_DOMAIN ); ?></th>
		</tr>
		<?php
		$table	=	array(
			array( 'name' => 'title'	,	'title' => __('Title',				PZLKC_TEXT_DOMAIN ) ),
			array( 'name' => 'excerpt'	,	'title' => __('Excerpt',			PZLKC_TEXT_DOMAIN ) ),
			array( 'name' => 'url'		,	'title' => __('URL',				PZLKC_TEXT_DOMAIN ) ),
			array( 'name' => 'date'		,	'title' => __('Date',				PZLKC_TEXT_DOMAIN ) ),
			array( 'name' => 'heading'	,	'title' => __('Header Text',		PZLKC_TEXT_DOMAIN ) ),
			array( 'name' => 'more'		,	'title' => __('More Button',		PZLKC_TEXT_DOMAIN ) ),
			array( 'name' => 'info'		,	'title' => __('Site Information',	PZLKC_TEXT_DOMAIN ) ),
			array( 'name' => 'added'	,	'title' => __('Added Text',			PZLKC_TEXT_DOMAIN ) ),
			array( 'name' => 'cat'		,	'title' => __('Category',			PZLKC_TEXT_DOMAIN ) ),
		);
		foreach ($table as $t) {
			echo	'<tr>';
			echo	'<th>'.$t['title'].'</th>';
			echo	'<td>';
			$key		=		$t['name'].'-color';
			if		(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=		$prop[$key];
				echo	'<input type="text"     name="properties['.$key.']" value="'.$value.'" class="pz-wp-color-picker" />';
			} else {
				echo	'<input type="text"     name="" value="" disabled="disabled" readonly="readonly" class="pz-wp-color-picker-dummy" />';
			}
			echo		'</td>';

			echo		'<td>';
			$key		=		$t['name'].'-outline-color';
			if			(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=		$prop[$key];
				echo	'<input type="text"     name="properties['.$key.']" value="'.$value.'" class="pz-wp-color-picker" />';
			} else {
				echo	'<input type="text"     name="" value="" disabled="disabled" readonly="readonly" class="pz-wp-color-picker-dummy" />';
			}
			echo		'</td>';

			echo		'<td>';
			$key		=		$t['name'].'-bg-color';
			if			(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=		$prop[$key];
				echo	'<input type="text"     name="properties['.$key.']" value="'.$value.'" class="pz-wp-color-picker" />';
			} else {
				echo	'<input type="text"     name="" value="" disabled="disabled" readonly="readonly" class="pz-wp-color-picker-dummy" />';
			}
			echo		'</td>';

			echo	'<td>';
			$key		=		$t['name'].'-size';
			if		(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=	preg_replace('/[^0-9]/', '', $prop[$key] );
				echo	'<input type="number"   name="properties['.$key.']" value="'.$value.'" class="pz-letter-box-r" min="0" max="999" />'.__('px', PZLKC_TEXT_DOMAIN );
			} else {
				echo	'<input type="number"   name="" value="" disabled="disabled" readonly="readonly" class="pz-letter-box-r" min="0" max="999" />'.__('px', PZLKC_TEXT_DOMAIN );
			}
			echo	'</td>';

			echo	'<td>';
			$key		=		$t['name'].'-height';
			if		(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=	preg_replace('/[^0-9]/', '', $prop[$key] );
				echo	'<input type="number"   name="properties['.$key.']" value="'.$value.'" class="pz-letter-box-r" min="0" max="999" />'.__('px', PZLKC_TEXT_DOMAIN );
			} else {
				echo	'<input type="number"   name="" value="" disabled="disabled" readonly="readonly" class="pz-letter-box-r" min="0" max="999" />'.__('px', PZLKC_TEXT_DOMAIN );
			}
			echo	'</td>';

			echo	'<td>';
			$key		=		$t['name'].'-maxline';
			if		(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=	preg_replace('/[^0-9]/', '', $prop[$key] );
				echo	'<input type="number"   name="properties['.$key.']" value="'.$value.'" class="pz-letter-box-r" min="0" max="99" />';
			} else {
				echo	'<input type="number"   name="" value="" disabled="disabled" readonly="readonly" class="pz-letter-box-r" min="0" max="99" />';
			}
			echo	'</td>';

			echo	'<td>';
			$key		=		$t['name'].'-length';
			if		(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=	preg_replace('/[^0-9]/', '', $prop[$key] );
				echo	'<input type="number"   name="properties['.$key.']" value="'.$value.'" class="pz-letter-box-r" min="0" max="9999" />';
			} else {
				echo	'<input type="number"   name="" value="" disabled="disabled" readonly="readonly" class="pz-letter-box-r" min="0" max="9999" />';
			}
			echo	'</td>';

			echo	'<td>';
			$key		=		$t['name'].'-bold';
			if		(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=	preg_replace('/[^0-9]/', '', $prop[$key] );
				echo	'<input type="hidden"   name="properties['.$key.']" value="" />';
				echo	'<input type="checkbox" name="properties['.$key.']" value="1" '.($value ? 'checked="checked"' : '' ).' />';
			} else {
				echo	'<input type="checkbox" name="" value="" disabled="disabled" readonly="readonly" />';
			}
			echo	'</td>';

			echo	'<td>';
			$key		=		$t['name'].'-italic';
			if		(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=	preg_replace('/[^0-9]/', '', $prop[$key] );
				echo	'<input type="hidden"   name="properties['.$key.']" value="" />';
				echo	'<input type="checkbox" name="properties['.$key.']" value="1" '.($value ? 'checked="checked"' : '' ).' />';
			} else {
				echo	'<input type="checkbox" name="" value="" disabled="disabled" readonly="readonly" />';
			}
			echo	'</td>';

			echo	'<td>';
			$key		=		$t['name'].'-underline';
			if		(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=	preg_replace('/[^0-9]/', '', $prop[$key] );
				echo	'<input type="hidden"   name="properties['.$key.']" value="" />';
				echo	'<input type="checkbox" name="properties['.$key.']" value="1" '.($value ? 'checked="checked"' : '' ).' />';
			} else {
				echo	'<input type="checkbox" name="" value="" disabled="disabled" readonly="readonly" />';
			}
			echo	'</td>';

			echo	'<td>';
			$key		=		$t['name'].'-hover';
			if		(array_key_exists($key, self::DEFAULTS ) ) {
				$value	=	preg_replace('/[^0-9]/', '', $prop[$key] );
				echo	'<input type="hidden"   name="properties['.$key.']" value="" />';
				echo	'<input type="checkbox" name="properties['.$key.']" value="1" '.($value ? 'checked="checked"' : '' ).' />';
			} else {
				echo	'<input type="checkbox" name="" value="" disabled="disabled" readonly="readonly" />';
			}
			echo	'</td>';

			echo	'</tr>';
		};
	echo	'</table>';

	submit_button();
	echo	'</div>';
