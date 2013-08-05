<?php
namespace Application\Model;

class Group
{

    public $id;

    public $pid;
    
	public $name;
	
    public $created_date;

    public function exchangeArray ($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->pid = (isset($data['pid'])) ? $data['pid'] : null;        
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->created_date = (isset($data['created_date'])) ? $data['created_date'] : null;
    }

    public function getArrayCopy ()
    {
        return get_object_vars($this);
    }
}