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
 * @author		William Duyck <fuzzyfox0@gmail.com>
 *
 * @todo	document this class
 */
class User extends CI_controller {
	
	private $acl_table;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		
		$this->acl_conf = (object)$this->config->item('acl');
		$this->acl_table =& $this->acl_conf->table;
	}
	
	public function index() {
		if(!$this->acl_model->user_has_perm($this->session->userdata('user_id'), 'view_users')) {
			redirect('acl');
		}
		
		$this->db->order_by('name', 'asc');
		$data['user_list'] = $this->acl_model->get_all_users();
		
		foreach($data['user_list'] as &$user) {
			$user->roles = $this->acl_model->get_user_roles($user->user_id);
		}
		
		$this->load->view('acl/user', $data, FALSE, 'bootstrap-journal');
	}
	
	public function add() {
		if(!$this->acl_model->user_has_perm($this->session->userdata('user_id'), 'add_user')) {
			redirect('acl');
		}
		
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
	
	public function del($id) {
		if(!$this->acl_model->user_has_perm($this->session->userdata('user_id'), 'delete_user')) {
			redirect('acl');
		}
		
		if($this->acl_model->del_user($id)) {
			redirect('acl/user');
		}
		else {
			show_error('Unable to delete user.');
		}
	}
	
	public function edit($id) {
		if(!$this->acl_model->user_has_perm($this->session->userdata('user_id'), 'edit_user')) {
			redirect('acl');
		}
		
		$this->load->view('acl/beyond-scope', NULL, FALSE, 'bootstrap-journal');
	}
	
	public function assign($id) {
		if(!$this->acl_model->user_has_perm($this->session->userdata('user_id'), 'assign_role')) {
			redirect('acl');
		}
		
		$this->form_validation->set_rules('roles[]', 'Roles', 'required');
		
		if($this->form_validation->run() == FALSE) {
			$data['user']			= $this->acl_model->get_user($id);
			$data['user']->roles	= $this->acl_model->get_user_roles($id);
			$data['role_list']		= $this->acl_model->get_all_roles();
			
			if(is_array($data['user']->roles)) {
				foreach($data['role_list'] as &$role) {
					$role->set = in_array($role, $data['user']->roles);
				}
			}
			else {
				foreach($data['role_list'] as &$role) {
					$role->set = FALSE;
				}
			}
			
			$this->load->view('acl/form/assign_user', $data, FALSE, 'bootstrap-journal');
		}
		else {
			if($this->acl_model->edit_user_roles($id, $this->input->post('roles'))) {
				redirect('acl/user');
			}
			else {
				show_error('Failed assign user.');
			}
		}
	}
	
	/*
	| -------------------------------------------------------------------
	| User sign in methods
	| -------------------------------------------------------------------
	*/
	
	public function sign_in() {
		if($this->acl_conf->sign_in_enabled) {
			if(!$this->session->userdata('signed_in')) {
				$this->form_validation->set_rules('email',		'Email',	'trim|strtolower|required|valid_email|!is_unique['.$this->acl_table['user'].'.email]');
				$this->form_validation->set_rules('password',	'Password',	'required|callback__valid_sign_in['.$this->input->post('email').']');
			
				$this->form_validation->set_message('email', FALSE);
			
				if($this->form_validation->run() == FALSE) {
					$this->load->view('acl/form/sign_in', NULL, FALSE, 'bootstrap-journal');
				}
				else {
					$user = $this->acl_model->get_user_by('email', $this->input->post('email'));
				
					$this->session->set_userdata(array(
						'user_id'	=> $user[0]->user_id,
						'email'		=> $this->input->post('email'),
						'signed_in'	=> TRUE
					));
				
					redirect('acl');
				}
			}
			else {
				redirect('acl');
			}
		}
		else {
			show_404();
		}
	}
	
	public function _valid_sign_in($password, $email) {
		$email		= trim(strtolower($email));
		$password	= hash('sha512', $password);
		
		$user = $this->acl_model->get_user_by('email', $email);
		
		$this->form_validation->set_message('_valid_sign_in', 'Invalid sign in credentials.');
		
		return ($user !== FALSE) ? ($user[0]->password == $password) : FALSE;
	}
	
	public function sign_out() {
		if($this->acl_conf->sign_in_enabled) {
			if($this->session->userdata('signed_in')) {
				$this->session->sess_destroy();
				
				redirect('');
			}
			
			show_error('You need to be signed in to sign out!', 401);
		}
		else {
			show_404();
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/acl/user.php */