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
 * ACL Controller (Role)
 * 
 * Provides a set functions to maintain user roles within the system
 * 
 * @package		ACL
 * @subpackage	Controllers
 * @author		William Duyck <wemd2@kent.ac.uk>
 */
class Role extends CI_controller {
	
	private $acl_table;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		
		$this->acl_table = (object)$this->config->item('acl');
		$this->acl_table =& $this->acl_table->table;
	}
	
	public function add() {
		$this->form_validation->set_rules('name',			'Name',			'trim|required|max_length[70]|unique['.$this->acl_table['role'].'.name]');
		$this->form_validation->set_rules('slug',			'Slug',			'trim|strtolower|required|max_length[35]|unique['.$this->acl_table['role'].'.slug]');
		$this->form_validation->set_rules('description',	'Description',	'trim');
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('acl/form/add_role.php', NULL, FALSE, 'bootstrap-journal');
		}
		else {
			$data = array(
				'name'			=> $this->input->post('name'),
				'slug'			=> $this->input->post('slug'),
				'description'	=> $this->input->post('description')
			);
			
			if($this->acl_model->add_role($data)) {
				redirect('acl/role');
			}
			else {
				show_error('Failed to add role');
			}
		}
	}
	
	public function edit($id) {
		echo 'edit';
	}
	
	public function del($id) {
		echo 'delete';
	}
	
	public function index() {
		$data['role_list'] = $this->acl_model->get_all_roles();
		
		foreach($data['role_list'] as &$role) {
			$role->perms = $this->acl_model->get_role_perms($role->role_id);
		}
		
		$this->load->view('acl/role', $data, FALSE, 'bootstrap-journal');
	}
}

/* End of file role.php */
/* Location: ./application/controllers/acl/role.php */