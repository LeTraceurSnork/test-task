<?php
/**
 * Тут должен быть нормальный роут REST API, но без фреймворков проблематично его реализовать "красиво"
 * Сначала идут различные проверки, бизнес-логика начинается с 63 строки
 */

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use MediaArmy\Application\Factories\DeliveryOperatorRepositoryFactory;
use MediaArmy\Domain\Delivery\Package;
use MediaArmy\Exception\UnknownCarrierException;

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        'error' => 'Допустим только GET',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$weight    = $_GET['weight'] ?? null;
$carrierId = $_GET['carrier_id'] ?? null;

if (empty($weight) || empty($carrierId)) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Укажите массу и ID перевозчика',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if (!is_numeric($weight)) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Масса должна быть числом',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if (!is_scalar($carrierId)) {
    http_response_code(400);
    echo json_encode([
        'error' => 'ID перевозчика должен быть строкой или приводимым к строке скаляром',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    $packageWeight = new Package((float)$weight);
} catch (InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode([
        'error' => $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * ===> Бизнес-логика начинается отсюда
 */
$carrierRepository = DeliveryOperatorRepositoryFactory::make();
try {
    $operator = $carrierRepository->getById($carrierId);
} catch (UnknownCarrierException $e) {
    http_response_code(400);
    echo json_encode([
        'error' => $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode([
    'price' => $operator->calculate($packageWeight),
], JSON_UNESCAPED_UNICODE);
