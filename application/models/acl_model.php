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
 * @since		2012.12.23
 */

// ------------------------------------------------------------------------

/**
 * ACL Model
 * 
 * Provides a set of simple functions for interacting with data relating to 
 * user roles and permissions
 * 
 * @package		ACL
 * @subpackage	Models
 * @author		William Duyck <wemd2@kent.ac.uk>
 *
 * @todo	test logic, not just sytax
 */
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
	 * get users roles
	 *
	 * @param	string	$user_id	the unique identifier for the user
	 * @return	array	array of CodeIgniter row objects containing the user roles
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_user_roles($user_id) {
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
	|  role specific methods
	| -------------------------------------------------------------------
	*/
	
	/**
	 * get all roles details
	 *
	 * @return	array	an array of CodeIgniter row objects for role
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_all_roles() {
		$roles = $this->db->get($this->_config->table['role']);
		return ($roles->num_rows() > 0) ? $roles->result() : FALSE;
	}
	
	/**
	 * get roles by constraint
	 *
	 * @param	string	$field	the field to constrain
	 * @param	mixed	$value	the required value of field
	 * @return	object	a CodeIgniter row object for role
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter row object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_role_by($field, $value) {
		$this->db->where($field, $value);
		return $this->get_all_roles();
	}
	
	/**
	 * get details of a role
	 *
	 * @param	int		$role_id	the unique identifier for the role
	 * @return	object	a CodeIgniter row object for role
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter row object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 *
	 * @todo	return permissions associated w/ role as well
	 */
	public function get_role($role_id) {
		$role = $this->get_role_by('role_id', $role_id);
		return ($role !== FALSE) ? $role[0] : FALSE;
	}
	
	/**
	 * add new role to database
	 *
	 * @param	string	$data		the new roles data	
	 * @return	boolean	TRUE/FALSE - whether addition was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function add_role($data) {
		$this->db->insert($this->_config->table['role'], $data);
		return ($this->db->affected_rows() == 1);
	}
	
	/**
	 * remove role from database
	 *
	 * @param	int		$role_id	the unique identifier for the role
	 * @return	boolean	TRUE/FALSE - whether addition was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function del_role($role_id) {
		$this->db->insert($this->_config->table['role'], array('role_id' => $role_id));
		return ($this->db->affected_rows() == 1);
	}
	
	/**
	 * update a roles data
	 *
	 * @param	int		$role_id	the unique identifier for the role
	 * @param	string	$data		the new roles data	
	 * @return	boolean	TRUE/FALSE - whether update was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function edit_role($role_id, $data) {
		$this->db->update($this->_config->table['role'], $data, array('role_id' => $role_id));
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
	 * @return	array	array of CodeIgniter row objects for role permissions
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
	
	/*
	| -------------------------------------------------------------------
	|  permission specific methods
	| -------------------------------------------------------------------
	*/
	
	/**
	 * get all permissions
	 *
	 * @return	array	an array of CodeIgniter row objects for permission
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_all_perms() {
		$perms = $this->db->get($this->_config->table['perm']);
		return ($perms->num_rows() > 0) ? $perms->result() : FALSE;
	}
	
	/**
	 * get permission by constraint
	 *
	 * @param	string	$field	the field to constrain
	 * @param	mixed	$value	the value field should be
	 * @return	array	an array of CodeIgniter row objects for permissions
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_perm_by($field, $value) {
		$this->db->where($field, $value);
		return $this->get_all_perms();
	}
	
	/**
	 * get a specific permissions
	 *
	 * @param	int	$perm_id	the unique identifier for the permission (id not value)
	 * @return	object	a CodeIgniter row object for permission
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter row object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function get_perm($perm_id) {
		$perm = $this->get_perm_by('perm_id', $perm_id);
		return ($perm !== FALSE) ? $perm[0] : FALSE;
	}
	
	/**
	 * add a permission
	 *
	 * @param	assoc_array	$data	the new permissions data
	 * @return	boolean		TRUE/FALSE - whether addition was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function add_perm($data) {
		$this->db->insert($this->_config->table['perm'], $data);
		return ($this->db->affected_rows() == 1);
	}
	
	/**
	 * delete a permission
	 *
	 * @param	int		$perm_id	the unique identifier for the permission (id not value)
	 * @return	boolean	TRUE/FALSE - whether addition was successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function del_perm($perm_id) {
		$this->db->delete($this->_config->table['perm'], array('perm_id' => $perm_id));
		return ($this->db->affected_rows() == 1);
	}
	
	/**
	 * update a permission
	 *
	 * @param	int			$perm_id	the unique identifier for the permission (id not value)
	 * @param	assoc_array	$data		the new data for permission
	 * @return	boolean		TRUE/FALSE - whether or not update successful
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function edit_perm($perm_id, $data) {
		$this->db->update($this->_config->table['perm'], $data, array('perm_id' => $perm_id));
		return ($this->db->affected_rows() == 1);
	}
	
	/*
	| -------------------------------------------------------------------
	|  user permission relation
	| -------------------------------------------------------------------
	*/
	
	/**
	 * get a users permissions based off those in users roles
	 *
	 * @param	int		$user_id	the unique identifier for the user
	 * @return	array	an array of CodeIgniter row objects for permissions
	 * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 *
	 * @todo	refactor code to use complex sql **instead** of rest of model, and multiple sql calls.
	 */
	public function get_user_perms($user_id) {
		// hold on tight... this is a complicated one... and will be 
		// rolled into a single sql query if possible at a later date w/ diff logic. (might be possible)
		$rtn = array();
		
		// get users roles
		$roles = $this->get_user_role($user_id);
		
		// check role(s) set
		if($roles === FALSE) {
			return $rtn;
		}
		
		// for each role get its perms and add them to return array
		foreach($roles as $role) {
			// get role perms
			$perms = $this->get_role_perms($role->role_id);
			
			// check perms assigned to role
			if($perms === FALSE) {
				return $rtn;
			}
			
			array_push($rtn, $perms);
		}
		
		// return permission value total and return
		return array_unique($rtn);
	}
	
	/*
	| -------------------------------------------------------------------
	|  helper/utility methods for acl usage
	| -------------------------------------------------------------------
	*/
	
	/**
	 * user permission check
	 *
	 * Checks a user has the required permission.
	 *
	 * @param	string	$user_id	the user to check permission on
	 * @param	string	$slug		the permission required
	 * @return	boolean	TRUE/FALSE - whether or not user has permission
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function user_has_perm($user_id, $slug) {
		$perms = $this->get_user_perms($user_id);
		
		// loop through users permissions and check for the slug
		foreach($perms as $perm) {
			// if slug is found then return TRUE
			if($perm->slug === $slug) {
				return TRUE;
			}
		}
		
		// if we make it to here the user doesn't have permission
		return FALSE;
	}
	
	/**
	 * user role check
	 *
	 * @param	int		$user_id	the unique identifier for the uer
	 * @param	string	$slug		the role required
	 * @return	boolean	TRUE/FALSE - whether or not the user has role
	 * @author	William Duyck <fuzzyfox0@gmail.com>
	 */
	public function user_has_role($user_id, $slug) {
		return ($this->get_user_roles($user_id) !== FALSE);
	}
}

/* End of file acl_model.php */
/* Location: ./application/models/acl_model.php */