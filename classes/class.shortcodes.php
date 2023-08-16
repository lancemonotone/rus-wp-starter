<?php

namespace magneti;

class Shortcodes {
	public static array $shortcodes = [
        // 'expando' => [
        //     'func'     => 'print_expando_shortcode',
        //     'template' => [ 'text' => 'Expando', 'value' => '[expando title="Read more"]Content[/expando]' ]
        // ],
		'menu'        => [
			'func'     => 'print_nav_menu_shortcode',
			'template' => [ 'text' => 'Navigation Menu', 'value' => '[menu name="" class=""]' ]
		],
		'button'      => [
			'func'     => 'print_button_shortcode',
			'template' => [ 'text' => 'Button', 'value' => '[button url="#" class="" target=""]Button[/button]' ]
		],
		'shortcode_1' => [
			'func'     => 'print_shortcode_1_shortcode',
			'template' => [ 'text' => 'Shortcode 1', 'value' => '[shortcode_1]' ]
		],
	];

	public function __construct() {
		foreach ( self::$shortcodes as $shortcode => $data ) {
			add_shortcode( $shortcode, [ $this, $data['func'] ] );
		}
	}

	public static function get_shortcodes(): array {
		return self::$shortcodes;
	}

	/**
	 * Return shortcode value defined on Options page
	 *
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	function print_shortcode_1_shortcode( $atts = [], $content = NULL ): string {
		$return = get_field( 'shortcode_1', 'option' );

		return $return ? $return : '';
	}

    /**
     * Return shortcode with attributes
     * [expando title="Read more"]Content[/expando]
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    // function print_expando_shortcode( $atts = [], $content = NULL ): string {
    //     $shortcode_atts = shortcode_atts( [ 'title' => '' ], $atts );
    //     $title          = $shortcode_atts['title'];
    //
    //     return '<div class="expando"><div class="expando-title">' . $title . '</div><p class="expando-content">' . $content . '</p></div>';
    // }

	/**
	 * Return shortcode with attributes
	 * [menu name="" class=""]
	 *
	 * @param array $atts
	 * @param null $content
	 *
	 * @return bool|string|null
	 */
	function print_nav_menu_shortcode( $atts = [], $content = NULL ): bool|string|null {
		$shortcode_atts = shortcode_atts( [ 'name' => '', 'class' => '' ], $atts );
		$name           = $shortcode_atts['name'];
		$class          = $shortcode_atts['class'];

		return wp_nav_menu( array( 'menu' => $name, 'menu_class' => $class, 'echo' => FALSE ) );
	}

	/**
	 * Return shortcode with attributes
	 * [button url="#" class="" target=""]Button[/button]
	 *
	 * @param array $atts
	 * @param null $content
	 * @return string
	 */
	function print_button_shortcode( $atts, $content = 'Button' ): string {
		$content = trim( str_replace( [ '<p>', '</p>' ], "", $content ) );

		$atts = shortcode_atts( [
			'url'    => '#',
			'target' => '',
			'class'  => ''
		], $atts );

		//force content
		if ( ! $content || $content == '' ) {
			$content = 'Button';
		}

		//return
		return <<<EOD
		<a href="{$atts['url']}" class="button {$atts['class']}" target="{$atts['target']}">{$content}</a>
EOD;

	}
}

new Shortcodes();
