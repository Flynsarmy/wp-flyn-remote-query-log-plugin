<?php

/**
 * @package Flyn Remote Query Log
 * @author Flyn San
 * @version 0.0.1
 *
 * Plugin Name: Flynsarmy Remote Query Log
 * Description: Logs reuqests made with the WP_Http class and provides a Tools admin page to viwe the logs.
 * Version: 0.0.1
 * Author: Flyn San
 * Author URI: https://www.flynsarmy.com/
 */

require __DIR__ . '/vendor/autoload.php';

/**
 * Activate the plugin.
 */
function flynremotequerylog_activate()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'flyn_query_log';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        query text NOT NULL,
        url varchar(255) DEFAULT '' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'flynremotequerylog_activate');

Flynsarmy\RemoteQueryLog\RemoteQueryLog::instance();
Flynsarmy\RemoteQueryLog\Admin::instance();
