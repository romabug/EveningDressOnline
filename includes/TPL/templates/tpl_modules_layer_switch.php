<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_whats_new.php 2935 2006-02-01 11:12:40Z birdbrain $
 */
  include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_LAYER_SWITCH));
?>

<!-- bof: layer_switch -->
<div id="layer_switch" class="index_layer allborder right_big_con margin_t relative">
<span class="lay_hot"> </span>
<?php
  require($template->get_template_dir('tpl_layer_switch_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_layer_switch_display.php');
?>
</div>
<script>layerswich();</script>
<!-- eof: layer_switch -->