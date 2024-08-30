<?php
	
class CGD_HostingControl_Admin {
	public function __construct() {
		add_action('admin_menu', array($this, 'admin_menu'), 0);		
		add_action('admin_init', array($this, 'process_actions'), 1 );
	}
	
	function admin_menu() {
		add_menu_page( 'CGD Hosting Control', 'CGD', 'manage_options', 'cgd-hosting-control', array($this, 'render_admin'), 'dashicons-admin-generic', 1 );
	}
	
	function render_admin() {
		?>
		<div class="wrap" style="max-width: 800px;">
			<h2>CGD Hosting Control</h2>
			<h3>Cache Management</h3>
			
			<h4>Clear Opcache</h4>
			<p>Each PHP file is cached whenever it is executed to allow for maximum performance. Whenever a PHP file is edited, this cache will need to be cleared.</p><p><b>Note: Plugin and WordPress updates will automatically clear opcache.</b></p>
			
			<p><a class="button button-secondary" href="<?php echo wp_nonce_url( admin_url("admin.php?page=cgd-hosting-control"), 'clear-opcache', 'cgd_nonce' ); ?>">Clear Opcache</a></p>
			
			<h4>Clear Object Cache</h4>
			<p>WordPress uses object caching to speed up access to frequently used information. Most of the time WordPress does a good job of managing this cache by itself, but sometimes it's necessary to manually clear the object cache.</p>
			<p><a class="button button-secondary" href="<?php echo wp_nonce_url( admin_url("admin.php?page=cgd-hosting-control"), 'clear-object', 'cgd_nonce' ); ?>">Clear Object Cache</a></p>
			
			<h4>Clear All Caches</h4>
			<p>A one stop shop. Clear all the caches.</p>
			<p><a class="button button-primary" href="<?php echo wp_nonce_url( admin_url("admin.php?page=cgd-hosting-control"), 'clear-all', 'cgd_nonce' ); ?>">Clear All Caches</a></p>
		</div>
		<?php
	}
	
	function process_actions( $redirect = false ) {
		if ( ! current_user_can('manage_options') ) return; 
		
		if ( isset($_GET['page']) && $_GET['page'] == "cgd-hosting-control" && isset($_GET['updated']) ) {
			add_action( 'admin_notices', array($this, 'cache_clear_notice') );
		}
		
		if ( isset($_GET['cgd_nonce']) && wp_verify_nonce($_GET['cgd_nonce'], 'clear-opcache') ) {
			$redirect = true;
			CGD_HostingControl_Opcache::clear();			
		}
		
		if ( isset($_GET['cgd_nonce']) && wp_verify_nonce($_GET['cgd_nonce'], 'clear-object') ) {
			$redirect = true;
			CGD_HostingControl_Object_Cache::clear();			
		}
		
		if ( isset($_GET['cgd_nonce']) && wp_verify_nonce($_GET['cgd_nonce'], 'clear-all') ) {
			$redirect = true;
			CGD_HostingControl_Opcache::clear();
			CGD_HostingControl_Object_Cache::clear();			
		}
		
		if ( $redirect ) {
			wp_redirect( admin_url("admin.php?page=cgd-hosting-control&updated=true") );
		}
	}
	
	function cache_clear_notice() {
		echo "<div class='updated'><p>Selected cache(s) cleared successfully.</p></div>";
	}
}