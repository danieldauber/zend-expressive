<?php

return [
  'doctrine' => [
    'connection' => [
      'orm_default' => [
        'driverClass' => 'Doctrine\DBAL\Driver\PDOMySQL\Driver',
        'params' => [
          'host' => 'localhost',
          'port' => '3306',
          'user' => 'root',
          'password' => 'root',
          'dbname' => 'app_base',
          'driverOptions' => [
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
          ]
        ]
      ]
    ],
    'driver' => [
      'App_driver' => [
        'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
        'cache' => 'array',
        'paths' => [__DIR__ . '/../../src/App/Entity']
      ],
      'orm_default' => [
        'drivers' => [
          'App\Entity' => 'App_driver'
        ]
      ]
    ]
  ]
];
