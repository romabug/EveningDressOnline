<?php

/*
	array(field_name => array(0 => array(rule => message)
		 )
	
	
	$default_error_messages = array('validation_is_not_empty' 	=> 'is empty',
									'validation_is_number' 		=> 'is not a number',
									'validation_is_positive' 	=> 'is not a positive number',
									'validation_is_date'		=> 'is not a valid date');
	$default_validation_rules = array(0 => array('function' => 'validation_is_not_empty'));	
*/

	class _yvalidation{
		// TODO: use 'private' when ZC moves to PHP5
		var $default_messages = array(	'validation_is_not_empty' 	=> 'is empty',
										'validation_is_number' 		=> 'is not a number',
										'validation_is_positive' 	=> 'is not a positive number',
										'validation_is_email' 		=> 'is not a valid email address',
										'validation_is_date'		=> 'is not a valid date',
										'validation_is_url'			=> 'is not a valid url');
	
		var $rules;
		var $params = array();
		var $error_count = 0;
		var $validationErrors = array();
		var $class = 'validation';
		// class is used to later display error message
		// if ($messageStack->size(class) > 0) echo $messageStack->output(class);
		function set_error_class($class){
			$this->class = $class;
		}
		
		function set_rules($rules){
			$this->rules = $rules;
		}
		
		function add_rules($rules){
			foreach($rules as $key => $value){
				if(array_key_exists($key, $this->rules))
					$this->rules[$key][] = $value;
				else
					$this->rules[$key] = $value; 
			}		
		}
		
		function set_messages($messages){
			$this->default_messages = $messages;
		}
		
		function add_messages($messages){
			$this->default_messages[] = $messages;
		}
		
		function set_params($params){
			$this->params = $params;
		}
		
		function add_params($params){
			$this->params[] = $params;
		}
	
		function validate_fields($params){
			foreach($params as $name => $value){
				if(is_array($params[$name])){
					$this->validate_fields($params[$name]);
				}
				elseif(array_key_exists($name, $this->rules)){
					foreach($this->rules[$name] as $method =>  $message){
						if(method_exists($this, $method)){
							if(!call_user_func_array(array(&$this, $method), $value)){ // value of the field is passed as the rule's parameters
								// sounds off the alarm	
									if(isset($message) && !empty($message))
										$this->set_error($message, $this->class);
									else
										$this->set_error("$name ".$this->default_messages[$method], $this->class);
								}
							}
							else{
								$this->set_error(sprintf("Could not call function '%s' to validate field '%s' with the value '%s'",$method,$name,$value), $this->class);
								// sounds off the alarm	
							}
					}	
				}							
			}
		}
		
		function set_error($message, $class, $type='error'){
			$this->validationErrors[] = array('message' => $message, 'class' => $class, 'type' => $type);
			$this->error_count++;
		}
		
		
		function set_zen_error($is_admin_side){
			global $messageStack;
			foreach($this->validationErrors as $error)
				if(!$is_admin_side) $messageStack->add($error['class'], $error['message'], $error['type']);
				else $messageStack->add($error['message'], $error['type']);
		}
		
		function run($is_admin_side = false){
			$this->validate_fields($this->params);
			$this->set_zen_error($is_admin_side);
			return $this->error_count;
		}
		
		// TODO: Let the user define new validation functions somewhere else.
		// Edit/Add new validation functions here:
		function validation_is_not_empty($param){
			return !empty($param);
		}
		
		function validation_is_number($param){
			return is_numeric($param);
		}
		
		function validation_is_positive($param){
			if($this->validation_is_number($param))
				return (int)$param > 0;
			return false;
		}
		//YYYY-MM-DD
		function validation_is_date($date){
			if (ereg ("([0-9]{4})-([0-9]{2})-([0-9]{2})", $date, $regs))
		    	if((int)$regs[3]<=31 && (int)$regs[3]>0) // check date
		    		 if((int)$regs[2]<=12 && (int)$regs[2]>0) // check month
		    		 	if((int)$regs[1]>0) // check year
		    		 		return true;
			return false;		
		}	
		
		function validation_is_email($email){
			return zen_validate_email($email);
		}
		
		function validation_is_url($url){
			$urlregex = "^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
			if (eregi($urlregex, $url)) 
			return true;
			else 
			return false;  
		}
		// End of editable zone
	}
?>