<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use MediaArmy\Model\Entity;
use MediaArmy\Service\EntityTreeFlattener;

$entitiesTree = [
    new Entity(
        name: 'Сущность 1',
        img_src: 'https://placeholders.xyz/300x200',
        description: 'Описание первой сущности'
    ),
    [
        new Entity(
            name: 'Сущность 2',
            description: 'У этой сущности нет изображения'
        ),
        new Entity(
            name: 'Сущность 3',
            img_src: 'https://placeholders.xyz/300x200'
        ),
    ],
    [
        [
            new Entity(
                name: 'Сущность 4'
            ),
        ],
        new Entity(
            name: 'Сущность 5',
            description: 'Сущность лежит рядом с вложенным массивом'
        ),
    ],
    [
        new Entity(
            name: 'Сущность 6',
            img_src: 'https://placeholders.xyz/300x200',
            description: 'Ещё один элемент на том же уровне'
        ),
        [
            new Entity(
                name: 'Сущность 7'
            ),
        ],
    ],
];

$flattener = new EntityTreeFlattener();
$entities  = $flattener->flatten($entitiesTree);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестовое задание — таблица сущностей</title>
    <link rel="stylesheet" id="app-css" href="assets/css/styles.css" type="text/css" media="all"/>
</head>
<body>
<h1>Список сущностей</h1>
<table>
    <thead>
    <tr>
        <th>Название</th>
        <th>Изображение</th>
        <th>Описание</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($entities as $entity): ?>
        <tr>
            <td><?= htmlspecialchars($entity->getName(), ENT_QUOTES, 'UTF-8') ?></td>
            <td>
                <?php if ($entity->getImage() !== null): ?>
                    <?php
                    $imgUrl = htmlspecialchars($entity->getImage(), ENT_QUOTES, 'UTF-8');
                    $altEsc = htmlspecialchars($entity->getName(), ENT_QUOTES, 'UTF-8');
                    ?>
                    <div class="image-shell">
                        <picture>
                            <source srcset="<?= $imgUrl ?>">
                        </picture>
                        <span class="image-shell__loader" aria-hidden="true"></span>
                    </div>
                <?php else: ?>
                    <span class="empty">Нет изображения</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($entity->getDescription() !== null): ?>
                    <?= nl2br(htmlspecialchars($entity->getDescription(), ENT_QUOTES, 'UTF-8')) ?>
                <?php else: ?>
                    <span class="empty">Нет описания</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script src="./assets/js/scripts.js"></script>
</body>
</html>
