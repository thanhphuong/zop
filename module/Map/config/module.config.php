<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Map\Controller\Map' => 'Map\Controller\MapController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'map' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/map[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Map\Controller\Map',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(    		
	        'template_path_stack' => array(
	            'map' => __DIR__ . '/../view',
	        ),
    ),
);