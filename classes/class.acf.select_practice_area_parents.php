<?php namespace magneti;

class Select_Practice_Area_Parents {
	public function __construct() {
		add_filter( 'acf/load_field/name=select_practice_area_parents', [ $this, 'get_practice_area_parents' ] );
	}

	/**
	 * Retrieves child pages of the 'practice-areas' page if they
	 * have children themselves, and stores them as choices in a field array.
	 *
	 * @param $field
	 *
	 * @return mixed
	 */
	public function get_practice_area_parents( $field ) {
		// $parent_slugs = implode( "','", [
		// 	'practice-areas',
		// 	'causes',
		// 	'injuries',
		// ] );

		global $wpdb;

		$results = $wpdb->get_results(
			"SELECT DISTINCT 
					    p1.ID AS parent_id,
						p1.post_title AS parent_title
					FROM {$wpdb->posts} p1
					JOIN {$wpdb->posts} p2 ON p1.ID = p2.post_parent
					WHERE p1.post_type = 'page'
					AND p1.post_status = 'publish'
					AND p2.post_type = 'page'
					AND p2.post_status = 'publish'
					GROUP BY parent_id
					ORDER BY parent_title, parent_id;",
			ARRAY_A );

		$children = [];
		foreach ( $results as $key => $result ) {
			$children[ $result['parent_id'] ] = $result['parent_title'];
		}

		// This returns an optgroup with the parent page title as the label
		// $children       = [];
		// $current_parent = "";
		// foreach ( $results as $item ) {
		// 	$parent_title = $item['parent_title'];
		// 	$child_id     = $item['child_id'];
		// 	$child_title  = $item['child_title'];
		//
		// 	if ( $parent_title != $current_parent ) {
		// 		$current_parent = $parent_title;
		// 	}
		// 	$children[ $current_parent ][ $child_id ] = $child_title;
		// }

		$field['choices'] = $children;

		return $field;
	}

}

new Select_Practice_Area_Parents;
