<?php
namespace suggest;

return [
    'controllers' => [
        'factories' => [
            'suggest\Controller\Index' => Service\IndexControllerFactory::class,
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => sprintf('%s/../language', __DIR__),
                'pattern' => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            sprintf('%s/../view', __DIR__),
        ],
    ],
    'data_types' => [
        'factories' => [
            'valuesuggest:tematres' => Service\TemaTresDataTypeFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'value-suggest' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/value-suggest',
                            'defaults' => [
                                '__NAMESPACE__' => 'suggest\Controller',
                                'controller' => 'Index',
                            ],
                        ],
                        'may_terminate' => false,
                        'child_routes' => [
                            'proxy' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/proxy',
                                    'defaults' => [
                                        'action' => 'proxy',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
