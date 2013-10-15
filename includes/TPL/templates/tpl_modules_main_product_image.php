<?php

/**

 * Module Template

 *

 * @package templateSystem

 * @copyright Copyright 2003-2005 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: tpl_modules_main_product_image.php 3208 2006-03-19 16:48:57Z birdbrain $

 */

?>

<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE)); ?>



<div id="productMainImage" class="centeredContent back">

<div id="ZoomSpin" style="position: absolute; visibility: hidden; z-index: 11525; left: 345px; top: 184px;"><?php echo zen_image($template->get_template_dir('loading.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/loading.gif','','','','id="SpinImage"')?></div>

<div id="ZoomBox" style="position: absolute;visibility: hidden; z-index: 11499;">

  <div id="ZoomClose" style="position: absolute; right: 11px; top: 5px; visibility: hidden;"><?php echo zen_image($template->get_template_dir('close.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/close.gif','','13','13','border="0" style="cursor: pointer;"');?></div>

  <!--[if lte IE 6.5]><IFRAME src="blank.htm"></IFRAME><![endif]-->

</div>

<div class="clear"></div>

  <!-- BOF Product Flash-->

<div id="product_flash" style="width:335px; text-align:center;" class="fl margin_t">

<?php

if(is_array($products_image_medium)){

  ?>

   <ul>

   <li><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . $products_image_large[0]. '" class="ih" id="product_flash_show" target="_blank">' . zen_image_OLD($products_image_medium[0], addslashes($products_name), '280', '280','id="product_flash_show_i" class="relative"') . '</a>'; ?>

   </li>

   </ul>

   <ul>

      <span class="p_f_en"> &nbsp; click to enlarge</span>

    </ul>

    <ul id="product_flash_btn">

  <?php

  $products_image_mediumNum = count($products_image_medium);

  for($i = 0 ;$i <$products_image_mediumNum;$i++){

  	 if($i+1 == $products_image_mediumNum){

  ?>

      <li class=""><img src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $products_image_small[$i]; ?>" border="0"  title="<?php echo $products_name;?>" alt="<?php echo $products_image_large[$i];?>" width="42" height="42" num="<?php echo $i;?>" imgSize="280" big="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $products_image_medium[$i]; ?>"/></li>

      

  <?php

     }else{?>

      <li class="border_r"><img src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $products_image_small[$i]; ?>" border="0"  title="<?php echo $products_name;?>" alt="<?php echo $products_image_large[$i];?>" width="42" height="42" num="<?php echo $i;?>" imgSize="280" big="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $products_image_medium[$i]; ?>"/></li>

     <?php }} ?>

    </ul>

    <script>initBtn('product_flash_btn','product_flash_show');setupZoom();</script>

<?php

  }else{

  ?>



   <ul>

   <li ><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . $products_image_large. '" class="ih" id="product_flash_show" target="_blank">' . zen_image_OLD($products_image_medium, addslashes($products_name), '280', '280','id="product_flash_show_i" class="relative"') . '</a>'; ?>

   </li>

  </ul>

  <ul>

  <span class="p_f_en">

  <script language="javascript" type="text/javascript"><!--

document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']) . '\\\')"><span>' . TEXT_CLICK_TO_ENLARGE . '</span></a>'; ?>');

//--></script>

<noscript>

<a href="<?php echo zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']); ?>" target="_blank">click above to zoom in</a>

</noscript>

</span> 

  </ul>

  <ul id="product_flash_btn">

    </ul>

 

  <script>initBtn('product_flash_btn','product_flash_show');setupZoom();</script>



<?php

  }

?>

 

    <!-- add wedding cake topper start-->

	

	



 

   <!-- add facebook twitter mark start-->

  

 

 

 

 <div align="left" style="float:left; margin-top:25px; margin-left:8px; width:400px; ">

 

   

       

 <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>

  &nbsp;&nbsp;<fb:like href="http://eveningdressonline.com.au/" show_faces="false" width="300" font=""></fb:like>

 

 <br>

 

 </div>

 

 

 

  <div align="left" style="float:left; margin-top:6px; margin-left:10px; width:122px; ">

      <?php  echo '<a href="'.zen_href_link(FILENAME_TELL_A_FRIEND, 'products_id='.$_GET['products_id']). '">'.zen_image($template->get_template_dir('tell_a_friends.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/' . 'tell_a_friends.gif','Tell A Friends','','',' class="relative"').'</a>';?>   </div>

	

   
   

   <!--

   <div align="left" style="float:left;  margin-top:15px; margin-left:20px; width:300px;  ">

  <a href="http://customdolls.com.au/dressmaking.html" target="_blank"><img border="0"   src="http://customdolls.com.au/images/leftcake.jpg" alt="Custom Made Wedding Cake Topper"/></a> </div>    -->

   

   

   

  

  <!-- add facebook twitter mark end-->

 

 

  </div>

  <!-- EOF Product Flash-->

  

 

  

  

</div>

