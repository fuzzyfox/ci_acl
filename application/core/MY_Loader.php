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
 * Loader Class (extended)
 * 
 * Loads views and files, with the extended ability to load themed views, 
 * and test cases. Based on previous work by William Duyck.
 * 
 * @package		ACL
 * @subpackage	Core
 * @author		William Duyck <wduyck@kent.ac.uk>
 * @category	Loader
 * @copyright	Copyright (c) 2012, William Duyck
 * @license		http://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */
class MY_Loader extends CI_Loader {
	
	/**
	 * Load View
	 * 
	 * This modified function is used to load a "view" file. It has four parameters:
	 * 
	 * Usage:
	 * 	
	 * 	// w/o theme
	 * 	$this->load->view('my_view');
	 * 	
	 * 	// w/ theme
	 * 	$this->load->view('my_view', NULL, FALSE, 'my_template');
	 * 
	 * @param	string		$view	The name of the "view" file to be included.
	 * @param	assoc_array	$vars	An associative array of data to be extracted for use in the view.
	 * @param	boolean		$return	TRUE/FALSE - whether to return data or load it.
	 * @param	boolean		$theme	TRUE/FALSE - whether to load data within a "theme".
	 */
	public function view($view, $vars = array(), $return = FALSE, $theme = FALSE) {
		if($theme) {
			$vars['ci_view'] = parent::view($view, $vars, TRUE);
			return parent::view('theme/' . $theme, $vars, $return);
		}
		else {
			return parent::view($view, $vars, $return);
		}
	}
	
}

/* End of file CSProj_Loader.php */
/* Location: ./application/core/CSProj_Loader.php */