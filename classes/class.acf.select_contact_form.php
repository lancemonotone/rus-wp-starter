<?php namespace magneti;

class Select_Contact_Form {
	public function __construct() {
		add_filter( 'acf/load_field/name=select_form', [ $this, 'populate_form_select' ] );
	}

	/**
	 * Queries the `contact_forms` repeater field in the `options` page
	 * and populates the `select_form` select field in a flexible content layout.
	 *
	 * @param $field
	 *
	 * @return array
	 */
	public function populate_form_select( $field ): array {
		if ( ! is_admin() ) {
			return $field;
		}

		$form_titles = [];

		// Loop through each layout within the 'options' flexible content field
		if ( have_rows( 'options', 'option' ) ) {
			while ( have_rows( 'options', 'option' ) ) {
				the_row();

				// Check if the current layout is the 'contact_forms' layout
				if ( get_row_layout() == 'contact_forms' ) {

					$contact_forms_object = get_sub_field_object( 'contact_forms' );

					if ( ! empty( $contact_forms_object['value'] ) ) {
						foreach ( $contact_forms_object['value'] as $contact_form ) {
							$form_titles[ $contact_form['form_id'] ] = $contact_form['form_title'];
						}
					}
				}
			}
		}

		$field['choices'] = $form_titles;

		return $field;
	}
}

new Select_Contact_Form();
