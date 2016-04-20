<?php

class RPS_Controller_Plugins_NavbarActive extends Zend_Controller_Plugin_Abstract
{
     public function preDispatch(Zend_Controller_Request_Abstract $request) {
        
         $this->controller = $this->_request->getControllerName();
         
         $layout = Zend_Layout::getMvcInstance();
         $view = $layout->getView();
         
         $view->controllerName = $this->controller;
         
        
    }
}

?>