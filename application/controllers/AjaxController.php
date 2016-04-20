<?php

class AjaxController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
        // action body
    }

    public function typeaheadAction()
    {
       $db = new Application_Model_Optimus();
       $clientes = $db->getAllCustomers();
       
       $this->getResponse()->appendBody($clientes);
    }

    public function optimusjobdataAction()
    {
        $jnumber = $this->_getParam('job');
        $db = new Application_Model_Optimus();
        $jobdata = $db->getJob($jnumber);
        
        $json = Zend_Json_Encoder::encode(array('j_customer' => $jobdata[0]['j_customer'], 'j_title1' => utf8_encode($jobdata[0]['j_title1']), 'j_type' => $jobdata[0]['j_type'] ));
        
        $this->getResponse()->appendBody($json);
        
    }
    
    
    public function optimusjobtypeAction()
    {
        $jnumber = $this->_getParam('job');
        $db = new Application_Model_Optimus();
        $jobdata = $db->getJob($jnumber);
    
        $this->getResponse()->appendBody($jobdata[0]['j_type']);
    
    }

    public function clienteAction()
    {
        $cliCode = $this->_getParam('c');
        
        $db = new Application_Model_Optimus();
        $cliente = $db->getClienteRealName($cliCode);
        
        $this->getResponse()->appendBody(utf8_encode($cliente));
        
       
    }
    
    
    public function custoAction()
    {
        $job = $this->_getParam('j');
        $qtd = $this->_getParam('qtd');
    
    
        $db = new Application_Model_Optimus();
        $params = $db->getParamsFromJob($job);
    
        if ($params['j_price'] > 0){
    
            $valorCadaCaixa = $params['j_price'] / $params['j_qty_ordered'];
            $valorEstrago = $valorCadaCaixa * $qtd;
    
    
            $this->getResponse()->appendBody(round($valorEstrago, 3));
    
        }
    }
    
    
    public function validatepasswdAction()
    {
        $passwd = $this->_getParam('p');
        
        $val = new RPS_Validator_Password();
        $txt = $val->isValid($passwd);
        
        
        $this->getResponse()->appendBody($txt);
        
        
    }
    
    
    public function checkrepeatjobAction()
    {
        
        $job = $this->_getParam('job');
        
        $val = new RPS_Validator_RepeatJob();
        $txt = $val->isValid($job);
        
        $this->getResponse()->appendBody($txt);
        
        
        
    }


}







