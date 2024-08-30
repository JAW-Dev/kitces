<?php

class CGD_HostingControl_Object_Cache {
	public function __construct() {}

	public static function clear() {
		wp_cache_flush();
	}
}