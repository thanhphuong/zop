<?php
namespace Account\Model;

class Account
{

    public $id;

    public $email;

    public $phone;

    public $password;

    public $first_name;

    public $last_name;

    public $gender;

    public $birthday;

    public $avatar;

    public $status;

    public $created_date;

    public $updated_date;

    public function exchangeArray ($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->phone = (isset($data['phone'])) ? $data['phone'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->first_name = (isset($data['first_name'])) ? $data['first_name'] : null;
        $this->last_name = (isset($data['last_name'])) ? $data['last_name'] : null;
        $this->gender = (isset($data['gender'])) ? $data['gender'] : null;
        $this->birthday = (isset($data['birthday'])) ? $data['birthday'] : null;
    }
}