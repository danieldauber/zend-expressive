<?php

use CodeEmailMKT\Application\Action\Campaign\{
    CampaignCreatePageAction,
    CampaignDeletePageAction,
    CampaignListPageAction,
    CampaignUpdatePageAction
};
use CodeEmailMKT\Application\Action\Customer\ {
    CustomerCreatePageAction, CustomerDeletePageAction, CustomerListPageAction, CustomerUpdatePageAction
};

use CodeEmailMKT\Application\Action\Login\ {
    LoginPageAction, LogoutAction, LoginPageFactory, LogoutFactory
};
use CodeEmailMKT\Application\Action\Tag\ {
    TagCreatePageAction, TagDeletePageAction, TagListPageAction, TagUpdatePageAction
};
use CodeEmailMKT\Application\Action\Campaign\Factory as Campaign;
use CodeEmailMKT\Application\Action\Customer\Factory as Customer;
use CodeEmailMKT\Application\Action\Tag\Factory as Tag;
use CodeEmailMKT\Application\Middleware\AuthenticationMiddleware;
use CodeEmailMKT\Application\Middleware\AuthenticationMiddlewareFactory;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            CodeEmailMKT\Application\Action\PingAction::class => CodeEmailMKT\Application\Action\PingAction::class,
        ],
        'factories' => [
            LoginPageAction::class => LoginPageFactory::class,
            LogoutAction::class => LogoutFactory::class,
            AuthenticationMiddleware::class => AuthenticationMiddlewareFactory::class,
            CustomerListPageAction::class => Customer\CustomerListPageFactory::class,
            CustomerCreatePageAction::class => Customer\CustomerCreatePageFactory::class,
            CustomerUpdatePageAction::class => Customer\CustomerUpdatePageFactory::class,
            CustomerDeletePageAction::class => Customer\CustomerDeletePageFactory::class,
            TagListPageAction::class => Tag\TagListPageFactory::class,
            TagCreatePageAction::class => Tag\TagCreatePageFactory::class,
            TagUpdatePageAction::class => Tag\TagUpdatePageFactory::class,
            TagDeletePageAction::class => Tag\TagDeletePageFactory::class,
            CampaignListPageAction::class => Campaign\CampaignListPageFactory::class,
            CampaignCreatePageAction::class => Campaign\CampaignCreatePageFactory::class,
            CampaignUpdatePageAction::class => Campaign\CampaignUpdatePageFactory::class,
            CampaignDeletePageAction::class => Campaign\CampaignDeletePageFactory::class
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => CustomerListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => CodeEmailMKT\Application\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'auth.login',
            'path' => '/auth/login',
            'middleware' => LoginPageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'auth.logout',
            'path' => '/auth/logout',
            'middleware' => LogoutAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'customer.list',
            'path' => '/admin/customers',
            'middleware' => CustomerListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'customer.create',
            'path' => '/admin/customer/create',
            'middleware' => CustomerCreatePageAction::class,
            'allowed_methods' => ['GET','POST'],
        ],
        [
            'name' => 'customer.update',
            'path' => '/admin/customer/update/{id}',
            'middleware' => CustomerUpdatePageAction::class,
            'allowed_methods' => ['GET','PUT'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'customer.delete',
            'path' => '/admin/customer/delete/{id}',
            'middleware' => CustomerDeletePageAction::class,
            'allowed_methods' => ['GET','DELETE'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'tag.list',
            'path' => '/admin/tags',
            'middleware' => TagListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'tag.create',
            'path' => '/admin/tag/create',
            'middleware' => TagCreatePageAction::class,
            'allowed_methods' => ['GET','POST'],
        ],
        [
            'name' => 'tag.update',
            'path' => '/admin/tag/update/{id}',
            'middleware' => TagUpdatePageAction::class,
            'allowed_methods' => ['GET','PUT'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'tag.delete',
            'path' => '/admin/tag/delete/{id}',
            'middleware' => TagDeletePageAction::class,
            'allowed_methods' => ['GET','DELETE'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'campaign.list',
            'path' => '/admin/campaigns',
            'middleware' => CampaignListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'campaign.create',
            'path' => '/admin/campaign/create',
            'middleware' => CampaignCreatePageAction::class,
            'allowed_methods' => ['GET','POST'],
        ],
        [
            'name' => 'campaign.update',
            'path' => '/admin/campaign/update/{id}',
            'middleware' => CampaignUpdatePageAction::class,
            'allowed_methods' => ['GET','PUT'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'campaign.delete',
            'path' => '/admin/campaign/delete/{id}',
            'middleware' => CampaignDeletePageAction::class,
            'allowed_methods' => ['GET','DELETE'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
    ],
];
