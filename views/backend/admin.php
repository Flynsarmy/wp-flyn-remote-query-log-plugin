<h1>Remote Query Log</h1>

<table class="wp-list-table widefat fixed striped items">
    <thead>
        <tr>
            <th scope="col" class="manage-column column-primary" width="20">ID</th>
            <th scope="col" class="manage-column column-primary" width="100">Time</th>
            <th scope="col" class="manage-column column-primary" width="600">URL</th>
            <th scope="col" class="manage-column column-primary">Query</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td><?php echo esc_html($log['id']); ?></td>
                <td><?php echo esc_html($log['time']); ?></td>
                <td><?php echo esc_html($log['url']); ?></td>
                <td>
                    <a href="#" onclick="jQuery(this).next().toggle(); return false;"><span class="dashicons dashicons-arrow-right"></span> Show</a>
                    <pre style="display:none"><?php echo print_r($log['query'], true); ?></pre>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th scope="col" class="manage-column column-primary">ID</th>
            <th scope="col" class="manage-column column-primary">Time</th>
            <th scope="col" class="manage-column column-primary">URL</th>
            <th scope="col" class="manage-column column-primary">Query</th>
        </tr>
    </tfoot>
</table>