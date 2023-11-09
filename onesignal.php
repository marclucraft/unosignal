<?php

defined('ABSPATH') or die('This page may not be accessed directly.');

/*
 * Plugin Name: UnoSignal (Marc's Version)
 * Plugin URI: https://github.com/marclucraft/unosignal
 * Description: Free web push notifications, by OneSignal.
 * Version: 0.1
 * Author: Marc Lucraft
 * Author URI: https://github.com/marclucraft
 * License: MIT
 */

require_once plugin_dir_path(__FILE__) . '/onesignal-admin/onesignal-admin.php';
require_once plugin_dir_path(__FILE__) . '/onesignal-init.php';
require_once plugin_dir_path(__FILE__) . '/onesignal-metabox/onesignal-metabox.php';
require_once plugin_dir_path(__FILE__) . '/onesignal-notification.php';
