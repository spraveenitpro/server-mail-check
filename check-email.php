<?php

/*
Plugin Name: Server-Mail-Check
Plugin URI: http://praveen.blog
Description: Check if the emails are shooting as expected from your hosting server.
Version: 1.0
Author: praveen
Author URI: http://praveen.blog
License: GPL2
*/

include "classes/ServerMailCheck.php";

$checkemail = new ServerMailCheck();
$checkemail->render_dashboard_page();
$checkemail->render_email_form();

//var_dump($checkemail);



?>