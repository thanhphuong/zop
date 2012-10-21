<?php
namespace Application;

class Validation
{
    private $arr_error;
    
    public function __construct()
    {
        $this->arr_error = array();
    }    
    
    public function size()
    {
        return count($this->arr_error);
    }
    
    public function getByPosition($i)
    {  
        $n = $this->size();
        if ($n != null && $i >= 0 && $i < $n)      
            return $this->arr_error[$i];
        return null;
    }
    
    public function getByKey($key)
    {
    	return $this->arr_error[$key];
    }
    
    /**
     * Push one or more elements onto the end of array
     */
    public function push($error)
    {
        array_push($this->arr_error, $error);
    }
    
    /**
     * Pop the element off the end of array
     */
    public function pop()
    {
        return array_pop($this->arr_error);
    }
    
    /**
     * Prepend one or more elements to the beginning of an array
     */
    public function unshift($error)
    {
    	array_unshift($this->arr_error, $error);
    }
    
    /**
     * Shift an element off the beginning of array
     */
    public function shift()
    {
    	return array_shift($this->arr_error);
    }
    
    public function removeAll()
    {
        unset($this->arr_error);
    }
}
