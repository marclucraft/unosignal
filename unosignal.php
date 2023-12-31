<?php

defined('ABSPATH') or die('This page may not be accessed directly.');

/*
 * Plugin Name: UnoSignal
 * Plugin URI: https://github.com/marclucraft/unosignal
 * Description: Free web push notifications. Unofficial OneSignal/WordPress integration.
 * Version: 0.1
 * Author: Marc Lucraft
 * Author URI: https://github.com/marclucraft
 * License: MIT
 */

require_once plugin_dir_path(__FILE__) . '/unosignal-admin/unosignal-admin.php';
require_once plugin_dir_path(__FILE__) . '/unosignal-init.php';
require_once plugin_dir_path(__FILE__) . '/unosignal-metabox/unosignal-metabox.php';
require_once plugin_dir_path(__FILE__) . '/unosignal-notification.php';
