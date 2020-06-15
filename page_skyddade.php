<?php
/*
Template Name: Skyddade innehåll
*/

// This file handles single entries, but only exists for the sake of child theme forward compatibility.



// Check if user is logged in
if (!is_user_logged_in()) {

    // User is not logged in. Redirect browser to #login modal form.
    $url = home_url('/#login');
    //$url = home_url('/wp-login.php');
    header("Location: $url");
    exit();
} else {
    // User is logged in.

    genesis();
}
