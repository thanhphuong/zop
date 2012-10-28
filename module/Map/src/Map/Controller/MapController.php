<?php
namespace Map\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MapController extends AbstractActionController
{	
	public function indexAction()
    {
        return new ViewModel();
    }    
    
}