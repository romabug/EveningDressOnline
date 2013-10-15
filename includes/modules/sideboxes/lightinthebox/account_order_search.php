<?php

?>
<form onsubmit="return check_search_orders(this);" method="post" action="<?php echo zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO,'','SSL') ?>" name="search_order">
<?php echo zen_draw_hidden_field('action','search'); ?>
<div class="bg_box_gray margin_t allborder clear">
	<h3 class="in_1em line_30px">Search for Orders</h3>
		<span class="pad_10px pad_t block">Order number: <br/>
		<input type="text" size="30" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''));" onkeyup="value=value.replace(/[^\d]/g,'');" value="" id="order_id" name="keyword" class="input_4"/>
		<button type="submit" class="margin_t"><span>Search</span></button>
		</span>
</div>
</form>