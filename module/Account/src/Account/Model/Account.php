<?php
namespace Account\Model;

class Account
{

    const STATUS_NOT_VERIFY = 0;

    const STATUS_USE = 1;

    const STatus_DELETE = 2;

    public $id;

    public $pid;

    public $email;

    public $phone;

    public $password;

    public $full_name;

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
        print_r($data);
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->pid = (isset($data['pid'])) ? $data['pid'] : null;
        $this->email = (isset($data['email'])) ? strtolower(trim($data['email'])) : null;
        $this->phone = (isset($data['phone'])) ? $data['phone'] : null;
        $this->password = (isset($data['password'])) ? md5($data['password']) : null;
        $this->first_name = (isset($data['first_name'])) ? trim($data['first_name']) : null;
        $this->last_name = (isset($data['last_name'])) ? trim($data['last_name']) : null;
        $this->full_name = $this->first_name . ' ' . $this->last_name;
        $this->gender = (isset($data['gender'])) ? $data['gender'] : null;
        $birthday = null;
        if (array_key_exists('birthday', $data) == false) {
            if (checkdate($data['birthday_month'], $data['birthday_day'], $data['birthday_year'])) {
                $birthday = $data['birthday_year'] . "-" . $data['birthday_month'] . "-" . $data['birthday_day'];
            }
        } else {
            $birthday = (isset($data['birthday'])) ? $data['birthday'] : null;
        }
        
        $this->birthday = $birthday;
        $this->avatar = (isset($data['avatar'])) ? $data['avatar'] : null;
        $this->status = (isset($data['status'])) ? $data['status'] : Account::STATUS_NOT_VERIFY;
        $this->created_date = (isset($data['created_date'])) ? $data['created_date'] : null;
        $this->updated_date = (isset($data['updated_date'])) ? $data['updated_date'] : null;
    }

    public function getArrayCopy ()
    {
        return get_object_vars($this);
    }
}