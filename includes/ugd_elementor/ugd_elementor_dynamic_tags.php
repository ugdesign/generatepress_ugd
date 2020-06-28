<?php
/*
    Plugin Name: UDG Custom Modules
    Program:      ./includes/ugd_elementor/ugd_elementor_dynamic_tags.php
    Version:      1.0
    Date Started: 29/04/2020
    Copyright:    Underground Design
    Description:
    * routines creating custom dynamic elementor tags
    see https://developers.elementor.com/dynamic-tags/

		Adds the following functions in Elementor Dynamic Tag list
		New Section: Current user
		> User Logged include in
		> User ID
		> User Login
		> User Display Name
		> User Role
*/

/*    Define Elementor Tag - Current User Is Logged In    */
Class elementor_current_user_logged_in_tag extends \Elementor\Core\DynamicTags\Tag {
	// Returns the Name of the tag
	public function get_name() { return 'user-logged-in'; }

    // Returns the title of the Tag
	public function get_title() { return __( 'User Logged In ', 'elementor-pro' ); }

    // Returns the Group of the tag
	public function get_group() { return 'current-user'; }

	// Returns an array of tag categories
	public function get_categories() { return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ]; }

	// Registers the Dynamic tag controls
	protected function _register_controls() {
		$variables = [];

		foreach ( array_keys( $_SERVER ) as $variable ) {
			$variables[ $variable ] = ucwords( str_replace( '_', ' ', $variable ) );
		}

		$this->add_control(
			'param_name',
			[
				'label' => __( 'User Logged In', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $variables,
			]
		);
	}

    // Prints out the value of the Dynamic tag
	public function render() {
	    // Returns 1 if user is logged in
		$value = is_user_logged_in();
		echo wp_kses_post( $value );
	}
}

/*    Define Elementor Tag - Current User ID    */
Class elementor_current_user_logged_id_tag extends \Elementor\Core\DynamicTags\Tag {
	// Returns the Name of the tag
	public function get_name() { return 'user-id'; }

    // Returns the title of the Tag
	public function get_title() { return __( 'User ID ', 'elementor-pro' ); }

    // Returns the Group of the tag
	public function get_group() { return 'current-user'; }

	// Returns an array of tag categories
	public function get_categories() { return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ]; }

	// Registers the Dynamic tag controls
	protected function _register_controls() {
		$variables = [];

		foreach ( array_keys( $_SERVER ) as $variable ) {
			$variables[ $variable ] = ucwords( str_replace( '_', ' ', $variable ) );
		}

		$this->add_control(
			'param_name',
			[
				'label' => __( 'User ID', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $variables,
			]
		);
	}

    // Prints out the value of the Dynamic tag
	public function render() {
	    // Returns user ID if logged in or zero if not logged in
		$value = 0;
		if ( is_user_logged_in() ) {
		    $value = get_current_user_id();
		}
		echo wp_kses_post( $value );
	}
}

/*    Define Elementor Tag - Current User Login    */
Class elementor_current_user_login_tag extends \Elementor\Core\DynamicTags\Tag {
	// Returns the Name of the tag
	public function get_name() { return 'user-login'; }

    // Returns the title of the Tag
	public function get_title() { return __( 'User Login', 'elementor-pro' ); }

    // Returns the Group of the tag
	public function get_group() { return 'current-user'; }

	// Returns an array of tag categories
	public function get_categories() { return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ]; }

	// Registers the Dynamic tag controls
	protected function _register_controls() {
		$variables = [];

		foreach ( array_keys( $_SERVER ) as $variable ) {
			$variables[ $variable ] = ucwords( str_replace( '_', ' ', $variable ) );
		}

		$this->add_control(
			'param_name',
			[
				'label' => __( 'User Login', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $variables,
			]
		);
	}

    // Prints out the value of the Dynamic tag
	public function render() {
	    // Returns user login if logged in or blank if not logged in
		$value = '';
		if ( is_user_logged_in() ) {
		    $user = new wp_user( get_current_user_id() );
		    $value = $user->user_login;
		}
		echo wp_kses_post( $value );
	}
}

/*    Define Elementor Tag - Current User Role
      (NOTE only returns first if there are multiple roles   */
Class elementor_current_user_role_tag extends \Elementor\Core\DynamicTags\Tag {
	// Returns the Name of the tag
	public function get_name() { return 'user-role'; }

    // Returns the title of the Tag
	public function get_title() { return __( 'User Role', 'elementor-pro' ); }

    // Returns the Group of the tag
	public function get_group() { return 'current-user'; }

	// Returns an array of tag categories
	public function get_categories() { return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ]; }

	// Registers the Dynamic tag controls
	protected function _register_controls() {
		$variables = [];

		foreach ( array_keys( $_SERVER ) as $variable ) {
			$variables[ $variable ] = ucwords( str_replace( '_', ' ', $variable ) );
		}

		$this->add_control(
			'param_name',
			[
				'label' => __( 'User Login', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $variables,
			]
		);
	}

    // Prints out the value of the Dynamic tag
	public function render() {
	    // Returns user role if logged in or blank if not logged in
		$value = '';
		if ( is_user_logged_in() ) {
		    //$user = new wp_user( get_current_user_id() );
		    $user = wp_get_current_user();
            $role = ( array ) $user->roles;
		    $value = $role[0];
		}
		echo wp_kses_post( $value );
	}
}


/*    Define Elementor Tag - Current User Display Name    */
Class elementor_current_user_display_name_tag extends \Elementor\Core\DynamicTags\Tag {
	// Returns the Name of the tag
	public function get_name() { return 'user-display-name'; }

    // Returns the title of the Tag
	public function get_title() { return __( 'User Display Name ', 'elementor-pro' ); }

    // Returns the Group of the tag
	public function get_group() { return 'current-user'; }

	// Returns an array of tag categories
	public function get_categories() { return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ]; }

	// Registers the Dynamic tag controls
	protected function _register_controls() {
		$variables = [];

		foreach ( array_keys( $_SERVER ) as $variable ) {
			$variables[ $variable ] = ucwords( str_replace( '_', ' ', $variable ) );
		}

		$this->add_control(
			'param_name',
			[
				'label' => __( 'User Display Name', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $variables,
			]
		);
	}

    // Prints out the value of the Dynamic tag
	public function render() {
	    // Returns user display name if logged in or blank if not logged in
		$value = '';
		if ( is_user_logged_in() ) {
		    $user = new wp_user( get_current_user_id() );
		    $value = $user->display_name;
		}
		echo wp_kses_post( $value );
	}
}

add_action( 'elementor/dynamic_tags/register_tags', function( $dynamic_tags ) {
	// In our Dynamic Tag we use a group named current-user so we need
	// To register that group as well before the tag
	\Elementor\Plugin::$instance->dynamic_tags->register_group( 'current-user', [
		'title' => 'Current User'
	] );

	// Register the new tag
	$dynamic_tags->register_tag( 'elementor_current_user_logged_in_tag' );
	$dynamic_tags->register_tag( 'elementor_current_user_logged_id_tag' );
	$dynamic_tags->register_tag( 'elementor_current_user_login_tag' );
	$dynamic_tags->register_tag( 'elementor_current_user_display_name_tag' );
	$dynamic_tags->register_tag( 'elementor_current_user_role_tag' );
} );

?>
