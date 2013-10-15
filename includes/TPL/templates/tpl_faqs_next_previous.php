<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: faq_manager.php 001 2005-03-27 dave@open-operations.com
//
// only display when more than 1

if ($faqs_ids->RecordCount() > 0) {
?>
<ul class="b margin_t">
<?php

    if ($fcPath == '') {
      $fcPath= zen_get_faq_path((int)$_GET['faqs_id']);
    }

    if ($module_show_faq_categories != '0') {

	  $fcPath_new = zen_get_path_faq(zen_get_faqs_faq_category_id((int)$_GET['faqs_id'])); 
    }
?>
  	<?php //echo (PREV_NEXT_FAQ); ?><?php //echo ($position+1 . "/" . $counter); ?>
  	<?php if ($position == 0){ ?>
    <li class="fl"><?php echo TEXT_NO_PREV_PAGE; ?></li>
  	<?php }else{ ?>
    <li class="fl"><a class="u" href="<?php echo zen_href_link(zen_get_info_faq_page($previous), 'fcPath='.$fcPath.'&faqs_id='.$previous); ?>"><?php echo substr(zen_get_faqs_name($previous,$_SESSION['languages_id']),0,15).'...'; ?></a></li>
  	<?php } ?>
  	<?php if (($position +1)== $counter ) {?>
    <li class="fr"><?php echo TEXT_NO_NEXT_PAGE; ?></li>
  	<?php }else{ ?>
    <li class="fr"><a class="u" href="<?php echo zen_href_link(zen_get_info_faq_page($next_item), 'fcPath='.$fcPath.'&faqs_id='.$next_item); ?>"> <?php echo substr(zen_get_faqs_name($next_item,$_SESSION['languages_id']),0,15).'...';?></a></li>
  	<?php } ?>
</ul>
<?php
  }
?>