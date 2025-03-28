<?php require __DIR__ . '/inc/all.inc.php';

$char = strtoupper((string) ($_GET['char'] ?? ''));
if (strlen($char) === 0) {
    header("Location: index.php");
}
$names = fetch_names_by_initial($char);

render('char.view', [
    'char' => $char,
    'names' => $names
]);
