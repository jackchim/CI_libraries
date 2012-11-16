<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

define('SMARTY_DIR', BASEPATH . '../' . APPNAME . '/libraries/smartyCore/'); 
require(SMARTY_DIR . 'Smarty.class.php');

class SmartyExtended extends Smarty {
	
	var $CI;
	var $lang_code;
	
	/**
	 * Constructor
	 *
	 * Loads the smarty class
	 *
	 * @access	public
	 */
	function SmartyExtended() {

		if (!file_exists(BASEPATH . '../' . APPNAME . '/libraries/smartyCore/cache'))
		{
			mkdir(BASEPATH . '../' . APPNAME . '/libraries/smartyCore/cache', 0777);
		}
		
		$this->CI			=& get_instance();
		$this->lang_code	= $this->CI->config->item('lang_code');
		
		$this->template_dir = BASEPATH . '../' . APPNAME . '/views/';
        $this->compile_dir  = BASEPATH . '../' . APPNAME . '/libraries/smartyCore/templates_c/';
        $this->config_dir   = BASEPATH . '../' . APPNAME . '/libraries/smartyCore/configs/';
        $this->cache_dir    = BASEPATH . '../' . APPNAME . '/libraries/smartyCore/cache/';
		
		$this->caching 			= true; 
		$this->force_compile	= true;
		
		log_message('debug', "SmartyExtended Class Initialized");
    }
	
	function view($template, $data='') {
		
		if(trim($data) != '') 
		{
			if(is_array($data))
			{
				foreach($data as $key=>$val)
				{
					$this->assign($key, $val);
				}
			}
		}
		
		$this->display($template . '.tpl');
	}
}
?>