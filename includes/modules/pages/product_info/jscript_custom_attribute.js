jQuery(document).ready(function(){
	jQuery("form").each(function(i){
		if(jQuery(this).attr("name")=="cart_quantity_frm"){
			jQuery(this).submit(function(){
					var error = false;
					var msg = "";
					if(jQuery("#use_custom_size").attr('checked')==true){
						var re = /^[0-9]+.?[0-9]*$/;
						jQuery("#hiddenAttr").find("input[@type=text]").each(function(){
							if(jQuery(this).val()==""){
								//jQuery(this).focus();
							//	msg += jQuery(this).parent().parent().find(".attribsInput").html();
							//	msg += " should not be empty!\n";
							//	error = true;
							}else if (!re.test(jQuery(this).val())){
								msg += jQuery(this).parent().parent().find(".attribsInput").html();
								msg += " should be a number!\n"; 
								error = true;
							}
						})
					}
					if(error == true){
						alert(msg);
						return false;
					}
			})
		}
	})
})