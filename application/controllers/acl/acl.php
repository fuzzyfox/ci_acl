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
	
	public function index() {
		$this->load->view('acl/index', NULL, FALSE, 'bootstrap-journal');
	}
}

/* End of file acl.php */
/* Location: ./application/controllers/acl/acl.php */