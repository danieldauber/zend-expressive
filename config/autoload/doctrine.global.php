<?php

use CodeEmailMKT\Domain\Entity\User;
use Doctrine\ORM\EntityManager;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySQL\Driver',
                'params' => [
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => 'root',
                    'dbname' => 'emailmkt',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ]
            ]
        ],
        'driver' => [
            'App_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/CodeEmailMKT/Infrastructure/Persistence/Doctrine/ORM']
            ],
            'orm_default' => [
                'drivers' => [
                    'CodeEmailMKT\Domain\Entity' => 'App_driver'
                ]
            ]
        ],
        'authentication' => [
            'orm_default' => [
                'object_manager' => EntityManager::class,
                'identity_class' => User::class,
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credential_callable' => function (User $user, $passwordGiven) {
                    return password_verify($passwordGiven, $user->getPassword());
                }
            ]
        ]
    ]
];
