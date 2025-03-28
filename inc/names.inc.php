<?php

declare(strict_types=1);

function fetch_names_by_initial(string $char): array
{
    global $pdo;

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
    return $names;
}

function fetch_data_by_name(string $name): array
{
    global $pdo;

    $stmt = $pdo->prepare('SELECT `year`, `count` FROM `names` WHERE `name` = :name ORDER BY `year` ASC');
    $stmt->bindValue(':name', "{$name}", PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function gen_names_overview(): array
{
    global $pdo;

    $stmt = $pdo->prepare('SELECT `name`, SUM(`count`) as `sum` FROM `names` GROUP BY `name` ORDER BY `sum` DESC LIMIT 15;');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
