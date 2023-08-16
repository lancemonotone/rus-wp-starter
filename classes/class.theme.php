<?php namespace magneti;

class Theme {
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'add_theme_support' ] );
		add_filter( 'body_class', [ $this, 'add_body_classes' ] );
		add_filter( 'upload_mimes', [ $this, 'add_svg_upload_support' ] );
	}

	public function add_theme_support() {
		add_theme_support( 'title-tag' );
	}

	public function add_body_classes( $classes ) {
		// Add the host name as a class to target local vs staging vs production
		$classes[] = str_replace( '.', '-', $_SERVER['HTTP_HOST'] );
		// $classes[] = 'theme-light color-scheme-default';
		$classes[] = 'lang-' . CURRENT_LANG;

		return $classes;
	}

	// allow SVGs to be uploaded to media library
	public function add_svg_upload_support($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
}

new Theme();