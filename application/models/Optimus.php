<?php

class Application_Model_Optimus
{

    public function __construct ()
    {
        $config = Zend_Registry::get('optimus');
        $db = Zend_Db::factory($config->database);
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
    
        $this->job = new Application_Model_DbTable_OptimusJobs();
        $this->cu = new Application_Model_DbTable_OptimusCustomers();
        
    }
    
    public function getJob($jnumber)
    {
        $row = $this->job->find((int) $jnumber);
        return $row->toArray();
    }
    
    
    public function getAllCustomers ()
    {
    
        $return_arr = array();
        $rows = $this->cu->getAllActiveCustomers();
    
        foreach ($rows as $customer) {
            $return_arr[] = "'" . $customer['cu_name'] . "'". "_-_";
    
        }
        $cleanFile = implode(',', $return_arr);
        $cleanFile = str_replace('"', '', $cleanFile);
        $cleanFile = str_replace("'", '', $cleanFile);
        $cleanFile = str_replace("\\", '', $cleanFile);
        $cleanFile = str_replace("/", '', $cleanFile);
        $cleanFile = str_replace("_-_", '","', $cleanFile);
        $cleanFile = str_replace('",",', '","', $cleanFile);
        $cleanFile = '"' . $cleanFile . '-"';
        $cleanFile = substr($cleanFile, 0, -4);
        $cleanFile = utf8_encode($cleanFile);
    
    
        return $cleanFile;
    }
    
    public function getClienteRealName($cliCode)
    {
       $rows = $this->cu->getCliente($cliCode);
       
       return $rows[0]['cu_name'];
        
        
    }
    
    
    public function getParamsFromJob($obra) {
        $sql = $this->job->select();
        $sql->where('j_number= ?', (int) $obra);
        $rows = $this->job->fetchRow($sql);
    
        return $rows;
    }
    
    
}

