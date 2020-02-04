<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller\Factory\DashboardControllerFactory;
use Application\Model\AttachmentTable;
use Application\Model\TicketTable;
use Application\Controller\Factory\TicketControllerFactory;
use Application\Model\Factory\AttachmentTableFactory;
use Application\Model\Factory\TicketTableFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

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
            Controller\DashboardController::class => DashboardControllerFactory::class,
            Controller\TicketController::class => TicketControllerFactory::class,
        ],
    ],
    'service_manager' =>[
        'factories' =>[
            TicketTable::class => TicketTableFactory::class,
            AttachmentTable::class => AttachmentTableFactory::class,
        ]
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
            
            //Ticket
            'application/ticket/del' => __DIR__ . '/../view/application/ticket/del.phtml',
            'application/ticket/edit' => __DIR__ . '/../view/application/ticket/edit.phtml',
            'application/ticket/add' => __DIR__ . '/../view/application/ticket/add.phtml',

            //Partials
            'application/ticket/form' => __DIR__ . '/../view/application/ticket/form.phtml',

            //Paginator
            'application/ticket/paginator' => __DIR__ . '/../view/application/ticket/paginator.phtml',

        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
