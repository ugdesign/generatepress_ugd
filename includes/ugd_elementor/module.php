<?php
/*
    Plugin Name: UDG Custom Libraries
    Program:      ./includes/ugd_elementor/module.php
    Version:      1.0
    Date Started: 29/04/2020
    Copyright:    Underground Design
    Description:
    * routines used for Elementor plugin
*/

require_once(dirname(__FILE__).'/ugd_elementor_dynamic_tags.php');


function ugd_elementor_testing1() {
    echo '<br/>Hello Elementor World1!';
    //echo '<br/>'.dirname(__FILE__).'/ugd_elementor_dynamic_tags.php';
}

//add_shortcode( 'ugd_elementor_test1', 'ugd_elementor_testing1' );

?>
