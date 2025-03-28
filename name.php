<?php require __DIR__ . '/inc/all.inc.php'; ?>
<?php
$name = (string) ($_GET['name'] ?? '');
if (empty($name)) {
    header("Location: index.php");
    die();
}
$dataset = fetch_data_by_name($name);
?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php if (empty($dataset)): ?>
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
        <?php foreach ($dataset as $datarow) { ?>
            <tr>
                <td><?php echo e($datarow['year']) ?></td>
                <td><?php echo e($datarow['count']) ?></td>
            </tr>
        <?php } ?>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/views/footer.php'; ?>