<?php

class Application_Model_Passwords
{

    private $db;
    
    public function __construct ()
    {
        $config = Zend_Registry::get('passwords');
        $db = Zend_Db::factory($config->database);
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
    
        $this->db = new Application_Model_DbTable_Passwords();
        
    
    }
    
    
    
    public function findByPasswd($passwd)
    {
        
        $sql = $this->db->select();
        $sql->where("new_password = ?", (int) $passwd);
        $row = $this->db->fetchRow($sql);
        
        return $row;
        
               
    }
    
    
    
    
}

