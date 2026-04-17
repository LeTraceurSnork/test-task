<?php
/**
 * @var array $arResult
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (empty($arResult['ITEMS'])) {
    return;
}

foreach ($arResult['ITEMS'] as $item) {
    $isSale = (bool)$item['is_sale'];
    $name  = htmlspecialcharsbx($item['name']);
    if ($item['price'] === null) {
        $priceLabel = '—';
    } else {
        $currency = (string)($arResult['CURRENCY'] ?? 'RUB');
        if (class_exists('CCurrencyLang')) {
            $priceLabel = CCurrencyLang::CurrencyFormat((float)$item['price'], $currency, true);
        } else {
            $priceLabel = htmlspecialcharsbx((string)$item['price']);
        }
    }
    ?>
    <div class="item <?php if ($isSale): ?>sale<?php endif;?>">
        <?= $name; ?> - <?= $priceLabel; ?><?php if ($isSale): ?> SALE<?php endif; ?>
    </div>
    <?php
}
