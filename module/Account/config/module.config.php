<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Account\Controller\Account' => 'Account\Controller\AccountController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'account' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/account[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Account\Controller\Account',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(    		
	        'template_path_stack' => array(
	            'account' => __DIR__ . '/../view',
	        ),
    ),
	
	'view_manager' => array(			
			'template_map' => array(
					'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
			//		'account/index/index' => __DIR__ . '/../view/account/index/index.phtml',					
			),
			'template_path_stack' => array(
	            'account' => __DIR__ . '/../view',
	        ),
	),
);