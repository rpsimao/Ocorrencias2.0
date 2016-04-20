<?php

class RPS_Validator_RepeatJob extends Zend_Validate_Abstract
{
    
    const DUPLICATE_JOB = 'jobDuplicate';
    
    protected $db;
    
    protected $_messageTemplates = array(
            self::DUPLICATE_JOB => '* Já existe uma Ocorrência para esta Obra.');
    
    public function isValid ($value)
    {
        $this->_setValue((int) $value);
    
    
        $this->db = new Application_Model_Registos();
        $val = $this->db->findByJob($value);

                
        if (count($val) > 0) {
            
            $this->_error(self::DUPLICATE_JOB);
            return 1;
        }
        
        return 0;
    }
    
    
}

?>