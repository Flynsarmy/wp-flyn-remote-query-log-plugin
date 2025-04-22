<?php

namespace Flynsarmy\RemoteQueryLog;

use WP_Error;

class RemoteQueryLog
{
    use \Flynsarmy\RemoteQueryLog\Traits\Singleton;

    /**
     * Initialization, Hooks, and localization
     */
    protected function init(): void
    {
        add_filter('pre_http_request', [$this, 'preHttpRequest'], 10, 3);
    }

    /**
     * Filters the preemptive return value of an HTTP request.
     *
     * Returning a non-false value from the filter will short-circuit the HTTP request and return
     * early with that value. A filter should return one of:
     *
     *  - An array containing 'headers', 'body', 'response', 'cookies', and 'filename' elements
     *  - A WP_Error instance
     *  - boolean false to avoid short-circuiting the response
     *
     * Returning any other value may result in unexpected behavior.
     *
     * @since 2.9.0
     *
     * @param false|array|WP_Error $response    A preemptive return value of an HTTP request. Default false.
     * @param array                $parsed_args HTTP request arguments.
     * @param string               $url         The request URL.
     */
    public function preHttpRequest(
        false|array|WP_Error $response,
        array $parsed_args,
        string $url
    ): false|array|WP_Error {
        global $wpdb;
        $wpdb->insert(
            $wpdb->prefix . 'flyn_query_log',
            [
                'time' => current_time('mysql'),
                'query' => json_encode($parsed_args),
                'url' => $url,
            ],
            [
                '%s',
                '%s',
                '%s',
            ]
        );

        return $response;
    }
}
