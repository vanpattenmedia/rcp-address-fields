<?php


/**
 * Overrides the default country listing
 *
 * @return array $countries
 */
function rcpaf_restrict_countries_filter() {
	$countries = array(
		'US' => __( 'United States (US)', 'rcp-address-fields' ),
		'CA' => __( 'Canada', 'rcp-address-fields' ),
		'GB' => __( 'United Kingdom (UK)', 'rcp-address-fields' )
	);

	return $countries;
}
// add_filter( 'rcpaf_restrict_countries', 'rcpaf_restrict_countries_filter' );

/**
 * Overrides the which fields are required for addresses
 *
 * @return array $required_fields
 */
function rcpaf_required_fields_filter() {
	$required_fields = array(
		'address_1',
		'city',
		'state',
		'country'
	);

	return $required_fields;
}
// add_filter( 'rcpaf_required_fields', 'rcpaf_required_fields_filter' );

/**
 * Overrides which fields to save for address fields
 *
 * @return array $fields_to_save
 */
function rcpaf_fields_to_save_filter() {
	$fields_to_save = array(
		'address_1',
		'address_2',
		'city',
		'state',
		'country'
	);
	
	return $fields_to_save;
}
// add_action( 'rcpaf_fields_to_save', 'rcpaf_fields_to_save_filter' );

/**
 * Determines which address fields should be select inputs `select > option`
 *
 * @return array $select_fields
 */
function rcpaf_select_field_names_filter() {
	$select_fields = array(
		'country'
	);

	return $select_fields;
}
// add_filter( 'rcpaf_select_field_names', 'rcpaf_select_field_names_filter' );

/**
 * Overrides the markup/output of text fields in front-facing UIs
 *
 * @param string $field_html
 * @param array $field
 *
 * @return string
 */
function rcpaf_public_text_field_filter( $field_html, $field ) {
	$template = '<p id="rcp_%1$s_wrap"><label for="rcp_%1$s">%2$s</label><input name="rcp_%1$s" id="rcp_%1$s" type="%4$s" value="%3$s"></p>';

	return sprintf( $template,
		$field['slug'],
		$field['label'],
		$field['data'],
		$field['type']
	);
}
//add_filter( 'rcpaf_public_text_field', 'rcpaf_public_text_field_filter', 10, 2 );

/**
 * Overrides the markup/output of text fields in admin UIs
 *
 * @param string $field_html
 * @param array $field
 *
 * @return string $field_html
 */
function rcpaf_admin_text_field_filter( $field_html, $field ) {
	$wrap = '<tr valign="top" id="rcp_%3$s_wrap"><th scope="row" valign="top">%1$s</th><td>%2$s</td></tr>';

	$label_template = '<label for="rcp_%1$s">%2$s</label>';
	$input_template = '<input name="rcp_%1$s" id="rcp_%1$s" type="%3$s" value="%2$s">';

	$label = sprintf( $label_template, $field['slug'], $field['label'] );
	$input = sprintf( $input_template, $field['slug'], $field['data'], $field['type'] );

	$field_html = sprintf( $wrap, $label, $input, $field['slug'] );

	return $field_html;
}
//add_filter( 'rcpaf_admin_text_field', 'rcpaf_admin_text_field_filter', 10, 2 );