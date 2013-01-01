<?php
namespace Webservice\Controller;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Account;
use Application\InputFilter;
use Application\Model\Location;

class WebserviceController extends AbstractActionController
{

    protected $accountTable;    

    protected $locationTable;

    public function getAccountTable ()
    {
        if (! $this->accountTable) {
            $sm = $this->getServiceLocator();
            $this->accountTable = $sm->get('Application\Model\AccountTable');
        }
        return $this->accountTable;
    }

    public function getLocationTable ()
    {
        if (! $this->locationTable) {
            $sm = $this->getServiceLocator();
            $this->locationTable = $sm->get('Application\Model\LocationTable');
        }
        return $this->locationTable;
    }

    public function indexAction ()
    {
        return new ViewModel();
    }

    public function loginAction ()
    {
        $pid = 0;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $pid = $this->checkLogin($request->getPost());
        }
                
        return new ViewModel(array(
                "result" => $pid
        ));
    }

    public function savelocationAction ()
    {
        $result = 0;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $location = new Location();
            $location->exchangeArray($request->getPost());
            try {
                $this->getLocationTable()->saveLocation($location);
                $result = 1;
            } catch (Exception $e) {}
        }
        
        return new ViewModel(array(
                "result" => $result
        ));
    }

    private function checkLogin ($data)
    {
        $inputFilter = new InputFilter();
        
        if ($inputFilter->checkEmpty($data['email']) || ! $inputFilter->checkEmail($data['email']))
            return 0;
        
        $account = $this->getAccountTable()->getAccountByEmail($data['email']);
        
        if ($account == null || $account->email != trim($data['email']))
            return (- 1);
        
        if ($account->status == Account::STATUS_NOT_VERIFY)
            return (- 3);
        if ($account->status == Account::STATUS_DELETE)
            return (- 4);
        if ($account->status == Account::STATUS_LOCK)
            return (- 5);
        
        if ($inputFilter->checkEmpty($data['password']) || ! $inputFilter->checkStringLength($data['password'], 4, 30) || $account->password != md5($data['password']))
            return (- 2);
        
        return $account->pid;
    }
}