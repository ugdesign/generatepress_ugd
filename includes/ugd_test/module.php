<?php
/*
    Plugin Name: UDG Custom Modules
    Program:      ./includes/ugd_test/module.php
    Version:      1.0
    Date Started: 029/04/2018
    Copyright:    Underground Design
    Description:
    * routines used for testing
*/

function ugd_testing() {
    echo 'Is User Logged In:'.is_user_logged_in();
}

add_shortcode( 'ugd_test', 'ugd_testing' );

?>