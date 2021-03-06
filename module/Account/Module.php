<?php
namespace Account;
use Application\Model\AccountTable;
use Zend\ModuleManager\ModuleManager;

class Module
{

    public function init (ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function  ($e)
        {
            $controller = $e->getTarget();
            $controller->layout('accountLayout');
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
                        'Application\Model\AccountTable' => function  ($sm)
                        {
                            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                            $table = new AccountTable($dbAdapter);
                            return $table;
                        }
                )
        );
    }
}