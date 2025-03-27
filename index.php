<?php require __DIR__ . '/inc/all.inc.php'; ?>
<?php
$char = strtoupper((string) ($_GET['char'] ?? ''));

if (mb_strlen($char) > 1) {
    $char = $char[0];
}

$stmt = $pdo->prepare('SELECT DISTINCT `name` FROM `names` WHERE `name` LIKE :expr ORDER BY `year` ASC');
$stmt->bindValue(':expr', "{$char}%", PDO::PARAM_STR);
$stmt->execute();
$names = [];
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $names[] = $result['name'];
}
?>

<?php require __DIR__ . '/views/header.php'; ?>

<ul>
    <?php foreach ($names as $name): ?>
        <li>
            <a href="name.php?<?php echo http_build_query(['name' => $name]); ?>">
                <?php echo e($name); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php require __DIR__ . '/views/footer.php'; ?>