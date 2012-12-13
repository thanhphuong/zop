<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Webservice\Controller\Webservice' => 'Webservice\Controller\WebserviceController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'webservice' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/webservice[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Webservice\Controller\Webservice',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(			
			'template_map' => array(
					'webserviceLayout'  => __DIR__ . '/../view/layout/layout.phtml',								
			),
			'template_path_stack' => array(
	            'webservice' => __DIR__ . '/../view',
	        ),
	),
);