<h1>Remote Query Log</h1>

<style>
    .wp-list-table tr.cancelled td {
        background-color: #fbe7e7;
    }
    .wp-list-table tr.cancelled td:first-child {
        border-left: 4px solid #e67272
    }
</style>

<p>Cancelled requests are highlighted in red.</p>
<table class="wp-list-table widefat fixed striped items">
    <thead>
        <tr>
            <th scope="col" class="manage-column column-primary" width="100">Time</th>
            <th scope="col" class="manage-column column-primary" width="600">URL</th>
            <th scope="col" class="manage-column column-primary">Query</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
            <tr class="<?php if (!empty($log['was_cancelled'])) echo 'cancelled'; ?>">
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
            <th scope="col" class="manage-column column-primary">Time</th>
            <th scope="col" class="manage-column column-primary">URL</th>
            <th scope="col" class="manage-column column-primary">Query</th>
        </tr>
    </tfoot>
</table>