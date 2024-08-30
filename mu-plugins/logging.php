<?php
/**
 * Plugin Name: Custom Debug Settings
 */

/**
 * Suppress errors generated by specified WordPress plugins.
 *
 * Include in the auto_prepend_file php.ini directive to ignore globally.
 *
 * @see http://plugins.trac.wordpress.org/browser/ostrichcize/tags/0.1/ostrichcize.php#L146
 *
 * @param string $errno The error number.
 * @param string $errstr The error message.
 * @param string $errfile Path to the file that caused the error.
 * @param int    $errline Line number of the error.
 *
 * @return bool True to success error reporting; false to use default error handler.
 */
function blazersix_error_handler( $errno, $errstr, $errfile, $errline ) {

	// Return true to disable all strict notices.
	if ( E_STRICT === $errno ) { // phpcs:ignore
		// e.g. return true;.
	}

	// Add path to file to suppress error logs on the entire file/theme/plugin.
	$files = array(
		'/Volumes/WebDev/sites/Objectiv/kitces/site/wp-content/plugins/memberium-ac/lib/core.php',
		'/Volumes/WebDev/sites/Objectiv/kitces/site/wp-content/plugins/memberium-ac/classes/core.php',
		'/Volumes/WebDev/sites/Objectiv/kitces/site/wp-content/plugins/chartbeat/chartbeat.php'
	);

	foreach ( $files as $file ) {
		$file = str_replace( array( '/', '\\' ), DIRECTORY_SEPARATOR, $file );

		if ( false !== strpos( $errstr, $file ) ) {
			return true;
		}

		if ( false !== strpos( $errfile, $file ) ) {
			return true;
		}
	}

	// Add text found in the error string to suppress error log.
	$strings = array(
		'Undefined property: wpal_menu_access',
		'Undefined variable: analytics',
		'Function create_function()',
		'Undefined index: author',
		'Undefined index: sections',
		'wp_enqueue_script was called',
		'Xdebug: [Step Debug] Could not connect to debugging client. Tried: localhost:9003',
	);

	foreach ( $strings as $string ) {
		if ( false !== strpos( $errstr, $string ) ) {
			return true;
		}
	}

	// The path was not found, so report the error.
	return false;
}
set_error_handler( 'blazersix_error_handler' ); // phpcs:ignore

ini_set( 'error_log', '/Volumes/WebDev/Logs/wp-debug.log' );