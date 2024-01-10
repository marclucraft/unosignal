<?php

defined('ABSPATH') or die('This page may not be accessed directly.');

// Create a meta box
add_action('add_meta_boxes', 'unosignal_add_metabox');

function unosignal_add_metabox()
{
  add_meta_box(
    'unosignal_metabox', // metabox ID
    'OneSignal Push Notifications', // title
    'unosignal_metabox', // callback function
  );
}

// Render the meta box
function unosignal_metabox($post)
{
  // View segments API to populate Segments list.
  $args = array(
    'headers' => array(
      'Authorization' => 'Bearer ' . get_option('unosignal_rest_api_key'),
      'accept' => 'application/json',
      'content-type' => 'application/json',
    )
  );

  // Make the API request, log errors, get segment names.
  $response = wp_remote_get('https://onesignal.com/api/v1/apps/' . get_option('unosignal_app_id') . '/segments', $args);
  if (is_wp_error($response)) {
    error_log('API request failed: ' . $response->get_error_message());
  }
  $json = json_decode(wp_remote_retrieve_body($response));

  // Meta box content -> js file hides sections depending on whats checked.
?>
  <label for="us_update">
    <input type="checkbox" name="us_update" id="us_update" <?php echo isset($post->us_meta['us_update']) && $post->us_meta['us_update'] == 'on' ? 'checked' : '' ?>>Send notification when post is published</label>
  <div id="us_options">
    <label for="us_segment">Send to segment</label>
    <select name="us_segment" id="us_segment">
      <option value="All">All</option>
      <?php
      for ($i = 0; $i < count($json->segments); $i++) {
        $selected = isset($post->us_meta['us_segment']) && $post->us_meta['us_segment'] === $json->segments[$i]->name ? 'selected' : '';
        echo '<option value="' . $json->segments[$i]->name . '"' . $selected . '>' . $json->segments[$i]->name . '</option>';
      }
      ?>
    </select>
    <hr>
    <label for="us_customise">
      <input type="checkbox" name="us_customise" id="us_customise" <?php echo isset($post->us_meta['us_customise']) && $post->us_meta['us_customise'] == 'on' ? 'checked' : '' ?>>Customize notification content</label>
    <div id="us_customisations" style="<?php echo isset($post->us_meta['us_customise']) && $post->us_meta['us_customise'] == 'on' ? 'display:block;' : 'display:none;'; ?>">
      <label for="us_title">Notification title</label>
      <input type="text" name="us_title" id="us_title" value="<?php echo esc_attr(isset($post->us_meta['us_title']) ? $post->us_meta['us_title'] : ''); ?>" disabled>
      <label for="us_content">Notification content</label>
      <input type="text" name="us_content" id="us_content" value="<?php echo esc_attr(isset($post->us_meta['us_content']) ? $post->us_meta['us_content'] : ''); ?>" disabled>
    </div>
    <?php if (get_option('unosignal_send_to_mobile') == 'on') : ?>
      <hr>
      <label for="us_mobile_url">Mobile URL</label>
      <input type="text" name="us_mobile_url" id="us_mobile_url" value="<?php echo esc_attr(isset($post->us_meta['us_mobile_url']) ? $post->us_meta['us_mobile_url'] : ''); ?>" disabled>
    <?php endif; ?>
  </div>

<?php
}

// Load metabox JS
add_action('admin_print_styles-post.php', 'unosignal_meta_files');
add_action('admin_print_styles-post-new.php', 'unosignal_meta_files');

function unosignal_meta_files()
{
  wp_enqueue_script('unosignal_metabox_js', plugins_url('unosignal-metabox.js', __FILE__));
  wp_enqueue_style('unosignal_metabox_css', plugins_url('unosignal-metabox.css', __FILE__), array(), time());
}



// Store meta data
add_action('save_post', 'unosignal_save_meta', 10);

function unosignal_save_meta($post_id)
{
  $fields = [
    'us_update',
    'us_segment',
    'us_customise',
    'us_title',
    'us_content',
    'us_mobile_url'
  ];

  $meta_values = array();

  foreach ($fields as $field) {
    if (array_key_exists($field, $_POST)) {
      $meta_values[$field] = sanitize_text_field($_POST[$field]);
    } else {
      unset($meta_values[$field]);
    }
  }

  // Update the post meta with the us_meta key and values
  update_post_meta($post_id, 'us_meta', $meta_values);
}
