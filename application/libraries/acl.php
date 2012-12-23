<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ACL {
	
	/**
	 * CodeIgniter instance
	 *
	 * @var CodeIgniter
	 */
	private $_ci;
	/**
	 * acl model
	 *
	 * @var \ACL_model
	 */
	public $model;
	
	/**
	 * constructor
	 *
	 * @author William Duyck <fuzzyfox0@gmail.com>
	 */
	public function __construct() {
		// get codeigniter instance
		$this->_ci =& get_instance();
		
		// get acl model instance
		$this->model =& $this->_ci->acl_model;
	}
}

/* End of file acl.php */
/* Location: ./application/libraries/acl.php */