<?php
namespace Application\Model;
use Zend\Db\Sql\Select;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class DeviceTable extends AbstractTableGateway
{

    protected $table = 'zop_device';

    public function __construct (Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Device());
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

    public function getDevice ($id)
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
    

    public function saveDevice (Device $device)
    {
        $data = array(
                'pid' => $device->pid,
                'did' => $device->did,
                'updated_date' => $device->updated_date
        );
        $id = (int) $device->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getDevice($id)) {
                $this->update($data, 
                        array(
                                'id' => $id
                        ));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteDevice ($id)
    {
        $this->delete(array(
                'id' => $id
        ));
    }
}