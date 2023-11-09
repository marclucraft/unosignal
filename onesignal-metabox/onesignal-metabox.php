<?php

defined('ABSPATH') or die('This page may not be accessed directly.');

// Create a meta box
add_action('add_meta_boxes', 'onesignal_add_metabox');

function onesignal_add_metabox()
{
  add_meta_box(
    'onesignal_metabox', // metabox ID
    'OneSignal Push Notifications', // title
    'onesignal_metabox', // callback function
  );
}

// Render the meta box
function onesignal_metabox($post)
{
  // View segments API to populate Segments list.
  $args = array(
    'headers' => array(
      'Authorization' => 'Bearer ' . get_option('onesignal_rest_api_key'),
      'accept' => 'application/json',
      'content-type' => 'application/json',
    )
  );

  // Make the API request, log errors, get segment names.
  $response = wp_remote_get('https://onesignal.com/api/v1/apps/' . get_option('onesignal_app_id') . '/segments', $args);
  if (is_wp_error($response)) {
    error_log('API request failed: ' . $response->get_error_message());
  }
  $json = json_decode(wp_remote_retrieve_body($response));

  // Meta box content -> js file hides sections depending on whats checked.
?>
  <label for="os_update">
    <input type="checkbox" name="os_update" id="os_update" <?php echo $post->os_meta['os_update'] == 'on' ? 'checked' : '' ?>>Send notification when post is published</label><br><br>
  <div id="os_options">
    <label for="os_segment">Send to segment</label><br>
    <select name="os_segment" id="os_segment">
      <option value="All">All</option>
      <?php
      for ($i = 0; $i < count($json->segments); $i++) {
        $selected = $post->os_meta['os_segment'] === $json->segments[$i]->name ? 'selected' : '';
        echo '<option value="' . $json->segments[$i]->name . '"' . $selected . '>' . $json->segments[$i]->name . '</option>';
      }
      ?>
    </select> <br>
    <label for="os_customise"><br>
      <input type="checkbox" name="os_customise" id="os_customise" <?php echo $post->os_meta['os_customise'] == 'on' ? 'checked' : '' ?>>Customise notification content</label><br><br>
    <div id="os_customisations" style="display:none;">
      <label for="os_title">Notification title</label><br>
      <input type="text" name="os_title" id="os_title" value="<?php echo esc_attr($post->os_meta['os_title']) ?>" disabled><br><br>
      <label for="os_content">Notification content</label><br>
      <input type="text" name="os_content" id="os_content" value="<?php echo esc_attr($post->os_meta['os_content']) ?>" disabled><br><br>
      <label for=" os_image">Notification image</label><br>
      <input type="file" name="os_image" id="os_image" value="<?php echo esc_attr($post->os_meta['os_image']) ?>" disabled>
    </div>
  </div>

<?php
}

// Load metabox JS
add_action('admin_print_styles-post.php', 'onesignal_meta_files');
add_action('admin_print_styles-post-new.php', 'onesignal_meta_files');

function onesignal_meta_files()
{
  wp_enqueue_script('onesignal_metabox', plugins_url('onesignal-metabox.js', __FILE__));
}



// Store meta data
add_action('save_post', 'onesignal_save_meta', 10);

function onesignal_save_meta($post_id)
{
  $fields = [
    'os_update',
    'os_segment',
    'os_customise',
    'os_title',
    'os_content',
    'os_image',
  ];

  $meta_values = array();

  foreach ($fields as $field) {
    if (array_key_exists($field, $_POST)) {
      $meta_values[$field] = sanitize_text_field($_POST[$field]);
    } else {
      unset($meta_values[$field]);
    }
  }

  // Update the post meta with the os_meta key and values
  update_post_meta($post_id, 'os_meta', $meta_values);
}
