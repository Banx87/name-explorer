<?php if (empty($nameset)): ?>
    <p>We could not found any entries in our system :/</p>
<?php else: ?>
    <h1>Statistics for the name: <?php echo e($name) ?></h1>
    <table>
        <thead>
            <tr>
                <th>Year</th>
                <th>Number of babies born</th>
            </tr>
        </thead>
        <?php foreach ($nameset as $datarow) { ?>
            <tr>
                <td><?php echo e($datarow['year']) ?></td>
                <td><?php echo e($datarow['count']) ?></td>
            </tr>
        <?php } ?>
    </table>
<?php endif; ?>