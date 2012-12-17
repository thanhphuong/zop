<?php
namespace Webservice\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WebserviceController extends AbstractActionController
{

    private static $temp;

    public function indexAction ()
    {
        return new ViewModel();
    }

    public function loginAction ()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $temp = $request->getPost();
        }
        
        return new ViewModel(array(
                "json" => $temp
        ));
    }
}