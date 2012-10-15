<?php
namespace Account\Controller;

use Zend\View\Helper\Layout;

use Zend\Mvc\View\Console\ViewManager;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AccountController extends AbstractActionController
{	
	public function indexAction()
	{		
		return new ViewModel();
	}
	
	public function loginAction()
    {    	
        return new ViewModel();
    }
    
    public function logoutAction()
    {
    	return new ViewModel();
    }
    
    public function registerAction()    
    {  
    	  	
    	return new ViewModel();
    }
    
    public function recoverAction()
    {
    	return new ViewModel();
    }
    
}