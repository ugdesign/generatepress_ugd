<?php
/**
 * GeneratePress child theme custom functions and definitions (by Underground Design)
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function ugd_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'ugd_enqueue_scripts', 100 );


/* Includes */
require_once(dirname(__FILE__).'/includes/modules.php');
