<?php

class Application_Form_Export extends Zend_Form
{

    const ERR_EMPTY_FIELD = '* Este campo n&atilde;o pode estar vazio.';
    const ERR_NO_VALUE    = "* Tem de escolher uma das opções.";
    
    
    
    public function init ()
    {

        
        $this->setAttribs(array("id"=>"export-form", "onsubmit" => "return checkUser()"));
        $this->setMethod('POST');
        $this->setAction('/export/pdf/');
        
        /*$passwd = new Zend_Form_Element_Password('password');
        $passwd->setLabel('Palavra-passe:');
        $passwd->setRequired(TRUE);
        $passwd->addValidator(new RPS_Validator_Password());
        $passwd->setAttribs(array('onfocus'=>'onlyInt("password")'));*/
        
        
        $id = new Zend_Form_Element_Text('id');
        $id->setLabel('Num. Ocorr&ecirc;ncia: * ');
        $id->setRequired(TRUE);
        $id->addValidator(new RPS_Validator_Ocorrencia());
        $id->addValidator('NotEmpty', false, array('messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => self::ERR_EMPTY_FIELD)));
        
        $type = new Zend_Form_Element_Radio('tipo');
        $type->setLabel("Tipo:");
        $type->setRequired(TRUE);
        $type->setAttribs(array("class" => "radio-tipo"));
        $type->setSeparator("");
        
        
        $type->addMultiOptions(array("interno" => "Interno", "externo" => "Externo"));
        
        $type->addErrorMessage(self::ERR_NO_VALUE);
        
        $user = new Zend_Form_Element_Select('user');
        $user->setLabel("Operador:");
        $user->setAttribs(array("class" => "hiden"));
        $user->addMultiOptions(array("" => "Escolha o operador:",
            "carina" => "Carina Santos",
            //"ana" => "Ana Spínola",
            "margarida"=>"Margarida Salvado",
            "marta" => "Marta Cabral",
            "ines" => "Inês Cardoso"));
        
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Exportar')->setAttribs(array('class' => 'btn btn-primary'));
        
        
        
        $this->addElements(array(/*$passwd,*/ $id , $type, $user, $submit));
        
        
       // $this->setElementDecorators(array('ViewHelper' , 'Errors' , array(array('data' => 'HtmlTag') , array('tag' => 'td' , 'class' => 'element')) ,  array('Label' , array('tag' => 'td')) , array(array('row' => 'HtmlTag') ,  array('tag' => 'tr'))));
        
        
       // $submit->setDecorators(array('ViewHelper' ,  array(array('data' => 'HtmlTag') ,  array('tag' => 'td' , 'class' => 'element')) , array(array('emptyrow' => 'HtmlTag') , array('tag' => 'td' , 'class' => 'element' , 'placement' => 'PREPEND')) , array(array('row' => 'HtmlTag') , array('tag' => 'tr'))));
       // $this->setDecorators(array('FormElements' , array('HtmlTag' , array('tag' => 'table')) , 'Form'));
    }


}

