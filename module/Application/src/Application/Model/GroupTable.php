<?php
namespace Application\Model;
use Zend\Db\Sql\Select;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class GroupTable extends AbstractTableGateway
{

    protected $table = 'zop_group';

    public function __construct (Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Group());
        $this->initialize();
    }
    

    public function listGroupByPid ($pid)
    {
        $pid = (int) $pid;
        $select = new Select();
        $select->from($this->table);
        $select->where(array('pid' => $pid));               
        $rowset = $this->executeSelect($select);       
        
        return $rowset;
    }
}