<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=testimonials.<br />
 * Displays conditions page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_testimonials_default.php  v1.3 $
 */
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
?>
</div>
<div class="right_big_con margin_t" id="testimonials">
<ul style="background: transparent url(images/static/say.gif) no-repeat scroll right top;"><h1 class="static_h1 border_b_d"><?php echo HEADING_TITLE; ?></h1></ul>
<div id="testimonialsMainContent" class="content">
<style>
.right_big_con .t1 {background:url(images/static/top_1.gif) no-repeat;}
.right_big_con .t2 {background:url(images/static/top_2.gif) no-repeat;}
.right_big_con .t3 {background:url(images/static/top_3.gif) no-repeat;}
.right_big_con .t4 {background:url(images/static/top_4.gif) no-repeat;}
.right_big_con .t1,.right_big_con .t2,.right_big_con .t3,.right_big_con .t4 {height:40px;}
.right_big_con .bg_b {background-position:0 100%;height:90px;}
.right_big_con .div_con1,.right_big_con .div_con2,.right_big_con .div_con3,.right_big_con .div_con4{font-family:Georgia,"Times New Roman",times,serif;font-style:italic;font-size:1.6em;line-height:1.33em;color:#333;padding:0 40px;overflow:hidden;}
.right_big_con .div_con1 {background:url(images/static/top_1_c.gif) repeat-y;width:467px;}
.right_big_con .div_con2 {background:#00b2c0;color:#fff;width:544px;}
.right_big_con .div_con3 {background:#e4eed1;width:436px;}
.right_big_con .div_con4 {background:url(images/static/top_4_c.gif) repeat-y;width:521px;}
.right_big_con .img_fl,.right_big_con .img_fr {margin-top:3px;}
.right_big_con .border_b {padding:10px;line-height:150%;}
.right_big_con .border_b li {padding:10px 0;}
.static_h1 {padding:10px 0;font-size:24px;line-height:24px;background:url(images/static/line_bbb.gif) repeat-x 0 100%;color:#000}
 
.text {font-family:Georgia,"Times New Roman",times,serif;font-style:italic;font-size:1.5em;line-height:1.33em;}
</style>
<?php
  if ($reviews_split->number_of_rows > 0) {
    $reviews = $db->Execute($reviews_split->sql_query);
    $row=0;
    while (!$reviews->EOF) {
?>
    <?php switch ($row){
			     case 0:
					    ?>
<ul class="margin_t" style="padding-left: 18px;">
                    <li class="t1" style="height: 30px;"> </li>
                    <li class="div_con1">“ <?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($reviews->fields['reviews_text']))), 60, '-<br />') . ((strlen($reviews->fields['reviews_text']) >= 100) ? '...' : ''); ?> ”</li>
                    <li class="t1 bg_b" style="height: 80px;">
                    <div style="padding: 40px 0pt 0pt 65px;">
                    <ul class="big1"><?php echo zen_output_string_protected(($reviews->fields['customers_name'] != ''?$reviews->fields['customers_name']:'Guest')); ?>, from Trinidad and Tobago</ul>
                        <ul class="blue"><?php echo zen_date_short($reviews->fields['date_added']); ?></ul>
                            </div>
                            </li>
                        </ul>
     <?php break; 
           case 1:
              ?>
    <ul style="padding-left: 98px; margin-top: 17px;">
            <li class="t2"> </li>
            <li class="div_con2">“ <?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($reviews->fields['reviews_text']))), 60, '-<br />') . ((strlen($reviews->fields['reviews_text']) >= 100) ? '...' : ''); ?> ”</li>
            <li class="t2 bg_b">
            <div style="padding-top: 60px; width: 550px;" class="g_t_r">
            <ul class="big3"><?php echo zen_output_string_protected(($reviews->fields['customers_name'] != ''?$reviews->fields['customers_name']:'Guest')); ?>, from Missouri, US</ul>
                <ul class="blue"><?php echo zen_date_short($reviews->fields['date_added']); ?></ul>
                    </div>
                    </li>
                </ul>
     <?php break; 
           case 2:
              ?>
<ul style="padding-left: 65px; margin-top: 17px;">
                    <li class="t3" style="height: 30px;"> </li>
                    <li class="div_con3">“ <?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($reviews->fields['reviews_text']))), 60, '-<br />') . ((strlen($reviews->fields['reviews_text']) >= 100) ? '...' : ''); ?> ”</li>
                    <li class="t3 bg_b" style="height: 70px;">
                    <div style="padding: 40px 0pt 0pt 65px;">
                    <ul class="big3"><?php echo zen_output_string_protected(($reviews->fields['customers_name'] != ''?$reviews->fields['customers_name']:'Guest')); ?>, from Trinidad and Tobago</ul>
                        <ul class="blue"><?php echo zen_date_short($reviews->fields['date_added']); ?></ul>
                            </div>
                            </li>
                        </ul>
     <?php break;
           case 3:
              ?>
<ul style="padding-left: 133px; margin-top: 40px;">
                    <li class="t4" > </li>
                    <li class="div_con4">“ <?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($reviews->fields['reviews_text']))), 60, '-<br />') . ((strlen($reviews->fields['reviews_text']) >= 100) ? '...' : ''); ?> ”</li>
                    <li class="t4 bg_b" style="height: 80px;">
                    <div style="padding-top: 50px; width: 520px;" class="g_t_r">
                    <ul class="big3"><?php echo zen_output_string_protected(($reviews->fields['customers_name'] != ''?$reviews->fields['customers_name']:'Guest')); ?>, from Trinidad and Tobago</ul>
                        <ul class="blue"><?php echo zen_date_short($reviews->fields['date_added']); ?></ul>
                            </div>
                            </li>
                        </ul>
     <?php break;
           default: ?>
           <ul class="border_b">
                                    <li class="text">“ <?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($reviews->fields['reviews_text']))), 60, '-<br />') . ((strlen($reviews->fields['reviews_text']) >= 100) ? '...' : ''); ?> ”</li>
                                    <li class="g_t_r black"><?php echo zen_output_string_protected(($reviews->fields['customers_name'] != ''?$reviews->fields['customers_name']:'Guest')); ?>, from Missouri, US<br/>
                                    <?php echo zen_date_short($reviews->fields['date_added']); ?><br/>
                                    </li>
                                </ul>
     <?php break; 
}?>
<?php
      $row++;
      $reviews->MoveNext();
    }
?>
<?php
  } else {
?>
		<div id="reviewsDefaultNoReviews" class="content"><?php echo TEXT_NO_REVIEWS; ?></div>
<?php
  }
?>
<?php
  if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
	<div class="pad_3"><div class="fr"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></div><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></div>
	<br class="clear" />
<?php
  }
?>

</div>
</div>
