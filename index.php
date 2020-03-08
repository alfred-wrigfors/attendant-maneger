<?php

/*
  Plugin Name: Atendant Maneger
  Plugin URL:
  Description: A plugin used by dlan.nu for keeping track of atendees
  Author: Alfred Wrigfors
  Author URL: https://facebook.com/alfred.wrigfors
  Version: 0.1

*/

  if ( !function_exists( 'add_action' ) ) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
  }

  //Define variables
  define( 'AM_VERSION', '4.1.3' );
  define( 'AM__MINIMUM_WP_VERSION', '4.0' );
  define( 'AM__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
  define( 'AM_DELETE_LIMIT', 100000 );


  register_activation_hook( __FILE__, array( 'Atendant Maneger', 'plugin_activation' ) );
  register_deactivation_hook( __FILE__, array( 'Atendant Maneger', 'plugin_deactivation' ) );

  Require_once( ABSPATH . 'wp-config.php');

  add_action("admin_menu", "addMenu");

  function addMenu(){
    add_menu_page('Atendant Maneger', 'Atendant Maneger', 4, "atendant_maneger-options", "mainMenu");

    //Add Register-page
    add_submenu_page(
  		'atendant_maneger-options',
  		'Register',
  		'Register',
  	  'manage_options',
  		'register',
  		'sd_display_register'
  	);

    //Add Forms-page
    add_submenu_page(
  		'atendant_maneger-options',
  		'Form',
  		'Form',
  		'manage_options',
  		'form',
  		'sd_display_form'
  	);

    //Add Email-page
    add_submenu_page(
  		'atendant_maneger-options',
  		'Email',
  		'Email',
  		'manage_options',
  		'email',
  		'sd_display_email'
  	);

    //Add Settings-page
    add_submenu_page(
  		'atendant_maneger-options',
  		'Settings',
  		'Settings',
  		'manage_options',
  		'settings',
  		'sd_display_settings'
  	);
  }

  add_action( 'admin_menu', 'sd_register_top_level_menu' );

  //Initiate pages -------------------------------------------------------------
  //Main menu
  function mainMenu(){
    add_navbar("overview");
    require_once(AM__PLUGIN_DIR.'views/overview.php');
  }

  //Register menu
  function sd_display_register(){
    add_navbar("register");
    require_once(AM__PLUGIN_DIR.'views/register.php');
  }

  //Formvmenu
  function sd_display_form(){
    add_navbar("form");
    require_once(AM__PLUGIN_DIR.'views/form.php');
  }

  //Email menu
  function sd_display_email(){
    add_navbar("email");
    require_once(AM__PLUGIN_DIR.'views/email.php');
  }

  //Settings menu
  function sd_display_settings(){
    add_navbar("settings");
    require_once(AM__PLUGIN_DIR.'views/settings.php');
  }

  function add_navbar($page){
    $current = array("", "", "", "", "");
    if ($page = "overview") {
      $current[0] = '<span class="sr-only">(current)</span>';
      $current2[0] = "active";
    }
    if ($page = "register") {
      $current[1] = '<span class="sr-only">(current)</span>';
      $current2[1] = 'active';
    }
    if ($page = "form") {
      $current[2] = '<span class="sr-only">(current)</span>';
      $current2[2] = 'active';
    }
    if ($page = "email") {
      $current[3] = '<span class="sr-only">(current)</span>';
      $current2[3] = 'active';
    }
    if ($page = "settings") {
      $current[4] = '<span class="sr-only">(current)</span>';
      $current2[4] = 'active';
    }
    require_once(AM__PLUGIN_DIR.'includes/nav-bar.php');

  }

  add_shortcode('AT-visitor','visitor_page');
  add_shortcode('AT-admin','admin_page');

  function visitor_page(){
    require_once(AM__PLUGIN_DIR.'includes/visitor.php');
  }

  function admin_page(){

  }

?>
<!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
