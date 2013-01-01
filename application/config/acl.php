<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Table names
|--------------------------------------------------------------------------
|
| If you have different names for the tables required for the acl to work 
| please enter those below.
|
*/
$config['acl']['table']['user']			= 'user';
$config['acl']['table']['role']			= 'role';
$config['acl']['table']['user_role']	= 'user_role';
$config['acl']['table']['perm']			= 'perm';
$config['acl']['table']['role_perm']	= 'role_perm';

/*
|--------------------------------------------------------------------------
| ACL Provided Sign In
|--------------------------------------------------------------------------
|
| It is recommended that for any production projects that you set this to 
| `FALSE` and impliment a more robust, and secure user authentication 
| system, however the ACL provided sign in will surfice for most testing, 
| and development environments.
|
*/

$config['acl']['sign_in_enabled'] = TRUE;

/* End of file acl.php */
/* Location: ./application/config/acl.php */