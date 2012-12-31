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
	
	private $acl_table;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		
		$this->acl_table = (object)$this->config->item('acl');
		$this->acl_table =& $this->acl_table->table;
	}
	
	public function index() {
		$data['user_list'] = $this->acl_model->get_all_users();
		
		foreach($data['user_list'] as &$user) {
			$user->roles = $this->acl_model->get_user_roles($user->user_id);
		}
		
		$this->load->view('acl/user', $data, FALSE, 'bootstrap-journal');
	}
	
	public function add() {
		$this->form_validation->set_rules('name',				'Name',				'trim|required|max_length[70]');
		$this->form_validation->set_rules('email',				'Email',			'trim|strtolower|required|valid_email|unique['.$this->acl_table['user'].'.email]');
		$this->form_validation->set_rules('password',			'Password',			'required|min_length[8]');
		$this->form_validation->set_rules('confirm-password',	'Confirm Password',	'required|matches[password]');
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('acl/form/add_user', NULL, FALSE, 'bootstrap-journal');
		}
		else {
			$data = array(
				'name'		=> $this->input->post('name'),
				'email'		=> $this->input->post('email'),
				'password'	=> hash('sha512', $this->input->post('password'))
			);
			
			if($this->acl_model->add_user($data)) {
				redirect('acl/user');
			}
			else {
				show_error('Failed to add user.');
			}
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/acl/user.php */