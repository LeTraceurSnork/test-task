<?php

$finder = new PhpCsFixer\Finder()
    ->in(__DIR__);

return new PhpCsFixer\Config()
    ->setRules([
        '@PER-CS'                => true,
        '@PHP8x4Migration'       => true,
        'binary_operator_spaces' => [
            'default'   => 'align_single_space_minimal',
            'operators' => [
                '='  => 'align_single_space',
                '=>' => 'align_single_space',
                '??' => 'single_space',
            ],
        ],
    ])
    ->setFinder($finder);