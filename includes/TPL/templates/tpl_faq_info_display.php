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
?>
<div class="minframe fl">
<?php
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/faq_categories_css.php'));
?>
</div>
<div class="right_big_con margin_t">
<div class="fl midframe flow">
<h2 class="line_120 border_b pad_bottom"><?php echo $faqs_name; ?></h2>
<?php if ($faqs_description != '') { ?>
    <div class="margin_t pad_10px">
    <span class="mediumtext"><?php echo stripslashes($faqs_description); ?>
    </span>
    <br />
    <?php if(isset($_GET['vote'])){ ?>
    	<?php
    			$selectVoteSql = "SELECT `faqs_helpful`, `faqs_nohelpful` FROM " . TABLE_FAQS . " WHERE faqs_id = ".$_GET['faqs_id'];
    			$selectVote = $db->Execute($selectVoteSql);
    			$selectVoteHelpNum = $selectVote->fields['faqs_helpful'];
    			$selectVoteNoHelpNum = $selectVote->fields['faqs_nohelpful'];
    			if($_GET['vote'] == 'helpful'){
    				$selectVoteHelpNum++;
						$voteHelpSql = "UPDATE `" . TABLE_FAQS . "` SET `faqs_helpful` = '".$selectVoteHelpNum."' WHERE `faqs`.`faqs_id` =1 LIMIT 1 ;";
						$db->Execute($voteHelpSql);
    			}
    			if($_GET['vote'] == 'nohelpful'){
    				$selectVoteNoHelpNum++;
						$voteNoHelpSql = "UPDATE `" . TABLE_FAQS . "` SET `faqs_nohelpful` = '".$selectVoteNoHelpNum."' WHERE `faqs`.`faqs_id` =1 LIMIT 1 ;";
						$db->Execute($voteNoHelpSql);
    			}

    	?>
    	<p>Thank you for your feedback</p>
    <?php }else{ ?>
    <ul class="margin_t fl"><strong>This page was:</strong> <a onclick="document.forms['votehelpful'].submit();return false;" class="u" href="#">Helpful</a> | <a onclick="document.forms['votenothelpful'].submit();return false;" class="u" href="#">Not Helpful</a></ul>
		<ul class="margin_t g_t_r"><a class="u" href="#" onclick="history.go(-1)"><< Back</a></ul>
		<form method="post" name="votehelpful" action="<?php echo $_SERVER['REQUEST_URI']; ?>&vote=helpful"><input type="hidden" value="<?php echo $_GET['faqs_id']; ?>" name="faqs_id"/></form>
		<form method="post" name="votenothelpful" action="<?php echo $_SERVER['REQUEST_URI']; ?>&vote=nohelpful"><input type="hidden" value="<?php echo $_GET['faqs_id']; ?>" name="faqs_id"/></form>
		<?php } ?>
    
    <?php require($template->get_template_dir('tpl_faqs_next_previous.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_faqs_next_previous.php'); ?>
		</div>
<?php } ?>
</div>
<div class="therightframe fr">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/customers_say.php'));
?>
</div>
</div>