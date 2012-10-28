<?php
namespace Application;

class InputFilter
{
    public function __construct()
    {
        
    }
    
    public function checkEmpty($value)
    {
        if (empty($value))
            return true;
        return false;
    }
    
    public function checkEmail($email)
    {
        return preg_match("^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@[a-z0-9-]+(\\.[a-z0-9-]+)*(\\.[a-z]{2,3})$^", $email);     
    }
    
    public function checkStringLength($value, $min, $max)
    {
        $length = strlen($value);  
        if ($length < $min || $length > $max)
            return false;
        return true;
    }
    
    public function checkBetween($value, $min, $max)
    {
        if (!is_numeric($value) || $value < min || $value > max)
            return false;
        return true;
    }
}