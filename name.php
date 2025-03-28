<?php require __DIR__ . '/inc/all.inc.php';

$name = (string) ($_GET['name'] ?? '');
if (empty($name)) {
    header("Location: index.php");
    die();
}
$nameset = fetch_data_by_name($name);


render('name.view', [
    'name' => $name,
    'char' => $name[0],
    'nameset' => $nameset
]);
