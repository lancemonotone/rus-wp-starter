<?php namespace magneti;

class Assets {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueueScripts' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'template_admin_css' ], 10 );

        // dequeue WP Block Library CSS
        remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
        remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
        add_action( 'wp_enqueue_scripts', [$this, 'remove_wp_block_library_css'], 100 );
    }

    public function remove_wp_block_library_css() {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
    }

    /**
     * Enqueue scripts for pages using templates defined in
     * class ACF, which use new Vite build system.
     */
    public function enqueueScripts() {
        $css = '/css/index.css';
        $js  = '/js/index.js';

        $css_version = filemtime( THEME_BUILD_PATH . $css );
        $js_version  = filemtime( THEME_BUILD_PATH . $js );

        wp_enqueue_style( 'magneti', THEME_BUILD_URI . $css, [], $css_version );
        wp_enqueue_script( 'magneti', THEME_BUILD_URI . $js, [ 'jquery' ], $js_version, true );
    }

    /**
     * Enqueue admin styles for pages using templates defined in
     * class ACF, which use new Vite build system.
     */
    public function template_admin_css() {
        $file     = '/assets/build-admin/css/admin.css';
        $filepath = get_template_directory() . $file;
        $version  = file_exists( $filepath ) ? filemtime( $filepath ) : false;
        wp_enqueue_style( 'template_admin_css', get_template_directory_uri() . $file, false, $version );
    }

}

new Assets();
