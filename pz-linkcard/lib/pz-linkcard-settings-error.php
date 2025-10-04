<?php defined('ABSPATH' ) || wp_die; ?>
<div class="pz-page" id="pz-error">
	<div class="pz-submit-float"><?php submit_button(); ?></div>
	<h2><?php echo	__('Error Settings', 'pz-linkcard' ).$help_open.'error'.$help_close; ?></h2>
	<div class="pz-error-text">
		<?php _e('The shortcode description is incorrect. Please open the "Linked Articles" section and correct it.', 'pz-linkcard' ); ?>
	</div>
	<table class="pz-set-table form-table">
		<tr>
			<th scope="row"><?php _e('Post ID', 'pz-linkcard' ); ?></th>
			<td>
				<a href="<?php echo get_permalink($prop['error-postid'] ); ?>#lkc-error" class="pz-error-url"><?php echo esc_html($prop['error-postid'] ); ?></a>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Post URL', 'pz-linkcard' ); ?></th>
			<td>
				<a href="<?php echo esc_url($prop['error-url'] ); ?>#lkc-error" class="pz-error-url"><?php echo esc_html($prop['error-url'] ); ?></a>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Occurrence Time', 'pz-linkcard' ); ?></th>
			<td>
				<span><?php echo is_numeric($prop['error-time'] ) ? esc_html($this->pz_Date(PZLKC_DATETIME_FORMAT, $prop['error-time'] ) ) : $prop['error-time']; ?></span>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Error Reset', 'pz-linkcard' ); ?></th>
			<td>
				<button type="submit" name="action" value="clear-error" class="pz-button"><?php _e('Reset', 'pz-linkcard' ); ?></button>
				&ensp;<span><?php _e('Cancel the error condition.', 'pz-linkcard' ); ?></span>
				<br><span class="pz-warning"><?php _e('* If you have not corrected the error, you may still get an error even if you cancel the error.', 'pz-linkcard' ); ?></span>
			</td>
		</tr>
	</table>
	<?php submit_button(); ?>
</div>
