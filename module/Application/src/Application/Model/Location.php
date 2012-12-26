<?php
namespace Application\Model;

class Account
{

    public $id;

    public $pid;

    public $time;

    public $latitude;

    public $longitude;

    public $altitude;

    public $accuracy;

    public $speed;

    public $created_date;

    public function exchangeArray ($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->pid = (isset($data['pid'])) ? $data['pid'] : null;
        $this->time = (isset($data['time'])) ? $data['time'] : null;
        $this->latitude = (isset($data['latitude'])) ? $data['latitude'] : null;
        $this->longitude = (isset($data['longitude'])) ? $data['longitude'] : null;
        $this->altitude = (isset($data['altitude'])) ? $data['altitude'] : null;
        $this->accuracy = (isset($data['accuracy'])) ? $data['accuracy'] : null;
        $this->speed = (isset($data['speed'])) ? $data['speed'] : null;
        $this->created_date = (isset($data['created_date'])) ? $data['created_date'] : null;
    }

    public function getArrayCopy ()
    {
        return get_object_vars($this);
    }
}