<?php

defined('ABSPATH') or die('This page may not be accessed directly.');

// Add OneSignal to WP Admin Menu
add_action('admin_menu', 'unosignal_admin_menu');

function unosignal_admin_menu()
{
  add_menu_page('UnoSignal - Push Notifications', 'UnoSignal', 'manage_options', 'unosignal-admin-page.php', 'unosignal_admin_page', 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDMwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0xNDkuNzAyIDAuMDAwMjg4MzI0QzY2Ljk0NDQgMC4xNjEyMDYgLTAuNDY4ODA1IDY4LjEwODkgMC4wMDI0NTU4NSAxNTAuODY3QzAuNDE2MjQ2IDIyOC4xNTkgNTkuMzU4MyAyOTEuNjEzIDEzNC43NiAyOTkuMjIyQzEzNSAyOTkuMjQ2IDEzNS4yNDMgMjk5LjIxOSAxMzUuNDczIDI5OS4xNDRDMTM1LjcwMiAyOTkuMDY4IDEzNS45MTMgMjk4Ljk0NSAxMzYuMDkyIDI5OC43ODJDMTM2LjI3MSAyOTguNjIgMTM2LjQxNCAyOTguNDIxIDEzNi41MTEgMjk4LjJDMTM2LjYwOCAyOTcuOTc5IDEzNi42NTggMjk3LjczOSAxMzYuNjU2IDI5Ny40OThWMTQ5Ljk5OUgxMjUuMDM2QzEyNC41NzkgMTQ5Ljk5OSAxMjQuMTQgMTQ5LjgxNyAxMjMuODE3IDE0OS40OTRDMTIzLjQ5MyAxNDkuMTcxIDEyMy4zMTIgMTQ4LjczMiAxMjMuMzEyIDE0OC4yNzVWMTI1LjAyMkMxMjMuMzEyIDEyNC41NjUgMTIzLjQ5MyAxMjQuMTI2IDEyMy44MTcgMTIzLjgwM0MxMjQuMTQgMTIzLjQ4IDEyNC41NzkgMTIzLjI5OCAxMjUuMDM2IDEyMy4yOThIMTYxLjYyMkMxNjIuMDc5IDEyMy4yOTggMTYyLjUxOCAxMjMuNDggMTYyLjg0MSAxMjMuODAzQzE2My4xNjQgMTI0LjEyNiAxNjMuMzQ2IDEyNC41NjUgMTYzLjM0NiAxMjUuMDIyVjI5Ny40OThDMTYzLjM0NSAyOTcuNzM5IDE2My4zOTQgMjk3Ljk3OCAxNjMuNDkxIDI5OC4xOThDMTYzLjU4OCAyOTguNDE5IDE2My43MyAyOTguNjE3IDE2My45MDggMjk4Ljc4QzE2NC4wODcgMjk4Ljk0MiAxNjQuMjk3IDI5OS4wNjYgMTY0LjUyNiAyOTkuMTQyQzE2NC43NTQgMjk5LjIxOCAxNjQuOTk3IDI5OS4yNDUgMTY1LjIzNyAyOTkuMjIyQzI0MC45MiAyOTEuNTg0IDMwMCAyMjcuNjk0IDMwMCAxNDkuOTk5QzMwMCA2Ny4wNTcyIDIzMi42NzkgLTAuMTYwNjMgMTQ5LjcwMiAwLjAwMDI4ODMyNFpNMTkyLjM2OSAyNjUuODAzQzE5Mi4xMDkgMjY1Ljg5NSAxOTEuODMgMjY1LjkyMyAxOTEuNTU3IDI2NS44ODVDMTkxLjI4NCAyNjUuODQ3IDE5MS4wMjMgMjY1Ljc0NCAxOTAuNzk4IDI2NS41ODVDMTkwLjU3MyAyNjUuNDI1IDE5MC4zODkgMjY1LjIxNCAxOTAuMjYzIDI2NC45NjlDMTkwLjEzNiAyNjQuNzI0IDE5MC4wNyAyNjQuNDUyIDE5MC4wNyAyNjQuMTc2VjIzOS41NTZDMTkwLjA3MSAyMzkuMDY2IDE5MC4yMTEgMjM4LjU4NyAxOTAuNDczIDIzOC4xNzRDMTkwLjczNiAyMzcuNzYxIDE5MS4xMSAyMzcuNDMxIDE5MS41NTMgMjM3LjIyMkMyMDguMDI0IDIyOS4zNTkgMjIxLjkzNSAyMTYuOTk2IDIzMS42NzcgMjAxLjU2MkMyNDEuNDIgMTg2LjEyNyAyNDYuNTk3IDE2OC4yNTEgMjQ2LjYxIDE0OS45OTlDMjQ2LjYxIDk2LjIyMzYgMjAyLjQ0OSA1Mi41NzQ2IDE0OC40OTUgNTMuNDAyMUM5Ny4xNzQgNTQuMTgzNyA1NS4wNzY3IDk1LjU1NjkgNTMuNDM4OCAxNDYuODU1QzUyLjgzOTkgMTY1LjYzNSA1Ny43MjQ4IDE4NC4xODIgNjcuNDk2MyAyMDAuMjMxQzc3LjI2NzcgMjE2LjI3OSA5MS41MDI3IDIyOS4xMzMgMTA4LjQ2MSAyMzcuMjIyQzEwOC45MDUgMjM3LjQzMSAxMDkuMjggMjM3Ljc2MSAxMDkuNTQzIDIzOC4xNzRDMTA5LjgwNyAyMzguNTg3IDEwOS45NDggMjM5LjA2NiAxMDkuOTUgMjM5LjU1NlYyNjQuMTgyQzEwOS45NSAyNjQuNDU4IDEwOS44ODQgMjY0LjczIDEwOS43NTcgMjY0Ljk3NUMxMDkuNjMgMjY1LjIyIDEwOS40NDcgMjY1LjQzMSAxMDkuMjIxIDI2NS41OUMxMDguOTk2IDI2NS43NSAxMDguNzM2IDI2NS44NTMgMTA4LjQ2MyAyNjUuODkxQzEwOC4xODkgMjY1LjkyOSAxMDcuOTExIDI2NS45IDEwNy42NTEgMjY1LjgwOEM2MC4xMjg0IDI0OC4zNzcgMjYuMjE0OSAyMDIuNDcgMjYuNzAzNCAxNDguODVDMjcuMzA2OCA4MS44Njc0IDgyLjAyNDggMjcuMjE4NCAxNDkuMDMgMjYuNzAxMkMyMTcuNDYgMjYuMTcyNSAyNzMuMjk5IDgxLjY4OTIgMjczLjI5OSAxNDkuOTk5QzI3My4yOTkgMjAzLjExOSAyMzkuNTM1IDI0OC40OTggMTkyLjM2OSAyNjUuODAzWiIgZmlsbD0iI0U1NEI0RCIvPgo8L3N2Zz4K', 81);
}

// Load style for page
add_action('admin_enqueue_scripts', 'admin_files');

function admin_files()
{
  wp_enqueue_script('unosignal_admin_js', plugins_url('unosignal-admin.js', __FILE__));
  wp_enqueue_style('style', plugins_url('unosignal-admin.css', __FILE__), array(), time());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST["submit"])) {
    if (isset($_POST['unosignal_app_id']) && !empty($_POST['unosignal_app_id'])) {
      update_option('unosignal_app_id', sanitize_text_field($_POST['unosignal_app_id']));
    }
    if (isset($_POST['unosignal_rest_api_key']) && !empty($_POST['unosignal_rest_api_key'])) {
      update_option('unosignal_rest_api_key', sanitize_text_field($_POST['unosignal_rest_api_key']));
    }
    $send_to_mobile = isset($_POST['unosignal_send_to_mobile']) ? 'on' : 'off';
    update_option('unosignal_send_to_mobile', $send_to_mobile);
  }
}

