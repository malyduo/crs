<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'kontakt' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/kontakt',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'kontakt',
                    ],
                ],
            ],
            'samochody' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/samochody',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'samochody',
                    ],
                ],
            ],
            'regulamin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/regulamin',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'regulamin',
                    ],
                ],
            ],
//            'application' => [
//                'type'    => Segment::class,
//                'options' => [
//                    'route'    => '/application[/:action]',
//                    'defaults' => [
//                        'controller' => Controller\IndexController::class,
//                        'action'     => 'index',
//                    ],
//                ],
//            ],
            'rezerwacja' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/rezerwacja[/:action]',
                    'defaults' => [
                        'controller' => Controller\RezerwacjaController::class,
                        'action' => [
                            'index',
                            'rezerwuj'
                        ],
                    ],
                ],
            ],
//            'flota' => [
//                'type'    => Segment::class,
//                'options' => [
//                    'route'    => '/flota[/:action]',
//                    'defaults' => [
//                        'controller' => Controller\FlotaController::class,
//                        'action'     => [
//                            'index',
//                            'szukaj'
//                        ],
//                    ],
//                ],
//            ],
//            'flota' => [
//                'type' => Literal::class,
//                'options' => [
//                    'route'    => '/flota',
//                    'defaults' => [
//                        'controller' => Controller\FlotaController::class,
//                        'action'     => 'index',
//                    ],
//                ],
//            ],
//            'flota' => [
//                'type' => Literal::class,
//                'options' => [
//                    'route'    => '/flota/szukaj',
//                    'defaults' => [
//                        'controller' => Controller\FlotaController::class,
//                        'action'     => 'szukaj',
//                    ],
//                ],
//            ],
            'flota' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/flota[/:action]',
                    'defaults' => [
                        'controller' => Controller\FlotaController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\RezerwacjaController::class => InvokableFactory::class,
            Controller\FlotaController::class => InvokableFactory::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
