<?php defined('ABSPATH' ) || wp_die; ?>
<div class="pz-page" id="pz-position">
	<div class="pz-submit-float"><?php submit_button(); ?></div>
	<h2><?php echo	__('Position Settings', PZLKC_TEXT_DOMAIN ).$help_open.'position'.$help_close; ?></h2>

	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Link the Whole', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<?php
					pz_Checkbox($prop, 'link-all', __('Enclose the entire card at anchor.', PZLKC_TEXT_DOMAIN ) );
				?>
			</td>
		</tr>
		<tr><th scope="row"><?php _e('Resize', PZLKC_TEXT_DOMAIN ); ?></th>
			<td>
				<label>
					<input type="hidden"   name="properties[thumbnail-resize]" value="" />
					<input type="checkbox" name="properties[thumbnail-resize]" value="1" <?php checked($prop['thumbnail-resize'] ); ?> />
					<?php _e('Adjust thumbnail and letter size according to width.', PZLKC_TEXT_DOMAIN ); ?>
				</label>
			</td>
		</tr>
	</table>

	<table class="pz-position-margin">
		<tr>
			<td colspan="3">
				<?php
					echo	__('Margin top', PZLKC_TEXT_DOMAIN ).'<br>';
					pz_Select($prop, 'margin-top', LIST_MARGIN );
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?php
					echo	__('Margin left', PZLKC_TEXT_DOMAIN ).'<br>';
					pz_Select($prop, 'margin-left', LIST_MARGIN );
				?>
			</td>
			<td>
				<table class="pz-position-card">
					<tr>
						<td colspan="5">
							<?php
								echo	__('Margin top', PZLKC_TEXT_DOMAIN ).'<br>';
								pz_Select($prop, 'card-top', LIST_MARGIN );
							?>
						</td>
					</tr>
					<tr>
						<td colspan="5">
							<table class="pz-position-siteinfo">
								<tr>
									<th>
										<?php _e('Site Information', PZLKC_TEXT_DOMAIN ); ?>
									</th>
									<td>
										<?php
											pz_Select($prop, 'info-position',
												array(
													''		=>		__('None',				PZLKC_TEXT_DOMAIN ),
													'1'		=>		__('Upper Side',		PZLKC_TEXT_DOMAIN ),
													'3'		=>		__('Above the Title',	PZLKC_TEXT_DOMAIN ),
													'2'		=>		__('Under Side',		PZLKC_TEXT_DOMAIN ),
											) );
											echo	'&emsp;';
											pz_Checkbox($prop, 'use-sitename', __('Use SiteName', PZLKC_TEXT_DOMAIN ) );
										?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<?php
								echo	__('Margin left', PZLKC_TEXT_DOMAIN ).'<br>';
								pz_Select($prop, 'card-left', LIST_MARGIN );
							?>
						</td>
						<td>
							<table class="pz-position-thumbnail">
								<tr>
									<th colspan="2">
										<?php _e('Thumbnail', PZLKC_TEXT_DOMAIN ); ?>
									</th>
								</tr>
								<tr>
									<td>
										<?php _e('Position', PZLKC_TEXT_DOMAIN ); ?>
									</td>
									<td>
										<?php
											pz_Select($prop,	'thumbnail-position',
												array(
													'0'	=>		__('None',			PZLKC_TEXT_DOMAIN ),
													'1'	=>		__('Right Side',	PZLKC_TEXT_DOMAIN ),
													'2'	=>		__('Left Side',		PZLKC_TEXT_DOMAIN ),
													'3'	=>		__('Upper Side',	PZLKC_TEXT_DOMAIN ),
											) );
										?>
									</td>
								</tr>
								<tr>
									<td>
										<?php _e('Width', PZLKC_TEXT_DOMAIN );  ?>
									</td>
									<td>
										<input name="properties[thumbnail-width]"	type="text" value="<?php echo esc_attr($prop['thumbnail-width'] ); ?>" size="2" />
									</td>
								</tr>
								<tr>
									<td>
										<?php _e('Height', PZLKC_TEXT_DOMAIN ); ?>
									</td>
									<td>
										<input name="properties[thumbnail-height]"	type="text" value="<?php echo esc_attr($prop['thumbnail-height'] ); ?>" size="2" />
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table class="pz-position-size">
								<tr>
									<td>
										<?php _e('Width', PZLKC_TEXT_DOMAIN ); ?>
									</td>
									<td>
										<input name="properties[width]"          type="text" value="<?php echo	esc_attr($prop['width'] ); ?>" size="3" />
									</td>
								</tr>
								<tr>
									<td>
										<?php _e('Height', PZLKC_TEXT_DOMAIN ); ?>
									</td>
									<td style="margin: 0; padding: 0; text-align: left;">
										<input name="properties[content-height]" type="text" value="<?php echo	esc_attr($prop['content-height'] ); ?>" size="3" />
									</td>
								</tr>
							</table>
						</td>
						<td>
							<?php
								echo	__('Margin right', PZLKC_TEXT_DOMAIN ).'<br>';
								pz_Select($prop, 'card-right', LIST_MARGIN );
							?>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td colspan="2">
							<?php
								echo	__('Margin bottom', PZLKC_TEXT_DOMAIN ).'<br>';
								pz_Select($prop, 'card-bottom', LIST_MARGIN );
							?>
						</td>
						<td>
						</td>
					</tr>
				</table>
			</td>
			<td>
				<?php
					echo	__('Margin right', PZLKC_TEXT_DOMAIN ).'<br>';
					pz_Select($prop, 'margin-right', LIST_MARGIN );
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?php pz_Checkbox($prop, 'centering', __('Centering', PZLKC_TEXT_DOMAIN ) ); ?>
			</td>
			<td>
				<?php
					echo	__('Margin bottom', PZLKC_TEXT_DOMAIN ).'<br>';
					pz_Select($prop, 'margin-bottom', LIST_MARGIN );
				?>
			</td>
			<td>
			</td>
		</tr>
	</table>
	<?php submit_button(); ?>
</div>
