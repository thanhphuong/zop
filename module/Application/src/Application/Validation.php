<?php
namespace Application;

class Validation
{

    const SUMMARY_VALIDATION = "summary_validation";

    private $arr_error;

    public function __construct ()
    {
        $this->arr_error = array();
    }

    public function size ()
    {
        return count($this->arr_error);
    }

    public function getByKey ($key)
    {
        if (array_key_exists($key, $this->arr_error))
            return $this->arr_error[$key];
        return "";
    }

    public function setByKey ($key, $value)
    {
        $this->arr_error[$key] = $value;
    }
}
