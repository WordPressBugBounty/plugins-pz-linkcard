<?php defined('ABSPATH' ) || wp_die; ?>
<div id="pz-modal">
  <div id="pz-close">
    <a><?php _e('×', 'pz-linkcard' ); ?></a>
  </div>
  <div id="pz-content">
    <form method="post">
      <label><?php _e('Input URL', 'pz-linkcard' ); ?></label><br>
      <input id="pz-code" type="hidden" value="<?php echo esc_attr($this->options['code1'] ); ?>">
      <input id="pz-url" type="url" size="60">
      <input id="pz-insert" type="submit" value="<?php _e('Insert', 'pz-linkcard' ); ?>" onClick="return false;" >
    </form>
  </div>
</div>
<div id="pz-overlay"></div>
