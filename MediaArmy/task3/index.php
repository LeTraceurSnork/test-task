<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use MediaArmy\Application\Factories\DeliveryOperatorRepositoryFactory;

$carrierRepository = DeliveryOperatorRepositoryFactory::make();
$operators         = $carrierRepository->getList();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Расчёт доставки</title>
    <link rel="stylesheet" id="app-css" href="assets/css/styles.css" type="text/css" media="all"/>
</head>
<body>
<h1>Стоимость доставки</h1>
<form action="calculate.php"
      method="get"
      id="shipping-quote-form"
      novalidate
>
    <label for="weight">Масса, кг</label>
    <input type="number" id="weight" name="weight" min="0" step="any" required inputmode="decimal">

    <label for="carrier_id">Перевозчик</label>
    <select id="carrier_id" name="carrier_id" required>
        <option value=""
                disabled
                selected
        >Выберите
        </option>
        <?php foreach ($operators as $operator): ?>
            <option value="<?= $operator->getId(); ?>"><?= $operator->getName(); ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Рассчитать</button>
</form>
<div id="result" aria-live="polite"></div>
<script src="assets/js/scripts.js" defer></script>
</body>
</html>
