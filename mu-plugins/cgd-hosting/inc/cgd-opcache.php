<?php

class CGD_HostingControl_Opcache {
	public function __construct() {}

	public static function clear() {
		$status = opcache_get_status();

		foreach($status['scripts'] as $script => $details) {
			if ( strpos($script, ABSPATH) === 0 ) {
				opcache_invalidate($script);				
			}
		}
	}
}