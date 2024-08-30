<?php
/*
Plugin Name: CGD Hosting Control
Plugin URI: http://cgd.io
Description:  CGD Hosting Control Panel
Version: 1.0.1
Author: CGD Inc.
Author URI: http://cgd.io

------------------------------------------------------------------------
Copyright 2009-2015 Clif Griffin Development Inc.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

class CGD_HostingControl {
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action('init', array($this, 'load_modules'), 0 );
		
		// Catch All Updates
		add_action('upgrader_process_complete', array($this, 'handle_updates'), 10, 2); 
	}
	
	/**
	 * load_modules function.
	 * 
	 * @access public
	 * @return void
	 */
	function load_modules() {
		
		if ( is_admin() && ( ! defined('DOING_AJAX') || ! DOING_AJAX ) ) {
			include('inc/class-admin.php');
			new CGD_HostingControl_Admin();
		}
			
		
		/**
		 * Cache Handlers
		 */

		// Opcache Handler
		include('inc/cgd-opcache.php');
		new CGD_HostingControl_Opcache();

		// Object Cache Handler
		include('inc/cgd-object-cache.php');
		new CGD_HostingControl_Object_Cache();
		
		// Static Cache Handler
		//include('inc/cgd-static-cache.php');
		//new CGD_HostingControl_Static_Cache();

	}
	
	/**
	 * handle_module_updates function.
	 * 
	 * @access public
	 * @param mixed $object
	 * @param mixed $options
	 * @return void
	 */
	function handle_updates($object, $options) {
		if ( isset($options['action']) && $options['action'] == "update" ) {
			CGD_HostingControl_Opcache::clear(); // go ahead and clear all for this site
		}
	}
}

$CGD_HostingControl = new CGD_HostingControl();