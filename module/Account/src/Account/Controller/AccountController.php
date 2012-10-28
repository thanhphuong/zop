<?php
namespace Account\Controller;
use Application\Service;
use Application\Constants;
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

    protected $accountTable;

    public function getAccountTable ()
    {
        if (! $this->accountTable) {
            $sm = $this->getServiceLocator();
            $this->accountTable = $sm->get('Account\Model\AccountTable');
        }
        return $this->accountTable;
    }

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
            
            if ($this->isValidRegister($request->getPost())) {                
                $this->getAccountTable()->saveAccount($account);
                return $this->redirect()->toRoute('map');
            }
            session_start();
            $_SESSION[SessionNames::ERROR_REGISTER_ACCOUNT] = $request->getPost();
        }        
        
        return $this->redirect()->toRoute('account');
    }

    public function recoverAction ()
    {
        return new ViewModel();
    }

    private function isValidRegister ($data)
    {
        $service = new Service();
        $translate = $service->getTranslate($this);
        $inputFilter = new InputFilter();
        $validation = new Validation();
        
        if ($inputFilter->checkEmpty($data['email']) ||
                 $inputFilter->checkEmpty($data['first_name']) ||
                 $inputFilter->checkEmpty($data['last_name']) ||
                 $inputFilter->checkEmpty($data['password'])) 

        {
            $validation->setByKey(Validation::SUMMARY_VALIDATION, 
                    $translate("You must fill in all of the fields."));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
        
        if (!$inputFilter->checkEmail($data['email']))
        {
            $validation->setByKey(Validation::SUMMARY_VALIDATION,
            		$translate("Please enter a valid email address."));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
        
        if ($this->getAccountTable()->checkEmailExists($data['email']))
        {
        	$validation->setByKey(Validation::SUMMARY_VALIDATION,
        			sprintf($translate("Sorry, it looks like %s belongs to an existing account."), $data['email']));
        	$service->setValidation(SessionNames::ERROR, $validation);
        	return false;
        }
        
        if ($data['email'] != $data['email_confirmation'])
        {
        	$validation->setByKey(Validation::SUMMARY_VALIDATION,
        			$translate("Your emails do not match. Please try again."));
        	$service->setValidation(SessionNames::ERROR, $validation);
        	return false;
        }
        
        if (!checkdate($data['birthday_month'], $data['birthday_day'],
        		$data['birthday_year']))
        {
        	$validation->setByKey(Validation::SUMMARY_VALIDATION,
        			$translate("You must indicate your full birthday to register."));
        	$service->setValidation(SessionNames::ERROR, $validation);
        	return false;
        }
        
        if ($data['gender'] == 0)
        {
        	$validation->setByKey(Validation::SUMMARY_VALIDATION,
        			$translate("Please select either Male or Female."));
        	$service->setValidation(SessionNames::ERROR, $validation);
        	return false;
        }
        
        if (!$inputFilter->checkStringLength($data['password'], 4, 30))
        {
            $validation->setByKey(Validation::SUMMARY_VALIDATION, 
                    $translate("Password must be between 4 to 30 characters."));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
        
        return true;
    }
}