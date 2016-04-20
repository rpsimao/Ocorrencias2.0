<?php

class Application_Model_Pessoal
{


    private $pessoal;
    
    public function __construct ()
    {
        $config = Zend_Registry::get('pessoal');
        $db = Zend_Db::factory($config->database);
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
    
        $this->pessoal = new Application_Model_DbTable_Pessoal();
    }
    
    
    
    public function listagem()
    {
        
        $list = array();
        $sql = $this->pessoal->fetchAll();
        
        foreach ($sql as $value) {
            
            $list[]= '"' . $value['nome'] . '"';
        }
        
        $clean = implode(",", $list);
       // $clean = substr($list , 0, -1);
       
        return $clean;
        
        
    }
    
    
    
}

