<?php
/*
    Plugin Name: UDG Custom Modules
    Program:      ./includes/ugd_elementor/ugd_failed_login_edirect.php
    Version:      1.0
    Date Started: 29/06/2020
    Copyright:    Underground Design
    Description:
    * routines to handle redirection from failed logins when using elementor login forms
    see https://wordpressflow.com/elementor-on-failed-logins-on-the-login-form-redirect-back-to-the-login-page-and-add-a-failed-message/
    see WPTuts tutorial https://www.youtube.com/watch?v=jY6bFnpZ450
*/

// Redirect the user back to the login page after the login failed, and add a $_GET parameter to let us know. Courtesy of WordPressFlow.com
add_action( 'wp_login_failed', 'ugd_elementor_form_login_fail', 9999999 );
function ugd_elementor_form_login_fail( $username ) {
    $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
    // if there's a valid referrer, and it's not the default log-in screen
    if ((!empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') )) {
        //redirect back to the referrer page, appending the login=failed parameter and removing any previous query strings
        //maybe could be smarter here and parse/rebuild the query strings from the referrer if they are important
        wp_redirect(preg_replace('/\?.*/', '', $referrer) . '/?login=failed' );
        exit;
    }
}
// This is also important. Make sure that the redirect still runs if the username and/or password are empty.
add_action( 'wp_authenticate', 'ugd_elementor_form_login_empty', 1, 2 );
function ugd_elementor_form_login_empty( $username, $pwd ) {
    $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
 if ( empty( $username ) || empty( $pwd ) ) {
    if ((!strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') )) {
        //redirect back to the referrer page, appending the login=failed parameter and removing any previous query strings
        //maybe could be smarter here and parse/rebuild the query strings from the referrer if they are important
        wp_redirect(preg_replace('/\?.*/', '', $referrer) . '/?login=failed' );
        exit;
    }
   exit();
 }
}

function ugd_generate_login_fail_messaging(){
    ob_start();
    if($_GET['login'] == 'failed'){
    echo '<div class="message_login_fail" style="background-color: #ca5151;color: #ffffff;display: block;margin-bottom: 20px;text-align: center;padding: 9px 15px; width: fit-content;margin: 0 auto;"><span style="color: #ca5151;background-color: #fff;width: 20px;height: 20px;display: inline-flex;align-items: center;justify-content: center;font-weight: 900;border-radius: 50%;margin-right: 10px;">!</span>Oops! Looks like you have entered the wrong username or password. Please check your login details and try again.</div>';
    }
    $return_string = ob_get_contents();
    ob_end_clean();
    return $return_string;
}
add_shortcode('ugd_login_fail_messaging', 'ugd_generate_login_fail_messaging');
?>
