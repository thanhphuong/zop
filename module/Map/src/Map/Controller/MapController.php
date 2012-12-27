<?php
namespace Map\Controller;

use Application\SessionNames;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MapController extends AbstractActionController
{	
    
    protected $locationTable;
    
    public function getLocationTable ()
    {
    	if (! $this->locationTable) {
    		$sm = $this->getServiceLocator();
    		$this->locationTable = $sm->get('Application\Model\LocationTable');
    	}
    	return $this->locationTable;
    }
    
	public function indexAction()
    {
        //$account = $_SESSION(SessionNames::LOGIN_ACCOUNT);
        $pid = 1001;//$account->pid;
        
        $location = $this->getLocationTable()->getLastLocationByPid($pid);
                
        return array(
        		'location' => $location,        		
        );
    }    
    
}