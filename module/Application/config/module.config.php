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
            'dashboard' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\DashboardController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'ticket' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/ticket[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\TicketController::class,
                        'action'     => 'add',
                    ],
                    'constraints' => [
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '\d+',
                    ]
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\DashboardController::class => InvokableFactory::class,
            Controller\TicketController::class => InvokableFactory::class,
        ],
    ],
    'service_manager' =>[
        TicketTable::class => TicketTableFactory::class,
        AttachmentTable::class => AttachmentTableFactory::class,
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/dashboard/index' => __DIR__ . '/../view/application/dashboard/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'ticket/add' => __DIR__ . '/../view/ticket/dashboard/add.phtml',
            'ticket/edit' => __DIR__ . '/../view/ticket/dashboard/edit.phtml',
            'ticket/del' => __DIR__ . '/../view/ticket/dashboard/del.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
