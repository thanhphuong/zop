<?php
namespace Webservice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WebserviceController extends AbstractActionController
{	
	public function indexAction()
    {
        return new ViewModel();
    }    
    
}