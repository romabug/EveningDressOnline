<?php
/**
 * tpl_block_checkout_shipping_address.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_checkout_address_book.php 3101 2006-03-03 05:56:23Z drbyte $
 */
?>
<?php
/**
 * require code to get address book details
 */
  require(DIR_WS_MODULES . zen_get_module_directory('checkout_address_book.php'));
?>

<?php 
      $i=0;
      while (!$addresses->EOF) {
        if ($addresses->fields['address_book_id'] == $_SESSION['customer_default_address_id']){
				?>
          <li class="fr">
          <h4>Your Billing Address:</h4> 
          <div class="pad_l">
          <b><?php echo zen_output_string_protected($addresses->fields['firstname'] . ' ' . $addresses->fields['lastname']); ?></b>
          <?php 
            $array_filtered = filterName($addresses->fields);
            echo zen_address_format($format_id, $array_filtered, true, ' ', '<br />');
         // 不显示电话   echo '<br />Phone:'.$addresses->fields['phone'];
            ?>
          
          <ul class="pad_top">
            <a href="<?php echo zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS,'edit='.$addresses->fields['address_book_id']) ?>">
            <?php echo zen_image($template->get_template_dir('btn_edit.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_edit.gif')?>
            </a>
          </ul>
          </div>
          </li>
        <?php } ?>
	        <li class="fl">
	        <?php
	          echo '<a class="pad_b2" href="javascript:document.checkout_address.address.value=\''.$addresses->fields['address_book_id'].'\';document.checkout_address.submit();" >';
	          echo zen_image($template->get_template_dir('btn_ship.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_ship.gif');
	          echo '</a>';
	          ?>
	        <div class="pad_l">
	        <b><?php echo zen_output_string_protected($addresses->fields['firstname'] . ' ' . $addresses->fields['lastname']); ?></b>
	        <?php 
	          $array_filtered = filterName($addresses->fields);
	        ?>
	        <?php
	          echo zen_address_format($format_id, $array_filtered, true, ' ', '<br />');
	         // echo '<br />Phone:'.$addresses->fields['phone'];
	          ?>
	        
	        <ul class="pad_top">
	            <a href="<?php echo zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS,'edit='.$addresses->fields['address_book_id']) ?>">
	              <?php echo zen_image($template->get_template_dir('btn_edit.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_edit.gif')?>
	            </a>
	            <a href="javascript:if(confirm('Are you sure deleting this shipping address?')){window.location.href='<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS,'delete='.$addresses->fields['address_book_id']) ?>';}">
	              <?php echo zen_image($template->get_template_dir('btn_delete.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_delete.gif')?>
	            </a>
	            </ul>
	        </div>
	        </li>
	      <?php 
	      $i++;
        $addresses->MoveNext();
      }
?>