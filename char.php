<?php require __DIR__ . '/inc/all.inc.php';

$char = strtoupper((string) ($_GET['char'] ?? ''));
$abc = gen_alphabet();
if (strlen($char) === 0 || !in_array($char, $abc)) {
    header("Location: index.php");
    die();
}

$page = (int) ($_GET["page"] ?? 1);
$perPage = 15;
$names = fetch_names_by_initial($char, $page, $perPage);
$count = count_names_by_initial($char);

render('char.view', [
    'char' => $char,
    'names' => $names,
    'pagination' => [
        'page' => $page,
        'count' => $count,
        'perPage' => $perPage
    ]
]);
