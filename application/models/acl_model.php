<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ACL_model extends CI_model {
	
	/**
	 * acl config shortcut
	 *
	 * @var object
	 */
	private $_config;
	
	/**
	 * constructor
	 *
	 * @author William Duyck <fuzzyfox0@gmail.com>
	 */
	public function __construct() {
		parent::__construct();
		
		$this->_config = (object)$this->config->item('acl');
	}
	
	/*
	| -------------------------------------------------------------------
	|  user specific methods
	| -------------------------------------------------------------------
	*/
	
	/**
	 * get all users details
	 *
	 * @return	array	an array of CodeIgniter row objects for user
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_all_users() {
		$users = $this->db->get($this->_config->table['users']);
		return ($users->num_rows() > 0) ? $users->result() : FALSE;
	}
	
	/**
	 * get specific user details by constraint
	 *
	 * @param	string	$field	the field to constrain by
	 * @param	mixed	$value	the required value of field
	 * @return	array	an array of CodeIgniter row objects for user
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_user_by($field, $value) {
		$this->db->where($field, $value);
		return $this->get_all_users();
	}
	
	/**
	 * get user details
	 *
	 * @param	int		$user_id	the unique identifier for the user to get
	 * @return	object	a CodeIgniter row object for user
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter row object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_user($user_id) {
		$user = $this->get_user_by('user_id', $user_id);
		return ($user !== FALSE) ? $user[0] : FALSE;
	}
	
	/**
	 * add user to database
	 *
	 * @param	assoc_array	$data	associative array of data to add into `user` table
	 * @return	boolean		TRUE/FALSE - whether or not addition was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function add_user($data) {
		$this->db->insert($this->_config->table['user'], $data);
		return ($this->db->affected_rows() == 1);
	}
	
	/**
	 * delete user from database
	 *
	 * @param	int		$user_id	the unique identifier for the user to get
	 * @return	boolean	TRUE/FALSE - whether or not the deletion was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function del_user($user_id) {
		$this->db->delete($this->_config->table['user'], array('user_id' => $user_id));
		return ($this->db->affected_rows() == 1);
	}
	
	/**
	 * update user details
	 *
	 * @param	int			$user_id	the unique identifier for the user to get
	 * @param	assoc_array	$data		the new data for the user
	 * @return	boolean		TRUE/FALSE - whether or not the changes were successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function edit_user($user_id, $data) {
		$this->db->update($this->_config->table['user'], $data, array('user_id' => $user_id));
		return ($this->db->affected_rows() == 1);
	}
	
	/*
	| -------------------------------------------------------------------
	|  user role relations
	| -------------------------------------------------------------------
	*/
	
	/**
	 * get users role
	 *
	 * @param	string	$user_id	the unique identifier for the user to get
	 * @return	array	array of CodeIgniter row objects for user
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_user_role($user_id) {
		$this->db->select($this->_config->table['role'] . '.*')
			->from($this->_config->table['user_role'])
			->where('user_id', $user_id)
			->join($this->_config->table['role'], $this->_config->table['role'] . '.role_id = ' . $this->_config->table['user_role'] . '.role_id', 'inner');
		
		$role = $this->db->get();
		return ($role->num_rows() > 0) ? $role->result() : FALSE;
	}
	
	/**
	 * assign user to role
	 *
	 * @param	int		$user_id	the unique identifier for the user to assign
	 * @param	int		$role_id	the unique identifier for the role to assign
	 * @return	boolean	TRUE/FALSE - whether or not the assignment was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function add_user_role($user_id, $role_id) {
		$this->db->insert($this->_config->table['user_role'], array(
			'user_id' => $user_id,
			'role_id' => $role_id
		));
		return ($this->db->affected_rows() == 1);
	}
	
	/**
	 * remove user from role
	 *
	 * @param	int		$user_id	the unique identifier for the user
	 * @param	int		$role_id	the unique identifier for the role
	 * @return	boolean	TRUE/FALSE - whether or not the removal was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function del_user_role($user_id, $role_id) {
		$this->db->delete($this->_config->table['user_role'], array(
			'user_id' => $user_id,
			'role_id' => $role_id
		));
		return ($this->db->affected_rows() == 1);
	}
	
	/*
	| -------------------------------------------------------------------
	|  role permission relations
	| -------------------------------------------------------------------
	*/
	
	/**
	 * get permission a role has
	 *
	 * @param	int		$role_id	the unique identifier for the role
	 * @return	array	array of CodeIgniter row objects for user
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_role_perms($role_id) {
		$this->db->select($this->_config->table['perm'] . '.*')
		->from($this->_config->table['role_perm'])
		->where('role_id', $role_id)
		->join($this->_config->table['perm'], $this->_config->table['perm'] . '.role_id = ' . $this->_config->table['role_perm'] . '.role_id');
		
		$perms = $this->db->get();
		return ($perms->num_rows() > 0) ? $perms->result() : FALSE;
	}
	
	/**
	 * add permission to role
	 *
	 * @param	int		$role_id	the unique identifier for the role
	 * @param	int		$perm_id	the unique identifier for the permission
	 * @return	boolean	TRUE/FALSE - whether or not addition was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function add_role_perm($role_id, $perm_id) {
		$this->db->insert($this->_config->table['role_perm'], array(
			'role_id' => $role_id,
			'perm_id' => $perm_id
		));
		return ($this->db->affected_rows() == 1);
	}
	
	/**
	 * remove permission from role
	 *
	 * @param	int		$role_id	the unique identifier for the role
	 * @param	int		$perm_id	the unique identifier for the permission
	 * @return	boolean	TRUE/FALSE - whether or not removal was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function del_role_perm($role_id, $perm_id) {
		$this->db->delete($this->_config->table['role_perm'], array(
			'role_id' => $role_id,
			'perm_id' => $perm_id
		));
		return ($this->db->affected_rows() == 1);
	}
	
}

/* End of file acl_model.php */
/* Location: ./application/models/acl_model.php */