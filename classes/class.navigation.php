<?php

namespace magneti;

class Navigation {
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'register_menus' ] );
	}

	public function register_menus() {
		register_nav_menus( [
			'primary' => __( 'Primary Menu', 'magneti' ),
			'footer'  => __( 'Footer Menu', 'magneti' ),
			'helpline'  => __( 'Helpline Menu', 'magneti' ),
		] );
	}
}

new Navigation();
