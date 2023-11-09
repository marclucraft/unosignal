<?php

defined('ABSPATH') or die('This page may not be accessed directly.');

// Add OneSignal initialisation code to head of pages.
add_action('wp_head', 'onesignal_init');

function onesignal_init()
{
?>
  <script async src="https://cdn.onesignal.com/sdks/OneSignalSDK.js"></script>
  <script>
    window.OneSignal = window.OneSignal || [];

    OneSignal.push(function() {
      // TODO: In OneSignal we need to change WordPress Setup so it's similar to Typical Site setup.
      OneSignal.push(function() {
        OneSignal.init({
          appId: "<?php echo get_option('onesignal_app_id'); ?>",
        });
      });
    });
  </script>
<?php
}
