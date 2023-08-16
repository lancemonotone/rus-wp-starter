<?php namespace magneti;

/**
 * This parser is designed to work specifically with SCSS files that are structured
 * with a $theme-colors list and --color variables. If the structure of your SCSS files
 * changes in the future, you might need to update the parser to match.
 *
 * Example SCSS structure:
 *
 * $theme-colors: (
 *     "text",
 *     "background",
 *     "white",
 *     "primary-dark",
 *     "primary-mid",
 *     "primary-light",
 *     "accent"
 * );
 *
 * :root {
 *     --text: #121212;
 *     --background: #E5E5E5;
 *     --white: #FFFFFF;
 *     --primary-dark: #224C66;
 *     --primary-mid: #286AA6;
 *     --primary-light: #00A3DA;
 *     --accent: #F15A2C;
 * }
 *
 * The parser will extract the color slugs and their corresponding color codes. It will ignore any variables
 * not listed in the $theme-colors list.
 */
class Editor_Palette_Color_Parser {
    static array $color_array = [];

    /**
     * Get an array of color slugs and their corresponding color codes.
     *
     * @param string $scss_input_path
     *
     * @return array
     */
    public static function get_color_array( string $scss_input_path ): array {
        // First, check if static $color_array is set and use it if so.
        if ( false === ( $color_array_transient = get_transient( 'color_array_transi' ) ) ) {
            // If the transient isn't set, then set it with our data.
            // Get SCSS content
            if ( ! file_exists( $scss_input_path ) ) {
                return [];
            }

            $scss_content = file_get_contents( $scss_input_path );

            // Extract theme colors from SCSS content
            preg_match( '/\$theme-colors: \(([^)]*)\)/', $scss_content, $theme_matches );

            $theme_colors = [];
            foreach ( explode( ',', $theme_matches[ 1 ] ) as $value ) {
                $trimmed = trim( $value, "\n\r\t\v\0 \"" );

                if ( ! empty( $trimmed ) ) {
                    $theme_colors[] = $trimmed;
                }
            }

            // Extract color variables and their values from SCSS content
            preg_match_all( '/(--[\w-]+):\s*(#[0-9a-fA-F]+);/', $scss_content, $matches, PREG_SET_ORDER );

            $color_array = [];
            foreach ( $matches as $match ) {
                // Only include colors that are in theme colors
                $color_slug = substr( $match[ 1 ], 2 );  // Remove $ from variable name to get the slug

                if ( in_array( $color_slug, $theme_colors ) ) {
                    $color_name = str_replace( '-', ' ', $color_slug ); // Remove -- from variable name to get the name
                    $color_name = ucwords( $color_name );

                    $color_array[] = [
                        'name'  => $color_name,
                        'slug'  => $color_slug,
                        'color' => $match[ 2 ],
                    ];
                }
            }

            set_transient( 'color_array_transi', $color_array, 86400 ); // Store for 1 day.
        } else {
            $color_array = $color_array_transient;
        }

        return $color_array;
    }

}

// $scss_color_parser = new Scss_Color_Parser( $scss_input_path );
// $color_array       = $scss_color_parser->get_color_array();
//
// print_r( $color_array );