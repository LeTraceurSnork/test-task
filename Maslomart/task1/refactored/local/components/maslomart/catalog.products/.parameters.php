<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
    'PARAMETERS' => [
        'IBLOCK_ID'            => [
            'NAME'    => 'Инфоблок',
            'TYPE'    => 'STRING',
            'DEFAULT' => '',
        ],
        'SALE_PRICE_THRESHOLD' => [
            'NAME'    => 'Порог SALE',
            'TYPE'    => 'STRING',
            'DEFAULT' => '',
        ],
        'CURRENCY' => [
            'NAME'    => 'Валюта',
            'TYPE'    => 'STRING',
            'DEFAULT' => '',
        ],
        'CACHE_TIME'           => ['DEFAULT' => 3600],
        'CACHE_TYPE'           => ['DEFAULT' => 'A'],
    ],
];
