<?php defined('ABSPATH' ) || wp_die; ?>
<div id="pz-modal">
  <div id="pz-close">
    <a><?php _e('×', PZLKC_TEXT_DOMAIN ); ?></a>
  </div>
  <div id="pz-content">
    <form method="post">
      <label><?php _e('Input URL', PZLKC_TEXT_DOMAIN ); ?></label><br>
      <input id="pz-code" type="hidden" value="<?php echo $this->options['code1']; ?>">
      <input id="pz-url" type="url" size="60">
      <input id="pz-insert" type="submit" value="<?php _e('Insert', PZLKC_TEXT_DOMAIN ); ?>" onClick="return false;" >
    </form>
  </div>
</div>
<div id="pz-overlay"></div>
