<?php
namespace Map;

use Map\Model\GPSTable;

class Module
{
	public function getAutoloaderConfig()
	{
		return array(
				'Zend\Loader\ClassMapAutoloader' => array(
						__DIR__ . '/autoload_classmap.php',
				),
				'Zend\Loader\StandardAutoloader' => array(
						'namespaces' => array(
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
						),
				),
		);
	}

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}
	

	// Add this method:
	public function getServiceConfig()
	{
		return array(
				'factories' => array(
						'Map\Model\GPSTable' =>  function($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$table     = new GPSTable($dbAdapter);
							return $table;
						},
				),
		);
	}
}