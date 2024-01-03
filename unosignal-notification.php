<?php

defined('ABSPATH') or die('This page may not be accessed directly.');

// Register the notification function, called when a post is published
add_action('publish_post', 'unosignal_send_notification', 30);

// Function to send a notification
function unosignal_send_notification($post_id)
{

    // Get the post
    $post = get_post($post_id);

    // check if update is on.
    $update = $_POST['us_update'] ?? '';

    // do not send notification if not enabled
    if (empty($update)) {
        return;
    }

    // set api params
    $title = $_POST['us_title'] ?? $post->post_title;
    $content = $_POST['us_content'] ?? $post->post_content;
    $segment = $_POST['us_segment'] ?? 'All';

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
            'included_segments' => array($segment),
            'web_push_topic' => str_replace(' ', '-', strtolower($segment)),
            'isAnyWeb' => true,
        )),
    );

    // Conditionally include mobile parameters
    $body = json_decode($args['body'], true);
    if (get_option('unosignal_send_to_mobile') && get_option('unosignal_send_to_mobile') == 'on') {
        $body['isIos'] = true;
        $body['isAndroid'] = true;
        $body['isHuawei'] = true;
        $body['isWP_WNS'] = true;
        if (!empty($_POST['us_mobile_url'])) {
            $body['app_url'] = $_POST['us_mobile_url'];
            $body['web_url'] = get_permalink($post_id);
        }
    } else {
        $body['url'] = get_permalink($post_id);
    }
    $args['body'] = json_encode($body);

    // Make the API request and log errors
    if (defined('REST_REQUEST') && REST_REQUEST) return;
    $response = wp_remote_post('https://onesignal.com/api/v1/notifications', $args);
    if (is_wp_error($response)) {
        error_log('API request failed: ' . $response->get_error_message());
    }
}
