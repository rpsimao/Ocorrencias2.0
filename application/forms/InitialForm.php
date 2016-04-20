<?php

class Application_Form_InitialForm extends Zend_Form
{

const ERR_EMPTY_FIELD = '* Este campo n&atilde;o pode estar vazio.';

    const ERR_LENGHT_PASSWD = '* A palavra passe tem de ter entre 4 e 12 caracteres.';

    const ERR_COD_F3 = '* Este campo tem de conter 5 algarismos.';

    const ERR_EMAIL_MALFORMED = '* O endere&ccedil;o de email n&atilde;o &eacute; v&aacute;lido';

    const ERR_ONLY_NUMBERS_ALLOWED = "* Este campo s&oacute; pode conter algarismos.";

    const ERR_DATA = "* A data n&atilde;o est&aacute; correcta (utilize AAAA-MM-DD).";

    public function init ()
    {

        $this->setMethod('post');
        $this->setAction('/new/create');
        $this->setAttrib('id', 'new_registo_form');
        $this->setAttrib('onsubmit', 'checkCliente()');
        
        /**
         * Tipo de Registo
         */
        $tipo_registo = new Zend_Form_Element_Select('tipo_registo');
        $tipo_registo->setLabel('Tipo de Registo: *');
        $tipo_registo->setRequired(TRUE);
        $tipo_registo->addMultiOptions(array(
            '' => 'Seleccione uma opção:' , 
            'ocorrencia' => 'Ocorrência',
            'nao_conformidade' => 'Não Conformidade',
            'reclamacao' => 'Reclamação',
            'oportunidade_melhoria' => 'Oportunidade de melhoria'
        ));
        $tipo_registo->setErrorMessages(array(
            self::ERR_EMPTY_FIELD));
        
        /**
         * @var $anulada Zend_Form_Element_Checkbox
         */
        $anulada = new Zend_Form_Element_Checkbox('anulada');
        $anulada->setLabel('Anulada:');
        /**
         * @var $origem Zend_Form_Element_Select
         */
        $origem = new Zend_Form_Element_Select('origem');
        $origem->setLabel('Origem: *');
        $origem->setRequired(TRUE);
        $origem->addMultiOptions(array(
            '' => 'Seleccione uma opção:' , 
            'Fornecedor' => 'Fornecedor' , 
            'Interna' => 'Interna' , 
           // 'Reclamacao' => 'Reclama&ccedil;&atilde;o' ,
            'Externa' => 'Externa' ,  
            'Auditoria' => 'Auditoria' , 
            'Outros' => 'Outros',
            'Incidente' => 'Incidente',
            'Acidente' => 'Acidente'
        ));
        $origem->setErrorMessages(array(
            self::ERR_EMPTY_FIELD));
        /**
         * @var $sistema Zend_Form_Element_Select
         */
        $sistema = new Zend_Form_Element_Select('sistema');
        $sistema->setLabel('Sistema: *');
        $sistema->setRequired(TRUE);
        $sistema->addMultiOptions(array(
            '' => 'Seleccione uma opção:' , 
            'Qualidade' => 'Qualidade' , 
            'Ambiente' => 'Ambiente' , 
            'Seguranca' => 'Segurança' , 
            'QAS' => 'QAS' , 
            'Ambiente e Seguranca' => "Ambiente e Segurança" ,
            'CdR FSC' => 'CdR FSC',
            'CdR PEFC' => 'CdR PEFC',
            'QAS e CdR' => 'QAS e CdR',
            'CdR FSC-PEFC' => 'CdR FSC-PEFC',
            'Outros' => 'Outros'));
        $sistema->setErrorMessages(array(
            self::ERR_EMPTY_FIELD));
        /**
         * 
         * @var doc_referencia
         */
        $doc_referencia = new Zend_Form_Element_Text('doc_referencia');
        $doc_referencia->setLabel('Doc. Referência');
        $doc_referencia->setAttribs(array(
            'size' => 40));
        /**
         * @var $obra Zend_Form_Element_Text
         */
        $obra = new Zend_Form_Element_Text('obra');
        $obra->setLabel('Nº Obra:');
        $obra->setAttribs(array('size' => 5));
        
        
        $fsc = new Zend_Form_Element_Checkbox('matcert');
        $fsc->setLabel('Mat. Prima Certf. (FSC/PEFC)');
        
        
        /**
         * 
         * @var unknown_type
         */
        $trabalho = new Zend_Form_Element_Text('trabalho');
        $trabalho->setLabel('Trabalho:*');
        $trabalho->setRequired(TRUE);
        $trabalho->setErrorMessages(array(
            self::ERR_EMPTY_FIELD));
        $trabalho->setAttribs(array(
            'size' => 50));
        
        $jobtype = new Zend_Form_Element_Text('jobtype');
        $jobtype->setLabel('Tipo Trabalho:');
        $jobtype->setAttribs(array('size' => 50));
        
        $lote = new Zend_Form_Element_Text('lote');
        $lote->setLabel('Lote:');
        $lote->setAttribs(array(
            'size' => 20));
        $entidade = new Zend_Form_Element_Text('entidade');
        $entidade->setLabel('Entidade/Cliente:*');
        $entidade->setRequired(TRUE);
        $entidade->setErrorMessages(array(
            self::ERR_EMPTY_FIELD));
        $entidade->setAttribs(array(
            'size' => 40));
        $entidade->setAttrib('onblur', 'revertCSS();');
        
        
        $qtd_recebida = new Zend_Form_Element_Text('qtd_recebida');
        $qtd_recebida->setLabel('Qtd. Recebida:');
        $qtd_recebida->addValidators(array(
            new Zend_Validate_Int()));
        $qtd_recebida->setErrorMessages(array(
            self::ERR_ONLY_NUMBERS_ALLOWED));
        $qtd_recebida->setAttribs(array(
            'size' => 10, 'onfocus' => 'onlyInt("qtd_recebida")'));
        $qtd_reclamada = new Zend_Form_Element_Text('qtd_reclamada');
        $qtd_reclamada->setLabel('Qtd. Reclamada:');
        $qtd_reclamada->addValidators(array(
            new Zend_Validate_Int()));
        $qtd_reclamada->setErrorMessages(array(
            self::ERR_ONLY_NUMBERS_ALLOWED));
        $qtd_reclamada->setAttribs(array(
            'size' => 10, 'onfocus' => 'onlyInt("qtd_reclamada")'));
        $qtd_falta = new Zend_Form_Element_Text('qtd_falta');
        $qtd_falta->setLabel('Qtd. em Falta:');
        $qtd_falta->addValidators(array(
            new Zend_Validate_Int()));
        $qtd_falta->setErrorMessages(array(
            self::ERR_ONLY_NUMBERS_ALLOWED));
        $qtd_falta->setAttribs(array(
            'size' => 10, 'onfocus' => 'onlyInt("qtd_falta")'));
        $ordem_compra = new Zend_Form_Element_Text('ordem_compra');
        $ordem_compra->setLabel('Ordem Compra:');
        $ordem_compra->setAttribs(array(
            'size' => 20));
        $amostra_disponivel = new Zend_Form_Element_Checkbox('amostra_disponivel');
        $amostra_disponivel->setLabel('Amostra Disponível:');
        $situacao_corrente = new Zend_Form_Element_Checkbox('situacao_recorrente');
        $situacao_corrente->setLabel('Situação Recorrente:');
        /**
         * @var $dia Zend_Form_Element_Text
         */
        $data_detectada = new Zend_Form_Element_Text('data_detectada');
        $data_detectada->setLabel('Data:');
        $data_detectada->setRequired(TRUE);
        $data_detectada->addValidators(array(
            new Zend_Validate_Date()));
        $data_detectada->setErrorMessages(array(
            self::ERR_DATA));
        $data_detectada->setAttribs(array(
            'size' => 10));
        $descricao_problema = new Zend_Form_Element_Textarea('descricao_problema');
        $descricao_problema->setLabel('Descrição do Problema: *');
        $descricao_problema->setRequired(TRUE);
        $descricao_problema->setErrorMessages(array(
            self::ERR_EMPTY_FIELD));
        $descricao_problema->setAttribs(array(
            'rows' => 10 , 
            'cols' => 50));
        $notificacao = new Zend_Form_Element_Checkbox('notificacao');
        $notificacao->setLabel('Notificação:');
        $rejeicao = new Zend_Form_Element_Checkbox('rejeicao');
        $rejeicao->setLabel('Rejeiçã;o:');
        $nao_aceite = new Zend_Form_Element_Checkbox('nao_aceite');
        $nao_aceite->setLabel('Não aceite:');
        $anomalia = new Zend_Form_Element_Checkbox('anomalia');
        $anomalia->setLabel('Anomalia:');
        $detectado = new Zend_Form_Element_Text('detectado');
        $detectado->setLabel('Detectado por:');
        $detectado->setAttribs(array(
            'size' => 30));
        /**
         * @var $submit Zend_Form_Element_Submit
         */
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Registar Ocorrência');
        $submit->setAttrib('class', 'btn btn-primary');
        
        $clienteCheck = new Zend_Form_Element_Hidden('clienteError');
        //$clienteCheck->setValidators(array(new RPS_Validator_Cliente()));
        
        $this->addElements(array(
            // $anulada,
            $clienteCheck,
            $tipo_registo,
            $origem , 
            $sistema , 
            $obra ,
            $fsc, 
            $doc_referencia , 
            $entidade , 
            $trabalho ,
            $jobtype,
            $lote , 
            $qtd_recebida , 
            $qtd_reclamada ,
            $qtd_falta , 
            $ordem_compra , 
            $amostra_disponivel , 
            $situacao_corrente , 
            $data_detectada , 
            $descricao_problema , 
            //$notificacao , 
            //$rejeicao , 
            //$nao_aceite , 
            //$anomalia , 
            $detectado , 
            $submit));
        $this->setElementDecorators(array(
            'ViewHelper' , 
            'Errors' , 
            array(
                array(
                    'data' => 'HtmlTag') , 
                array(
                    'tag' => 'td' , 
                    'class' => 'element')) , 
            array(
                'Label' , 
                array(
                    'tag' => 'td')) , 
            array(
                array(
                    'row' => 'HtmlTag') , 
                array(
                    'tag' => 'tr'))));
        $submit->setDecorators(array(
            'ViewHelper' , 
            array(
                array(
                    'data' => 'HtmlTag') , 
                array(
                    'tag' => 'td' , 
                    'class' => 'element')) , 
            array(
                array(
                    'emptyrow' => 'HtmlTag') , 
                array(
                    'tag' => 'td' , 
                    'class' => 'element' , 
                    'placement' => 'PREPEND')) , 
            array(
                array(
                    'row' => 'HtmlTag') , 
                array(
                    'tag' => 'tr'))));
        $this->setDecorators(array(
            'FormElements' , 
            array(
                'HtmlTag' , 
                array(
                    'tag' => 'table')) , 
            'Form'));
    }


}

