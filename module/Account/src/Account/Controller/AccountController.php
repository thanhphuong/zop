<?php
namespace Account\Controller;
use Application\ValidationConstants;
use Application\Mailer;
use Application\Service;
use Application\Constants;
use Application\Model\Account;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\SessionNames;
use Application\Validation;
use Application\InputFilter;

class AccountController extends AbstractActionController
{

    protected $accountTable;

    protected $form;

    protected $errors;

    public function getAccountTable ()
    {
        if (! $this->accountTable) {
            $sm = $this->getServiceLocator();
            $this->accountTable = $sm->get('Application\Model\AccountTable');
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
                $data = $request->getPost();
                $account = $this->getAccountTable()->getAccountByEmail($data['email']);
                $_SESSION[SessionNames::LOGIN_ACCOUNT] = $account;
                
                return $this->redirect()->toRoute('map');
            }
            
            $this->form = $request->getPost();
        }
        
        return array(
                "errors" => $this->errors,
                "form" => $this->form
                );
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
                $account->password = md5($account->password);
                $this->getAccountTable()->saveAccount($account);
                $mailer = new Mailer();
                $mailer->sendMailRegister($this, $account);
                
                return $this->redirect()->toRoute('map');
            }
            if (! isset($_SESSION)) {
                session_start();
            }
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
        $email = strtolower(trim($data['email'])); 
        
        if ($inputFilter->checkEmpty($email) || ! $inputFilter->checkEmail($email)) {
            $this->errors = array(
                    "title" => $translate("Incorrect username"),
                    "error1" => $translate("The username you entered does not belong to any account."),
                    "error2" => $translate("You can login using any email, username or mobile phone number associated with your account. Make sure that it is typed correctly.") 
            );            
            return false;
        }
        
        $account = $this->getAccountTable()->getAccountByEmail($email);        
        
        if ($account == null) {
            $this->errors = array(
            		"title" => $translate("Incorrect Email"),
            		"error1" => $translate("The email you entered does not belong to any account."),
            		"error2" => $translate("You can login using any email, username or mobile phone number associated with your account. Make sure that it is typed correctly.")
            );          
            return false;
        }
        
        if ($account->status == Account::STATUS_NOT_VERIFY) {
        	$this->errors = array(
        			"title" => $translate("Verify Email"),
        			"error1" => $translate("You must verify your email address before you can use it on ProjectName services."),
        			"error2" => sprintf($translate("Verify your email? <a target='' href=\"/verify.php?email=%s\">Request a new one.</a>"), $account->email)
        	);
        	return false;
        }
        
//         if ($account->status == Account::STATUS_LOCK) {
//         	$this->errors = array(
//         			"title" => $translate("Locked Account"),
//         			"error1" => $translate("Your account locked."),
//         			"error2" => $translate("You can login using any email, username or mobile phone number associated with your account. Make sure that it is typed correctly.")
//         	);
//         	return false;
//         }
        
//         if ($account->status == Account::STATUS_DELETE) {
//         	$this->errors = array(
//         			"title" => $translate("Incorrect Email"),
//         			"error1" => $translate("The email you entered does not belong to any account."),
//         			"error2" => $translate("You can login using any email, username or mobile phone number associated with your account. Make sure that it is typed correctly.")
//         	);
//         	return false;
//         }
        
        if ($inputFilter->checkEmpty($data['password']) || ! $inputFilter->checkStringLength($data['password'], 4, 30) || $account->password != md5($data['password'])) {
            $this->errors = array(
            		"title" => $translate("Please re-enter your password"),
            		"error1" => $translate("The password you entered is incorrect. Please try again (make sure your caps lock is off)."),
            		"error2" => sprintf($translate("Forgot your password? <a target='' href=\"/recover.php?email=%s\">Request a new one.</a>"), $account->email)
            );            
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