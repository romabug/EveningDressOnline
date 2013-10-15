<?php
	// y stands for yellow1912 :p. I simply add this to store all the functions frequently used in my mods
	
	// PHP4 always pass object by value (default) while PHP5 pass by reference
	if (version_compare(phpversion(), '5.0') < 0) {
	    eval('
	    function clone($object) {
	      return $object;
	    }
	    ');
	}
	## HOMEBREW str_ireplace() FOR PRE-PHP 5.0
	if(!function_exists('str_ireplace')) {
		function str_ireplace($search,$replace,$subject) {
		$search = preg_quote($search, "/");
		return preg_replace("/".$search."/i", $replace, $subject); } }
		
	class _yclass{
		function init_template(){
			require_once('init_ytemplate.php');
		}
		
		function init_validation(){
			require_once('init_yvalidation.php');
		}
		
		function init_customer(){
			require_once('init_ycustomer.php');
		}
		
		function db_result_to_string($glue, $db_result, $field=''){
			$temp_array = array();
			if($this->is_obj($db_result,'queryFactoryResult')){
				// We need to clone, because we don't want to touch the real object
				if($db_result->RecordCount() >0){
					while(!$db_result->EOF){
						if(empty($field)){
							foreach($db_result->fields as $key => $value)
								$temp_array[] = $value;
						}
						else 
							$temp_array[] = $db_result->fields[$field];
						$db_result->MoveNext();
					}
					$db_result->Move(0);
				}
			}
			return implode($glue,$temp_array);
		}
		
		function db_result_to_array($db_result, $convert_array = false){
			$final_array = array();
			if($this->is_obj($db_result,'queryFactoryResult')){
				// We need to clone, because we don't want to touch the real object
				if($db_result->RecordCount() >0){
					while(!$db_result->EOF){
						$temp_array = array();
						foreach($db_result->fields as $key => $value)
							$temp_array[$key] = $value;
						$final_array[] = $temp_array;
						$db_result->MoveNext();
					}				
					$db_result->Move(0);
				}
				else
					return false;
			}
			else 
				return false;
			if(count($final_array) > 1 || !$convert_array)
				return $final_array;
			else
				return $final_array[0];
		}
		
		function get_array_field(&$array, $field=null){
			if(empty($field) || !array_key_exists($field, $array))
				return $array;
			else
				return $array[$field];
		}
		
		// TODO: improve this function to better support multiple table and tables which are related
		function db_find($tables, $fields, $conditions, $params = null){
			global $db;
			if(is_array($tables))
				$tables = implode(',',$tables);
			if(is_array($fields))
				$fields = implode(',',$fields);	
			if(is_array($conditions))	
				$conditions = $this->array_prepare_input($conditions);
			if(is_array($params))	
				$params = $this->array_prepare_input($params);
			$find_sql = "SELECT $fields FROM $tables WHERE $conditions $params";
			return $db->Execute($find_sql);
		} 
		
		// This function does not work for all languages! BEWARE
		function array_to_upper(&$entries){
			foreach($entries as $entry){
				$entry = strtoupper($entry);
			}
		}
		
		function array_clean_up(&$the_array){
			if(!is_array($the_array))
				$the_array=(array)$the_array;	
			$this->array_trim($the_array);
			if(count($the_array)>1){
				array_filter($the_array);
				array_unique($the_array);
			}
		}
		
		// does not accept nested array (since we should not need it here)
		function array_prepare_input(&$the_array,$glue=" AND "){
			if(!is_array($the_array))
				$the_array=(array)$the_array;	
			$temp_array = array();
			foreach ($the_array as $key => $value){
					$this->string_prepare_input($the_array[$key]);
    				$temp_array[] = "$key = '$value'";
			}
			return implode($glue,$temp_array);	
		}
		
		function string_prepare_input(&$string){
			if (function_exists('mysql_real_escape_string')) {
		      	$string = mysql_real_escape_string($string);
		    } 
		    elseif (function_exists('mysql_escape_string')) {
		    	$string = mysql_escape_string($string);
		    } 
		    else {
		     	$string = addslashes($string);
		    }
		    return $string;
		}
		
		function array_trim(&$the_array){
			array_walk($the_array, array($this, '_trim'));
		}
		
		function _trim(&$value){
	        if(is_array($value)){
	            $this->array_trim($value);
	        }
       		else{
            $value = trim($value);
        	}
    	}
		
		// http://us3.php.net/manual/en/function.is-object.php#66370
		function is_obj( &$object, $check=null, $strict=false ){
			if (is_object($object)) {
		    	if ($check == null) {
		        	return true;
		      	} else {
		        	$object_name = get_class($object);
		        	return ($strict === true)?( $object_name == $check ):( strtolower($object_name) == strtolower($check) );
		      	}   
		  	} else {
		    	return false;
		  	}
		}
		
		function str_makerand ($minlength, $maxlength, $useupper, $usespecial, $usenumbers){
			/*
			Author: Peter Mugane Kionga-Kamau
			http://www.pmkmedia.com
			
			Description: string str_makerand(int $minlength, int $maxlength, bool $useupper, bool $usespecial, bool $usenumbers)
			returns a randomly generated string of length between $minlength and $maxlength inclusively.
			
			Notes:
			- If $useupper is true uppercase characters will be used; if false they will be excluded.
			- If $usespecial is true special characters will be used; if false they will be excluded.
			- If $usenumbers is true numerical characters will be used; if false they will be excluded.
			- If $minlength is equal to $maxlength a string of length $maxlength will be returned.
			- Not all special characters are included since they could cause parse errors with queries.
			
			Modify at will.
			*/
			$charset = "abcdefghijklmnopqrstuvwxyz";
			if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			if ($usenumbers) $charset .= "0123456789";
			if ($usespecial) $charset .= "~@#$%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
			if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
			else $length = mt_rand ($minlength, $maxlength);
			for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
			return $key;
		}
	}
?>