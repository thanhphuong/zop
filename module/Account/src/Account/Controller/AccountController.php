<?php
namespace Account\Controller;
use Application\Constants;

use Application\Service;

use Application\Utils;

use Account\Model\Account;
use Zend\View\Helper\Layout;
use Zend\Mvc\View\Console\ViewManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\SessionNames;
use Application\Validation;
use Application\InputFilter;

class AccountController extends AbstractActionController
{

    public function indexAction ()
    {
        return new ViewModel();
    }

    public function loginAction ()
    {
        return new ViewModel();
    }

    public function logoutAction ()
    {
        return new ViewModel();
    }

    public function registerAction ()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $account = new Account();
            $account->exchangeArray($request->getPost());
            
            if ($this->isValid()) {
                return $this->redirect()->toRoute('map');
            }
        }
        return $this->redirect()->toRoute('account');
    }

    public function recoverAction ()
    {
        return new ViewModel();
    }

    private function isValid ()
    {
        $service = new Service(); 
        $translate = $service->getTranslate($this);
        $inputFilter = new InputFilter();
        $validation = new Validation();        
        
        if ($inputFilter->checkEmpty($this->email)) {
            $validation->setByKey(Validation::SUMMARY_VALIDATION, $translate("You must fill in all of the fields."));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
    }
}