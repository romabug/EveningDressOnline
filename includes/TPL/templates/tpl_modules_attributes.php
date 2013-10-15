<?php
/**
 * Module Template
 *
 * Template used to render attribute display/input fields
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_attributes.php 3208 2006-03-19 16:48:57Z birdbrain $
 */
?>
<ul id="attach" class="margin_t">
<?php if ($zv_display_select_option > 0) { ?>
<h4 class="pad_3 dark_bg g_t_c allborder font_normal"><?php echo TEXT_PRODUCT_OPTIONS; ?></h4>
<?php } // show please select unless all are readonly ?>

<?php
    $options_nameNum = count($options_name);
    for($i=0;$i < $options_nameNum;$i++) {
?>
		<?php
      if ($options_comment[$i] != '' and $options_comment_position[$i] == '0') {
    ?>
      <br class="clear"/>
      <?php if ($options_name[$i] != 'Features'){ ?>
	    <h4 class="pad_5 dark_bg g_t_c allborder font_normal"><?php echo $options_comment[$i]; ?></h4>
	    <?php } ?>
    <?php
      }
    ?>

		<div class="pad_3 big allborder no_border_t">
		<?php if ($options_name[$i] != 'Features'){ ?>
		
		<!-- 以下为定制玩偶 选项名宽度130px 特殊属性名 宽度修改，原为80PX。。上面一句 改为 PAD_5 增加选项上下间距 -->
		
			<div style="width: 130px;" class="fl"><?php echo $options_name[$i]; ?></div>
		<?php } ?>
	  <div class="back"><?php echo "\n" . $options_menu[$i]; ?>
      <!--add customer size by tony cai 修改 bof--> 
	  <?php
if(sizeof((array)$options_size_text_name)>0 && (strstr($options_name[$i],'Size')===0 || strstr($options_name[$i],'Size')!="")){
	echo '<br> <br><input type="checkbox" onclick="show_hidden_attr();" id="use_custom_size" /><font style="size:10px; font-weight: bold; color: #A72D2C;">&nbsp;I need Custom Sizing &nbsp;&nbsp; </font>';
}
?>
<!--add customer size by tony cai   修改 eof--> 
 </div>

<!--add customer size by tony cai 修改 bof-->     
<?php
if(sizeof((array)$options_size_text_name)>0 && (strstr($options_name[$i],'Size')===0 || strstr($options_name[$i],'Size')!="")){
?>
<div id="hiddenAttr" style="display:none;">
<table style="border: 0px solid #ddd; width: 353px; background-color: #EDEDED;">
<tbody>
<tr><td colspan="2" align="left"><div  style="padding-left:15px; padding-top:8px; padding-bottom:5px;">
 
Want an even better fit?  for only <strong> $39 </strong>  more,  we provide the extra service of sizing and cutting any made-to-order dress to your measurements!  
</div>

</td></tr> 
<?php
for($j=0;$j<sizeof($options_size_text_name);$j++) {
	//echo '<tr><td width="115" align="left">' . $options_size_text_name[$j].'</td><td align="left" width="164">'.$options_size_text_menu[$j] . '</td></tr>';
	echo '<tr><td width="50%" > <div  style="padding-left:15px;">' . $options_size_text_name[$j] . '<br />' .  $options_size_text_menu[$j] . ' </div></td><td width="50%" >'.$options_size_text_name[$j+1] . '<br />' . $options_size_text_menu[$j+1] . '</td></tr>';
	$j = $j+1;
}
$options_size_text_name = array();
?>
</tbody>
</table>
</div>
<script type="text/javascript">
function show_hidden_attr(i){
	if(document.getElementById("hiddenAttr").style.display=="none"){
		document.getElementById("hiddenAttr").style.display ="";
		document.getElementById("attrib-2").disabled=true;
	}else{
		document.getElementById("hiddenAttr").style.display ="none";
		document.getElementById("attrib-2").disabled=false;
	}
}

</script>
<style>
#hiddenAttr .attribsInput{width:60px;}
</style>
<?php
}
?>
<!--add customer size by tony cai 修改 eof-->    
		</div>
		<?php if ($options_comment[$i] != '' and $options_comment_position[$i] == '1') { ?>
		    <div class="ProductInfoComments"><?php echo $options_comment[$i]; ?></div>
		<?php } ?>
		<?php
		/*if ($options_attributes_image[$i] != '') {
		    echo $options_attributes_image[$i]; 
		}*/
		?>
		<?php
    }
?>


<?php
  if ($show_onetime_charges_description == 'true') {
?>
    <div class="wrapperAttribsOneTime"><?php echo TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION; ?></div>
<?php } ?>


<?php
  if ($show_attributes_qty_prices_description == 'true') {
?>
    <div><?php echo zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;' . '<a href="javascript:popupWindowPrice(\'' . zen_href_link(FILENAME_POPUP_ATTRIBUTES_QTY_PRICES, 'products_id=' . $_GET['products_id'] . '&products_tax_class_id=' . $products_tax_class_id) . '\')">' . TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK . '</a>'; ?></div>
<?php } ?>
</ul>