// Content for WP Admin Page
function unosignal_admin_page()
{
?>
  <header><img src="<?php echo plugins_url('/images/unosignal.svg', __FILE__); ?>"></header>
  <div class="us-content">
    <h2>Settings</h2>
    <form method="post">
      <label for="appid">OneSignal App ID</label>
      <input type="text" id="appid" name="unosignal_app_id" />
      <p>
        <?php
        $appID = esc_attr(get_option('unosignal_app_id'));
        if (!empty($appID)) {
          echo '✅ ' . $appID;
        } else {
          echo '❌ Please enter your OneSignal App ID';
        }
        ?>
      </p>
      <label for="apikey">OneSignal REST API Key </label>
      <input type="text" id="apikey" name="unosignal_rest_api_key" />
      <p>
        <?php
        $apiKey = esc_attr(get_option('unosignal_rest_api_key'));
        if (!empty($apiKey)) {
          // Get the last four characters
          $lastFour = substr($apiKey, -4);
          // Hide the rest of the key with asterisks
          $hiddenKey = str_repeat('*', strlen($apiKey) - 4) . $lastFour;

          echo '✅ ' . $hiddenKey;
        } else {
          echo '❌ Please enter your REST API Key';
        }
        ?>
      </p>
      <div class="checkbox-wrapper">
        <label for="send-to-mobile">
          <input id="send-to-mobile" type="checkbox" name="unosignal_send_to_mobile" <?php echo get_option('unosignal_send_to_mobile') === 'on' ? 'checked' : '' ?>>
          <span class="checkbox"></span>
          Send notification to Mobile app subscribers
        </label>
        <div class="help" aria-label="More information"><svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor">
            <g fill="currentColor">
              <path d="M8 0a8 8 0 108 8 8.009 8.009 0 00-8-8zm0 12.667a1 1 0 110-2 1 1 0 010 2zm1.067-4.054a.667.667 0 00-.4.612.667.667 0 01-1.334 0 2 2 0 011.2-1.834A1.333 1.333 0 106.667 6.17a.667.667 0 01-1.334 0 2.667 2.667 0 113.734 2.444z"></path>
            </g>
          </svg>
        </div>
        <div class="information" style="display: none;">
          <p>If you also have a mobile app setup in OneSignal, that's separate to your Website, this will include subscribers from your Mobile app in notification sends.</p>
          <p>You can choose a different URL(<a href="https://documentation.onesignal.com/docs/links#deep-linking">Deep Link</a>) for your Mobile app subscribers in the Post metabox.
          <p>If you do not include a different URL, it will direct them to your Website, rather than a specific page of your app.</p>
        </div>
        <?php submit_button(); ?>
    </form>
  </div>
<?php
}
