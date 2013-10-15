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
 
</div>
<div class="right_big_con margin_t">
<div class="fl midframe flow">
 


<?php  /*  以下删除那个冗余的标签块
<div class="margin_t">
	<ul class="line_120" id="help_nav">
<li  class="normal"> 
  <span id="border_left" class="border_r"><strong class="ico2 u">WRITE A INQUIRY</strong><br/>
	 </span> </li></ul>
	<div>      */ ?>
 	
<iframe width="100%" scrolling="no" height="440" frameborder="0" src="index.php?main_page=faqs_submit" style="display: none;" id="new1"></iframe>
<iframe width="100%" scrolling="no" height="500" frameborder="0" src="contact_us_frame.html?c=only" style="display: block;" id="comm1"></iframe>
	</div>
	</div>
</div>
 
 
 
   
 
 
</div>

<script language="javascript" type="text/javascript"><!--
function hs(tab) {
 var tabs = tab.parentNode.getElementsByTagName('li');
 for (var i = 0; i < tabs.length; i++) {
 var tid = tabs[i].getAttribute('to');
 if (tid==null)
 continue;
 var div = document.getElementById(tid);
 div.style.display = (tab == tabs[i]) ? '' : 'none';
 tabs[i].className = (tab == tabs[i]) ? 'normal' : 'active';
}
}
function popupWindow(url) {
  //window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=260,height=375,screenX=150,screenY=100,top=100,left=150')
    window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=600,height=420,screenX=150,screenY=100,top=100,left=150')
}
//-->
</script>
