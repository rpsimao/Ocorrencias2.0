<?php
class RPS_Validator_Ocorrencia extends Zend_Validate_Abstract
{
    
    const OCORRENCIA_ERROR = 'ocorrenciaError';

    protected $db;

    protected $_messageTemplates = array(
        self::OCORRENCIA_ERROR => '* A Ocorr&ecirc;ncia com o N&ordm; %value% n&atilde;o existe.');

    public function isValid ($value)
    {
         $this->_setValue((int) $value);

        
         $this->db = new Application_Model_Registos();
         $val = $this->db->findById($value);
         
         
         if (!count($val) > 0) {
            $this->_error(self::OCORRENCIA_ERROR);
            return false;
        } 
        return true;
    }
}
?>