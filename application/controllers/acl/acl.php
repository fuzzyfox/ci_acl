<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CI_ACL
 * 
 * Yet another ACL implementation for CodeIgniter. More specifically this is 
 * a role-based access control list for CodeIgniter.
 * 
 * @package		ACL
 * @author		William Duyck <fuzzyfox0@gmail.com>
 * @copyright	Copyright (c) 2012, William Duyck
 * @license		http://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 * @since		2012.12.30
 */

// ------------------------------------------------------------------------

/**
 * ACL Controller (Root)
 * 
 * Provides a set functions to navigate the acl maintainance system
 * 
 * @package		ACL
 * @subpackage	Controllers
 * @author		William Duyck <fuzzyfox0@gmail.com>
 */
class ACL extends CI_controller {
	
	private $acl_conf;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->helper(array('url'));
		$this->load->model('acl_model');
		
		$this->acl_conf = (object)$this->config->item('acl');
	}
	
	public function index() {
		if(!$this->acl_model->user_has_perm($this->session->userdata('user_id'), 'access_acl')) {
			if($this->acl_conf->sign_in_enabled) {
				redirect('acl/user/sign_in');
			}
			else {
				redirect('');
			}
		}
		
		$this->load->view('acl/index', NULL, FALSE, 'bootstrap-journal');
	}
}

/* End of file acl.php */
/* Location: ./application/controllers/acl/acl.php */