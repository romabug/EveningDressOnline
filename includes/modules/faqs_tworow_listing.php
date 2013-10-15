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
<div class="margin_t">
<?php
  $tworow_query = "SELECT f.`faq_categories_id`, fd.`faq_categories_name` 
                   FROM faq_categories f, faq_categories_description fd
                   WHERE fd.faq_categories_id=f.faq_categories_id 
                   ORDER BY f.`sort_order` LIMIT 8;";
  $tworow = $db->Execute($tworow_query);
  if ($tworow->RecordCount()>0){
  	while (!$tworow->EOF){
		    $rowcontent_query = "SELECT fd.`faqs_name`, f.`faqs_id` 
		                         FROM faqs f, faqs_to_faq_categories ft, faqs_description fd
                             WHERE ft.faqs_id=f.faqs_id 
                             AND f.`faqs_status` =1 
                             AND fd.faqs_id=f.faqs_id 
                             AND ft.faq_categories_id = '".$tworow->fields['faq_categories_id']."' LIMIT 5";
		    $rowcontent = $db->Execute($rowcontent_query);
		    echo '<ul class="line_120 fl bg_box_gray allborder margin_t" id="chapter_nav">';
		    echo '<h3 class="in_1em line_30px">'.$tworow->fields['faq_categories_name'].'</h3>';
        echo '<div class="pad_10px">';
        echo '<ul class="red_arrow_list">';
		    if ($rowcontent->RecordCount()>0){
		      while (!$rowcontent->EOF){
		        echo '<li><a href="'.zen_href_link(zen_get_info_faq_page($rowcontent->fields['faqs_id']),'faqs_id='.$rowcontent->fields['faqs_id']).'">'.$rowcontent->fields['faqs_name'].'</a></li>';
		      $rowcontent->MoveNext();
		      }
		    }else{
			    echo '<div class="caution_box">'.TEXT_NO_ALL_FAQS.'</div>'; 
			  }
		    echo '</ul><a title="" href="'.zen_href_link(FILENAME_FAQS_ALL,'fcPath='.$tworow->fields['faq_categories_id']).'" class="fr u">More >></a></div></ul>';
		    $tworow->MoveNext();
  	}
  }else{
		echo '<div class="caution_box">'.TEXT_NO_ALL_FAQS.'</div>'; 
  }
?> 
</div>
<br class="clear"/>
<div class="pad_10px fr"><?php echo '<a href="' . zen_href_link(FILENAME_FAQS_SUBMIT, '', 'NONSSL') . '">' . zen_image_button(BUTTON_IMAGE_SUBMIT_FAQ, BUTTON_SUBMIT_FAQ_ALT) . '</a>'; ?></div>



