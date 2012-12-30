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
 * ACL Controller (User)
 * 
 * Provides a set functions to maintain user roles within the system
 * 
 * @package		ACL
 * @subpackage	Controllers
 * @author		William Duyck <wemd2@kent.ac.uk>
 */
class User extends CI_controller {
	
	public function index() {
		$data['user_list'] = $this->acl_model->get_all_users();
		
		$this->load->view('acl/user', $data, FALSE, 'bootstrap-journal');
	}
	
	public function add() {
		$this->load->view('acl/form/add_user', NULL, FALSE, 'bootstrap-journal');
	}
}

/* End of file user.php */
/* Location: ./application/controllers/acl/user.php */