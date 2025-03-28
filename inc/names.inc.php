<?php

declare(strict_types=1);

function fetch_names_by_initial(string $char, int $page = 1, int $perPage = 15): array
{
    global $pdo;

    $page = max(1, $page);

    if (mb_strlen($char) > 1) {
        $char = $char[0];
    }

    $stmt = $pdo->prepare('SELECT DISTINCT `name` FROM `names` WHERE `name` LIKE :expr ORDER BY `year` ASC LIMIT :limit OFFSET :offset');
    $stmt->bindValue(':expr', "{$char}%", PDO::PARAM_STR);
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $perPage * ($page - 1), PDO::PARAM_INT);
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

    $stmt = $pdo->prepare('SELECT `year`, `count` FROM `names` WHERE `name` = :name ORDER BY `year` DESC');
    $stmt->bindValue(':name', "{$name}", PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function count_names_by_initial(string $char): int
{
    global $pdo;

    $stmt = $pdo->prepare('SELECT COUNT(DISTINCT `name`) AS `count` FROM `names` WHERE `name` LIKE :expr');
    $stmt->bindValue(':expr', "{$char}%");
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
}

function gen_names_overview(): array
{
    global $pdo;

    $stmt = $pdo->prepare('SELECT `name`, SUM(`count`) as `sum` FROM `names` GROUP BY `name` ORDER BY `sum` DESC LIMIT 15;');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
