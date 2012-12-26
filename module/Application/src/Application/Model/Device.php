<?php
namespace Application\Model;

class Account
{
    public $id;

    public $pid;

    public $did;
    
    public $updated_date;

    public function exchangeArray ($data)
    {        
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->pid = (isset($data['pid'])) ? $data['pid'] : null;
        $this->did = (isset($data['did'])) ? $data['did'] : null;        
        $this->updated_date = (isset($data['updated_date'])) ? $data['updated_date'] : null;
    }

    public function getArrayCopy ()
    {
        return get_object_vars($this);
    }
}