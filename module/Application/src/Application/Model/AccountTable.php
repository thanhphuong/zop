<?php
namespace Application\Model;
use Zend\Db\Sql\Select;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class AccountTable extends AbstractTableGateway
{

    protected $table = 'zop_account';

    public function __construct (Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Account());
        $this->initialize();
    }

    public function fetchAll ()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function checkEmailExists ($email)
    {
        $rowset = $this->select(
                array(
                        'email' => $email
                ));
        $row = $rowset->current();
        if (! $row) {
            return FALSE;
        }
        return TRUE;
    }

    public function getAccount ($id)
    {
        $id = (int) $id;
        $rowset = $this->select(array(
                'id' => $id
        ));
        $row = $rowset->current();
        if (! $row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    
    public function getAccountByEmail ($email)
    {       	  	
    	$rowset = $this->select(array(
    			'email' => $email
    	));    	
    	$row = $rowset->current();    	
    	if (! $row) {    		
    		return null;
    	}    	
    	return $row;
    }
    
    public function getAccountByPhone ($phone)
    {    	
    	$rowset = $this->select(array(
    			'phone' => $phone
    	));
    	$row = $rowset->current();
    	if (! $row) {
    		return null;
    	}
    	return $row;
    }

    public function saveAccount (Account $account)
    {
        $data = array(
                'pid' => $account->pid,
                'email' => $account->email,
                'phone' => $account->phone,
                'password' => $account->password,
                'full_name' => $account->full_name,
                'first_name' => $account->first_name,
                'last_name' => $account->last_name,
                'gender' => $account->gender,
                'birthday' => $account->birthday,
                'avatar' => $account->avatar,
                'status' => $account->status,
                'created_date' => $account->created_date,
                'updated_date' => $account->updated_date
        );
        $id = (int) $account->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getAccount($id)) {
                $this->update($data, 
                        array(
                                'id' => $id
                        ));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteAccount ($id)
    {
        $this->delete(array(
                'id' => $id
        ));
    }
}