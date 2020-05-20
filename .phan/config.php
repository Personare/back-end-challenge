<?php declare(strict_types = 1);

return [
    'target_php_version' => '7.4',

    'directory_list' => [
        'src/',
        'tests/',
        'vendor/phpunit/phpunit/src',
    ],

    'file_list' => [
        'index.php',
    ],

    'exclude_analysis_directory_list' => [
        'vendor/',
    ],

    'suppress_issue_types' => [
        'PhanAccessMethodInternal',
    ],

    'plugins' => [],
];
