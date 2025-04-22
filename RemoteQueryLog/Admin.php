<?php

namespace Flynsarmy\RemoteQueryLog;

use Flynsarmy\RemoteQueryLog\Helpers;

class Admin
{
    use \Flynsarmy\RemoteQueryLog\Traits\Singleton;

    /**
     * Initialization, Hooks, and localization
     */
    protected function init(): void
    {
        $foo = $this;
        add_action('admin_menu', function () use ($foo) {
            add_management_page(
                'Remote Query Log',
                'Remote Query Log',
                'manage_options',
                'flyn-remote-query-log',
                [$foo, 'adminPage']
            );
        });
    }

    public function adminPage(): void
    {
        global $wpdb;
        $logs = $wpdb->get_results(
            "SELECT * FROM {$wpdb->prefix}flyn_query_log ORDER BY id DESC LIMIT 100",
            ARRAY_A
        );
        foreach ($logs as &$log) {
            $log['query'] = json_decode($log['query']);
        }

        exit(Helpers::requireWith(__DIR__ . '/../views/backend/admin.php', [
            'logs' => $logs,
        ]));
    }
}
