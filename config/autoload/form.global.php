<?php

use Zend\View;
use \CodeEmailMKT\Infrastructure;
use CodeEmailMKT\Application\Form\{CampaignForm, CustomerForm, LoginForm, TagForm};
use CodeEmailMKT\Application\Form\Factory\{CampaignFormFactory, CustomerFormFactory, LoginFormFactory, TagFormFactory};

$forms = [
    'dependencies' => [
        'aliases' => [

        ],
        'invokables' => [

        ],
        'factories' => [
            View\HelperPluginManager::class =>
                Infrastructure\View\HelperPluginManagerFactory::class,
            CustomerForm::class => CustomerFormFactory::class,
            TagForm::class => TagFormFactory::class,
            LoginForm::class =>LoginFormFactory::class,
            CampaignForm::class => CampaignFormFactory::class

        ]
    ],
    'view_helpers' => [
        'aliases' => [

        ],
        'invokables' => [

        ],
        'factories' => [
            'identity' => View\Helper\Service\IdentityFactory::class

        ]
    ]
];

$configProviderForm = (new \Zend\Form\ConfigProvider())->__invoke();

return \Zend\Stdlib\ArrayUtils::merge($configProviderForm, $forms);
