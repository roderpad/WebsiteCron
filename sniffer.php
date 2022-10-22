/**
 * @since 1.0
 * @version 1.0
 * @author: Paden B. Roder
 * @date: 2022-10-22
 * @description: This function is run periodically on the server to check if there are issues with the WordPress site formatting.
 * This is a bug that occurs periodically and I need to know when it happens so I can backup the site and fix it.
 */
<?php
// Get website contents
$website_content = file_get_contents('https://padenroder.com');

//echo $website_content;

// Substring to check if formatting is still in place.
$substring = ".header { background:url('https://padenroder.com/wp-content/uploads/2014/07/nanosphere-banner4.jpg') no-repeat top center; }";

/**
 * Send an email using the WordPress mail function.
 */
function send_email() {
        $to = "roderpad@gmail.com"; // Email address to send to
        $subject = "Personal Website Issue Detected"; // Subject of the email
        $message = "The website content has changed. Restore from last locked backup."; // Message of the email
        mail($to, $subject, $message);
    }

/**
 * Check if the website content contains the substring. If it doesn't, send an email.
 * 
 * @param string $website_content: The website HTML content
 * @param string $substring: The substring to check for
 */
function check_website_content($website_content, $substring) {
    if (strpos($website_content, $substring) == false) {
        send_email();
    } 
}

// Check if the website content contains the substring. If it doesn't, send an email.
check_website_content($website_content, $substring);
?>