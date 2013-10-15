<?php
	class _ytemplate extends template_func{
		var $name;
	    var $path;
	    var $css_path;
	    var $base;
	    var $data = array();
	    function set_base($base=''){
	    	if(empty($base))
	    		$this->base = $_GET['main_page'];
	    	else
	    		$this->base = $base;	    	
	    }
	    
	    function admin_set_base(){
	    	$this->set_base(preg_replace('/\.php/','',substr(strrchr($_SERVER['PHP_SELF'],'/'),1),1));
	    }
	    
	    function set_path($path){
	    	$this->path = $path.$this->base.'/';
	    }
	    
	    function zen_set_path(){
	    	$this->path = $this->get_template_dir($this->name, DIR_WS_TEMPLATE, $this->base, $this->base).'/';
	    }
	    
	    function zen_admin_set_path(){
	    	$this->path = DIR_FS_ADMIN.'includes/templates/templates/'.$this->base.'/';
	    	$this->css_path = 'includes/templates/css/'.$this->base.'.css';
	    }
	    
	    function load_admin_css(){
	    	if($this->_check_path(DIR_FS_ADMIN.$this->css_path));
	    	echo '<link rel="stylesheet" type="text/css" href="'.$this->css_path.'">';
	    }
	    
	    function _check_path($path){
	    	if(file_exists($path))
	    		return true;
	    	return false;
    	}
    	
	    function set_name($name){
	    	$this->name = $name;
	    }
	    
	    function build_name(){
	    	if(empty($this->name)){
	    		$this->name = 'tpl_';
	    		if(!isset($_GET['action']) || empty($_GET['action']))
	    			$this->name .= 'index';
	    		else
	    			$this->name .= $_GET['action'];
	    	$this->name .= '.php';
	    	}
	    }

	    function set($one, $two = null) {
	         $data = null;
	         if (is_array($one)) {
	             if (is_array($two)) {
	                 $data = array_combine($one, $two);
	             } else {
	                 $data = $one;
	             }
	         } else {
	             $data = array($one => $two);
	         }
	 
	         if ($data == null) {
	             return false;
	         }
	 		 foreach($this->data as $key=>$value)
	         	if(key($this->data[$key]) == key($data))
	         		unset($this->data[$key]);
	         		
	         $this->data[] = $data;
	     }

	    function set_array($array){
	    	foreach($array as $element){
	    		$this->set($element);
	    	}
	    }
	    
	    function render(){
	    	if($this->_check_path($this->path.$this->name)){
	    		foreach($this->data as $element)
		    	    extract($element, EXTR_SKIP);
	    		ob_start();
	    		require_once($this->path.$this->name);
	    		$out = ob_get_clean();
	    		print $out;
	    	}
	    	// error output
	    	else{
	    		echo "Render error, file not found(".$this->path.$this->name.")";
	    	}
	    }
	}
?>