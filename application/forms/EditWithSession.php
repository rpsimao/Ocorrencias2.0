<?php

class Application_Form_EditWithSession extends Zend_Form
{
    const ERR_EMPTY_FIELD = '* Este campo n&atilde;o pode estar vazio.';
    
    public function init ()
    {

        $this->setAction('/edit/ocorrencia/');
        $this->setMethod('post');
        
        $passwd = new Zend_Form_Element_Hidden('password');
        
        $id = new Zend_Form_Element_Text('id');
        $id->setLabel('Num. Ocorrência: * ');
        $id->setRequired(TRUE);
        $id->addValidator(new RPS_Validator_Ocorrencia());
        $id->addValidator('NotEmpty', false, array('messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => self::ERR_EMPTY_FIELD)));
        $id->setAttribs(array('onfocus'=>'onlyInt("id")'));
        
        
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Editar');
        $submit->setAttribs(array('class'=>'btn btn-primary'));
        $this->addElements(array($id,$submit,$passwd));
        
    }
}

