<?php
	class _ycustomer{
		// TODO: improve this
		function get_customer($fields, $from, $params){
			global $db;
			if(is_array($fields))
				$fields = implode(',',$fields);
			if(is_array($from))
				$from = implode(',',$from);
				
			$sql = "SELECT $fields FROM $from WHERE $params";
			$customer = $db->Execute($sql);
			return $customer;
		}
	}
?>