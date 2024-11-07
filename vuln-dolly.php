<?php
/*
Plugin Name: Vuln Dolly
Plugin URI: http://github.com/blogsecproject/vuln-wp
Description: An Intentionally Vulnerable WordPress Plugin for Security Training and Testing. DO NOT run this on a production server!
Author: BlogSecurity
Version: 0.1
Author URI: https://blogsecurity.com
*/

// wp_ajax_nopriv_* used as hook for unauth AJAX requests
add_action( 'wp_ajax_nopriv_vd_get_user_data', 'vd_get_user_data' );

function vd_get_user_data() {
    global $wpdb;

    // Retrieve user ID from AJAX request
    $user = isset($_GET['user_id']) ? $_GET['user_id'] : '';

    // Vulnerable SQL query: directly embedding user input
    $table_name = $wpdb->prefix . 'users';
    $query = "SELECT * FROM $table_name WHERE id = $user";

    // Execute the query
    echo $query;
    $results = $wpdb->get_results( $query );
    print_r($results);

    // Return the results as JSON
    wp_send_json_success( $results );
}

