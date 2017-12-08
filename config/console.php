<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    'controllerMap' => [
        'migrate-rbac' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => '{{%migration_rbac}}',
            'migrationPath' => ['@app/migrations/rbac'],
        ],
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'useTablePrefix' => true,
            'templateFile' => '@app/views/migration.php',
            'generatorTemplateFiles' => [
                'create_table' => '@app/views/createTableMigration.php',
                'drop_table' => '@app/views/dropTableMigration.php',
                'add_column' => '@app/views/addColumnMigration.php',
                'drop_column' => '@app/views/dropColumnMigration.php',
                'create_junction' => '@app/views/createTableMigration.php',
            ],
        ],
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
