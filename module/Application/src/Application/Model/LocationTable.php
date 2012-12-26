<?php
namespace Application\Model;
use Zend\Db\Sql\Select;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class LocationTable extends AbstractTableGateway
{

    protected $table = 'zop_location';

    public function __construct (Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Location());
        $this->initialize();
    }

    public function fetchAll ()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function checkEmailExists ($email)
    {
        $rowset = $this->select(array(
                'email' => $email
        ));
        $row = $rowset->current();
        if (! $row) {
            return FALSE;
        }
        return TRUE;
    }

    public function getLocation ($id)
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

    public function saveLocation (Location $location)
    {
        $data = array(
                'pid' => $location->pid,
                'time' => $location->time,
                'latitude' => $location->pid,
                'longitude' => $location->pid,
                'altitude' => $location->pid,
                'accuracy' => $location->accuracy,
                'speed' => $location->speed,
                'created_date' => $location->created_date
        );
        $id = (int) $location->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getLocation($id)) {
                $this->update($data, array(
                        'id' => $id
                ));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteLocation ($id)
    {
        $this->delete(array(
                'id' => $id
        ));
    }
}