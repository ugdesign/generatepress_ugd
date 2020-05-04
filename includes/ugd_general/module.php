<?php
/*
    Plugin Name: UDG Custom Modules
    Program:      ./includes/ugd_general/module.php
    Version:      1.0
    Date Started: 29/04/2018
    Copyright:    Underground Design
    Description:
    * general routines
*/

//Set a per user upload directory
function ugd_per_user_upload_dir( $original ){
    // use the original array for initial setup
    $modified = $original;
    // set our own replacements
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        //Don't modify uload directory for admins (or super admins)
        if ( !is_super_admin( $current_user ) ) {
            $subdir = $current_user->user_login;
            $modified['subdir'] = $subdir;
            $modified['url'] = $original['baseurl'] . '/' . $subdir;
            $modified['path'] = $original['basedir'] . DIRECTORY_SEPARATOR . $subdir;
        }
    }
    return $modified;
}
//add_filter( 'upload_dir', 'ugd_per_user_upload_dir');

//Shortcode to redirect page (modified from WP plugin shortcode-redirect)
function ugd_scr_do_redirect($atts)
{
	ob_start();
	$myURL    = ( isset($atts['url'])  && !empty($atts['url']))  ? esc_url($atts['url'])   : "";
	$mySEC    = ( isset($atts['sec'])  && !empty($atts['sec']))  ? esc_attr($atts['sec'])  : "0";
	$HideMesg = ( isset($atts['hide']) && !empty($atts['hide'])) ? esc_attr($atts['hide']) : "0";
	if(!empty($myURL))
  {
?>
		<meta http-equiv="refresh" content="<?php echo $mySEC; ?>; url=<?php echo $myURL; ?>">
		<?php if ($HideMesg == "0" ) { ?>
		Please wait while you are redirected...or <a href="<?php echo $myURL; ?>">Click Here</a> if you do not want to wait.
		<?php } ?>
<?php
	}
	return ob_get_clean();
}
add_shortcode('ugd_redirect', 'ugd_scr_do_redirect');

?>
