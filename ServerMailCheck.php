<?php

/*
Plugin Name: Server-Mail-Check
Description: Check if the emails are shooting as expected from your hosting server.
Version: 1.0
Author: Praveen
Author URI: http://Praveen.blog
License: GPL2
*/

class ServerMailCheck
{

    public static function render_dashboard_page()
    {
        add_action('admin_menu', 'checkmailmenu');

        function checkmailmenu()
        {
            add_dashboard_page('Check Email', 'Check Email', 'activate_plugins', 'servermailcheck', 'render_email_form');
        }


        function render_email_form()
        {

            echo "<h2>Server Mail Check</h2>";
            if (current_user_can('activate_plugins')){
            $current_user = wp_get_current_user();
            ?>
            <form method="post">
                <label>Enter your email address:</label> <input id="email" type="email" name="yourmail" value="<?php echo $current_user->user_email; ?>" disabled="disabled">
                <input type="hidden" name="_nonce" value="<?php echo wp_create_nonce('submit-user'); ?>">
                <input type="submit" name="submit" value="Test">
            </form>


        <?php
            } else {
                echo "Only Administrators Can use this Plugin!";
            }

            if (isset($_POST["submit"])) {
                if ( wp_verify_nonce($_POST['_nonce'], 'submit-user')) {
                    $headers = array('Content-Type: text/html; charset=UTF-8');
                    $to = $current_user->user_email;
                    $title = "Test email from " . get_bloginfo("url");
                    $body = "This test email proves that your WordPress installation can send emails";
                    $mailresult = wp_mail($to, $title, $body, $headers);
                    if ($mailresult) {
                        echo 'Email Works!!.';
                    } else {
                        echo 'There seems to be some issue with the sending out of emails!';
                    }
                }
            }
        }
    }


}


    ServerMailCheck::render_dashboard_page();




?>