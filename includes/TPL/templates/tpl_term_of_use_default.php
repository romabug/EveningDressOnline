<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=term_of_use.<br />
 * Displays conditions page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_term_of_use_default.php  v1.3 $
 */
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
?>
</div>
<div class="right_big_con margin_t" >
<h2 class="border_b line_30px pad_l_10px"><?php echo HEADING_TITLE; ?></h2>

<div id="term_of_useMainContent" class="content">
<?php
/**
 * require the html_define for the term_of_use page
 */
  require($define_page);
?>
</div>
</div>
