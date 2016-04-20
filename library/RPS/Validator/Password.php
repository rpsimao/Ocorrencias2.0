<?php

/** 
 * @author rpsimao
 * 
 */
class RPS_Validator_Password extends Zend_Validate_Abstract
{
    const PASSWD_ERROR = 'passwordError';

    protected $db;

    protected $_messageTemplates = array(
        self::PASSWD_ERROR => '* Não tem autorização para aceder a este recusrso.');

    public function isValid ($value)
    {
         $this->_setValue((int) $value);

        
         $this->db = new Application_Model_Passwords();
         $val = $this->db->findByPasswd($value);
         
         
         if ($val['ocorrencias'] == 0) {
            $this->_error(self::PASSWD_ERROR);
            return false;
        } 
        return true;
    }
}

?>