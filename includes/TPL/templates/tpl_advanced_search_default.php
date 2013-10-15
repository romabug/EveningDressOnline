<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=advanced_search.<br />
 * Displays options fields upon which a product search will be run
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_advanced_search_default.php 4673 2006-10-03 01:37:07Z drbyte $
 */
?>
<div class="right_big_con  allborder margin_t">
<div class="pad_10px g_t_c">
<ul>Your Search: <span class="red"><?php echo $_GET['keyword'] ?></span></ul>
<h3 class="red">Sorry, your search returned no results.</h3>
<ul><a href="./"><img border="0" class="margin_t" alt="wholesale Continue Shopping" title="wholesale Continue Shopping " src="includes/templates/<?php echo $template_dir; ?>/images/button/continue_shop.gif"/></a></ul>

<ul class="red_arrow_list g_t_l pad_10px"><h4 class="red">Search Tips</h4>
  <li>Double-check your spelling.</li>
  <li>Use fewer words that are more generic.</li>
  <li>For more results, search "All Categories".</li>
  <li>For specific results, search within a category.</li>
</ul>
</div>
</div>
<?php require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/recommendations.php')); ?>