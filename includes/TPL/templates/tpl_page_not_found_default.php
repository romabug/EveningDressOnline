<?php
/**
 * Page Template
 *
 * Displays page-not-found message and site-map (if configured)
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_page_not_found_default.php 3230 2006-03-20 23:21:29Z drbyte $
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
<h2 class="border_b line_30px"><a onclick="back(-1);" class="big block fr" href="javascript:void(0);"><< Back</a><span class="block fl"><?php echo HEADING_TITLE; ?></span></h2>
<br class="clear"/>
<?php if (DEFINE_PAGE_NOT_FOUND_STATUS == '1') { ?>
<div>
<?php
/**
 * require the html_define for the page_not_found page
 */
  require($define_page); ?>
</div>
<?php } ?>
<h2 class="clear line_30px g_t_r"><a onclick="back(-1);" class="big block" href="javascript:void(0);"><< Back</a></h2>
<br class="clear" />
<div class="right_big_con margin_t">
<h2 class="border_b line_30px pad_l_10px">Site Map</h2>
<div class="margin_t site_map line_120"><?php echo $zen_SiteMapTree->buildTree(); ?></div>
</div>
<?php //echo '<div class="pad_10px fl">'.zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a></div>'; ?>
</div>
