<?php
header('HTTP/1.1 200 OK');

define('WP_USE_THEMES', false);

/** Loads the WordPress Environment */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );


$id = 3;

$form_fields = Ninja_Forms()->form( $id )->get_fields();
$key_to_fieldname = array();
foreach ( $form_fields as $form_field ) {
	$key_to_fieldname[ $form_field->get_setting( 'key' ) ] = $form_field->get_setting( 'label' );
}
unset( $key_to_fieldname[ 'submit' ] );  // Do not need 'Submit' info as there won't be any data in it.
echo '<pre>', var_export( $key_to_fieldname, true ), '</pre>';


$submissions = Ninja_Forms()->form( $id )->get_subs();
echo '<style>table, th, td { border: 1px solid #ccc; border-collapse: collapse; } td { padding: 1em; } th { font-weight: bold; }</style>';
echo '<table><tr><th>', implode( '</th><th>', array_values( $key_to_fieldname ) ), '</th></tr>';
foreach ( $submissions as $submission ) {
	$values = $submission->get_field_values();

	echo '<tr>';
	foreach ( $key_to_fieldname as $key => $name ) {
		if ( array_key_exists( $key, $values ) ) {
			echo '<td>', $values[ $key ], '</td>';
		}
	}
	echo '</tr>';
}
echo '</table>';