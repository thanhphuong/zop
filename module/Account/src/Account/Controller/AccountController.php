<?php
namespace Account\Controller;
use Application\Mailer;
use Application\Service;
use Application\Constants;
use Account\Model\Account;
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
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($this->isValidLogin($request->getPost())) { 
                return $this->redirect()->toRoute('map');
            }
            session_start();
            $_SESSION[SessionNames::ERROR_FORM] = $request->getPost();
        }
        
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
                $account->pid = rand(12345, 99999);
                $this->getAccountTable()->saveAccount($account);
                $mailer = new Mailer();
                $mailer->sendMailRegister($this, $account);
                
                return $this->redirect()->toRoute('map');
            }
            session_start();
            $_SESSION[SessionNames::ERROR_FORM] = $request->getPost();
        }
        
        return $this->redirect()->toRoute('account');
    }

    public function recoverAction ()
    {
        return new ViewModel();
    }

    private function isValidLogin ($data)
    {        
    	$service = new Service();
    	$translate = $service->getTranslate($this);
    	$inputFilter = new InputFilter();
    	$validation = new Validation();
    	return false;
    
    	if ($inputFilter->checkEmpty($data['email']) || ! $inputFilter->checkEmail($data['email']))    
    	{    	
    	    $validation->setByKey('title', $translate("Incorrect username"));
    	    $validation->setByKey('error_description_1', $translate("The username you entered does not belong to any account."));
    	    $validation->setByKey('error_description_2', $translate("You can login using any email, username or mobile phone number associated with your account. Make sure that it is typed correctly."));
    		$service->setValidation(SessionNames::ERROR, $validation);
    		return false;
    	}
    	
    	
    	   
    	$account = $this->getAccountTable()->getAccountByEmail($data['email']);    	
    	
    	if ($account == null || $account->email != trim($data['email'])) {
    	    $validation->setByKey('title', $translate("Incorrect Email"));
    	    $validation->setByKey('error_description_1', $translate("The email you entered does not belong to any account."));
    	    $validation->setByKey('error_description_2', $translate("You can login using any email, username or mobile phone number associated with your account. Make sure that it is typed correctly."));
    		$service->setValidation(SessionNames::ERROR, $validation);
    	    return false;
    	} 
    	
    	
    	if ( $inputFilter->checkEmpty($data['password']) || ! $inputFilter->checkStringLength($data['password'], 4, 30) || $account->password != md5($data['password']))
    	{
    		$validation->setByKey('title', $translate("Please re-enter your password"));
    		$validation->setByKey('error_description_1', $translate("The password you entered is incorrect. Please try again (make sure your caps lock is off)."));
    		$validation->setByKey('error_description_2', $translate("Forgot your password? <a target='' href=\"/recover.php?email_or_phone=sf%40yahoo.com\">Request a new one.</a>"));
    		$service->setValidation(SessionNames::ERROR, $validation);
    		return false;
    	}
    
    	return true;
    }
    
    private function isValidRegister ($data)
    {
        $service = new Service();
        $translate = $service->getTranslate($this);
        $inputFilter = new InputFilter();
        $validation = new Validation();
        
        if ($inputFilter->checkEmpty($data['email']) || $inputFilter->checkEmpty($data['first_name']) || $inputFilter->checkEmpty($data['last_name']) || $inputFilter->checkEmpty($data['password'])) 

        {
            $validation->setByKey(Validation::SUMMARY_VALIDATION, $translate("You must fill in all of the fields."));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
        
        if (! $inputFilter->checkEmail($data['email'])) {
            $validation->setByKey(Validation::SUMMARY_VALIDATION, $translate("Please enter a valid email address."));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
        
        if ($this->getAccountTable()->checkEmailExists($data['email'])) {
            $validation->setByKey(Validation::SUMMARY_VALIDATION, sprintf($translate("Sorry, it looks like %s belongs to an existing account."), $data['email']));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
        
        if ($data['email'] != $data['email_confirmation']) {
            $validation->setByKey(Validation::SUMMARY_VALIDATION, $translate("Your emails do not match. Please try again."));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
        
        if (! checkdate($data['birthday_month'], $data['birthday_day'], $data['birthday_year'])) {
            $validation->setByKey(Validation::SUMMARY_VALIDATION, $translate("You must indicate your full birthday to register."));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
        
        if ($data['gender'] == 0) {
            $validation->setByKey(Validation::SUMMARY_VALIDATION, $translate("Please select either Male or Female."));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
        
        if (! $inputFilter->checkStringLength($data['password'], 4, 30)) {
            $validation->setByKey(Validation::SUMMARY_VALIDATION, $translate("Password must be between 4 to 30 characters."));
            $service->setValidation(SessionNames::ERROR, $validation);
            return false;
        }
        
        return true;
    }
}