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




    add_action('admin_menu','checkmailmenu');

    function checkmailmenu()
    {
        add_dashboard_page('Check Email', 'Check Email', 'activate_plugins', 'checkemail', 'dashboard_page');
    }


    function dashboard_page()
    {
        global $current_user;

        ?>

        <h2><?php _e('Check email', 'check-email'); ?></h2>

        <form action="" method="post">
            <label>Enter your email address:</label> <input id="email" type="email" name="yourmail"
                                                            value="<?php echo $current_user->user_email; ?>"
                                                            disabled="disabled">
            <input type="submit" name="submit" value="Test">
        </form>


        <?php

        if (isset($_POST["submit"])) {
            //echo $_POST["yourmail"];

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


//$checkmail = new check_email();