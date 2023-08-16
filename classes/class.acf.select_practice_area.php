<?php namespace magneti;

class Select_Practice_Area {
	public function __construct() {
		add_filter( 'acf/load_field/name=select_practice_area', [ $this, 'get_practice_areas' ] );
	}

	/**
	 * Retrieves an array of the slug and name of each published page that is
	 * a direct child of the 'practice-areas' page. It uses WordPress functions
	 * such as get_page_by_path() and get_pages() to optimize performance, and
	 * returns the array as the value of a field.
	 *
	 * @param $field
	 *
	 * @return void
	 */
	function get_practice_areas( $field ) {
		$parent_slug = 'practice-areas';
		$parent_page = get_page_by_path( $parent_slug );

		if ( ! $parent_page ) {
			return $field; // Parent page not found
		}

		$args = array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'parent'      => $parent_page->ID,
			'fields'      => 'ids', // Only return IDs to optimize performance
		);

		$child_pages = get_pages( $args );

		$results = array();
		foreach ( $child_pages as $child_id ) {
			$child                        = get_post( $child_id );
			$results[ $child->ID ] = $child->post_title;
		}

		$field['choices'] = $results;

		return $field;
	}

}

new Select_Practice_Area();
