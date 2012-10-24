<?php
namespace Application;

class Service
{

    public function getTranslate ($controller)
    {
        return $controller->getServiceLocator()
            ->get('viewmanager')
            ->getRenderer()
            ->plugin('translate');
    }

    /**
     *
     * @return Validation object
     */
    public function getValidation ($name)
    {
        if (! isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION[$name]))
            return $_SESSION[$name];
        return new Validation();
    }

    public function setValidation ($name, $validation)
    {
        if (! isset($_SESSION)) {
            session_start();
        }
        $_SESSION[$name] = $validation;
    }
}