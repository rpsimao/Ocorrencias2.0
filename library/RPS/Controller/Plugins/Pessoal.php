<?php

class RPS_Controller_Plugins_Pessoal extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) 
    {
        
        $db = new Application_Model_Pessoal();
        $pessoal = $db->listagem();
        
        
        $view = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->view;
        
        $view->fromPluginPessoal = $pessoal;
        
    }
}