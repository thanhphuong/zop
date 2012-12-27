<?php
namespace Map;

use Zend\ModuleManager\ModuleManager;
use Application\Model\LocationTable;

class Module
{

    public function init (ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function  ($e)
        {
            $controller = $e->getTarget();
            $controller->layout('mapLayout');
        }, 100);
    }

    public function getAutoloaderConfig ()
    {
        return array(
                'Zend\Loader\ClassMapAutoloader' => array(
                        __DIR__ . '/autoload_classmap.php'
                ),
                'Zend\Loader\StandardAutoloader' => array(
                        'namespaces' => array(
                                __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                        )
                )
        );
    }

    public function getConfig ()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    // Add this method:
    public function getServiceConfig ()
    {
        return array(
                'factories' => array(
                        'Application\Model\LocationTable' => function  ($sm)
                        {
                            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                            $table = new LocationTable($dbAdapter);
                            return $table;
                        }
                )
        );
    }
}