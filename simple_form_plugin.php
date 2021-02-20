<?php
/*
Plugin Name: Simple Form
Plugin URI:  https://github.com/surlogu
Description: Simple form plugin for test. Form display by placing a shortcode.
Version:     1.0
Author:      surlogu
Author URI:  http://surlogucv.cf
*/

function simpleform_activation() {

}
register_activation_hook(__FILE__, 'simpleform_activation');

function simpleform_deactivation() {

}
register_deactivation_hook(__FILE__, 'simpleform_deactivation');

function simpleform_uninstall() {

}
register_uninstall_hook(__FILE__, 'simpleform_uninstall');

/**
@return string $html The raw HTML of contact form
 */
function simpleform_core() {
	$html = '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
	$html .= '<p>';
	$html .= 'Your Name (required)<br />';
	$html .= '<input type="text" name="simpleform-name" pattern="[a-zA-Z0-9]+" value="' . ( isset( $_POST["simpleform-name"]) ? esc_attr( $_POST["simpleform-name"] ) : '') . '" size="40" />';
	$html .= '</p>';
	$html .= '<p>';
	$html .= 'Your Email (required) <br />';
	$html .= '<input type="email" name="simpleform-email" value="' . ( isset( $_POST["simpleform-email"] ) ? esc_attr( $_POST["simpleform-email"] ) : '') . '" size="40" />';
	$html .= '</p>';
	$html .= '<p>';
	$html .= 'Subject (required) <br />';
	$html .= '<input type="text" name="simpleform-subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["simpleform-subject"] ) ? esc_attr( $_POST["simpleform-subject"] ) : '' ) . '" size="40" />';
	$html .= '</p>';
	$html .= '<p><input type="submit" name="simpleform-submitted" value="Send" /></p>';
	$html .= '</form>';

	echo $html;
}

	if ( isset( $_POST['simpleform-submitted'] ) ) {
			echo '<div>';
			echo '<p>Thanks for submit.</p>';
			echo '</div>';
		} else {
			echo '<p style="color:red;">An unexpected error occured.</p>';
		}


function simpleform_shortcode() {
	ob_start();
	simpleform_core();

	return ob_get_clean();
}

add_shortcode('test_form', 'simpleform_shortcode');
