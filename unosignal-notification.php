<?php

defined('ABSPATH') or die('This page may not be accessed directly.');

// Register the notification function, called when a post is published
add_action('publish_post', 'unosignal_send_notification', 30);

// Function to send a notification
function unosignal_send_notification($post_id)
{
    // Get the post and set api params
    $post = get_post($post_id);
    $title = $_POST['us_title'] ?: $post->post_title;
    $content = $_POST['us_content'] ?: $post->post_content;
    $segment = $_POST['us_segment'] ?: 'All';

    $args = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . get_option('unosignal_rest_api_key'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ),
        'body' => json_encode(array(
            'app_id' => get_option('unosignal_app_id'),
            'headings' => array('en' => $title),
            'contents' => array('en' => wp_strip_all_tags($content)),
            'url' => get_permalink($post_id),
            'included_segments' => array($segment),
        )),
    );

    // Make the API request and log errors
    if (defined('REST_REQUEST') && REST_REQUEST) return;
    $response = wp_remote_post('https://onesignal.com/api/v1/notifications', $args);
    if (is_wp_error($response)) {
        error_log('API request failed: ' . $response->get_error_message());
    }
}
