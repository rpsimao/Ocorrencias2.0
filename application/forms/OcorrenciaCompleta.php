<?php

class Application_Form_OcorrenciaCompleta extends Zend_Form
{

    const ERR_EMPTY_FIELD = '* Este campo n&atilde;o pode estar vazio.';

    const ERR_LENGHT_PASSWD = '* A palavra passe tem de ter entre 4 e 12 caracteres.';

    const ERR_COD_F3 = '* Este campo tem de conter 5 algarismos.';

    const ERR_EMAIL_MALFORMED = '* O endere&ccedil;o de email n&atilde;o &eacute; v&aacute;lido';

    const ERR_ONLY_NUMBERS_ALLOWED = "* Este campo s&oacute; pode conter algarismos.";

    const ERR_DATA = "* A data n&atilde;o est&aacute; correcta (utilize AAAA-MM-DD).";

    const ERR_FLOAT = "* Exemplo: 4500.50";
    
    private $radioDecorators = array(
            'Label',
            'ViewHelper',
            array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'radio')),
            array(array('row' => 'HtmlTag'), array('tag' => 'li')),
    );

    public function init ()
    {

        $this->setMethod('post');
        $this->setAction('/edit/update');
        /**
         */
        $id = new Zend_Form_Element_Hidden('id');
        /**
         *
         * @var $origem Zend_Form_Element_Select
         */
        $anulada = new Zend_Form_Element_hidden('anulada');
        //$anulada->setLabel('Anulada:');
        /**
         * Tipo de Registo
         */
        $tipo_registo = new Zend_Form_Element_Select('tipo_registo');
        $tipo_registo->setLabel('Tipo de Registo: *');
        $tipo_registo->setRequired(TRUE);
        $tipo_registo->addMultiOptions(array(
            '' => 'Seleccione uma op&ccedil;&atilde;o:' , 
            'ocorrencia' => 'Ocorr&ecirc;ncia' , 
            'nao_conformidade' => 'N&atilde;o Conformidade' , 
            'reclamacao' => 'Reclama&ccedil;&atilde;o' , 
            'oportunidade_melhoria' => 'Oportunidade de melhoria' , 
            'Anulada' => 'Anulada'));
        $tipo_registo->setErrorMessages(array(
            self::ERR_EMPTY_FIELD));
        $origem = new Zend_Form_Element_Select('origem');
        $origem->setLabel('Origem: *');
        $origem->setRequired(TRUE);
        $origem->addMultiOptions(array(
            '' => 'Seleccione uma op&ccedil;&atilde;o:' , 
            'Fornecedor' => 'Fornecedor' , 
            'Interna' => 'Interna' , 
            'Reclamacao' => 'Reclama&ccedil;&atilde;o' , 
            'Externa' => 'Externa' , 
            'Auditoria' => 'Auditoria' , 
            'Outros' => 'Outros' , 
            'Incidente' => 'Incidente' , 
            'Acidente' => 'Acidente' , 
            'Anulada' => 'Anulada'));
        $origem->setErrorMessages(array(
            self::ERR_EMPTY_FIELD));
        /**
         *
         * @var $sistema Zend_Form_Element_Select
         */
        $sistema = new Zend_Form_Element_Select('sistema');
        $sistema->setLabel('Sistema: *');
        $sistema->setRequired(TRUE);
        $sistema->addMultiOptions(array(
            '' => 'Seleccione uma op&ccedil;&atilde;o:' , 
            'Qualidade' => 'Qualidade' , 
            'Ambiente' => 'Ambiente' , 
            'Seguranca' => 'Seguran&ccedil;a' , 
            'QAS' => 'QAS' , 
            'Ambiente e Seguranca' => 'Ambiente e Seguran&ccedil;a' , 
            'Qualidade e Ambiente' => "Qualidade e Ambiente" ,
            'Qualidade e Seguranca' => "Qualidade e Seguran&ccedil;a" ,
            'CdR FSC' => 'CdR FSC' , 
            'CdR PEFC' => 'CdR PEFC' , 
            'QAS e CdR' => 'QAS e CdR' , 
            'CdR FSC-PEFC' => 'CdR FSC-PEFC' , 
            'Outros' => 'Outros' , 
            'Anulada' => 'Anulada'));
        $sistema->setErrorMessages(array(
            self::ERR_EMPTY_FIELD));
        /**
         *
         * @var doc_referencia
         */
        $doc_referencia = new Zend_Form_Element_Text('doc_referencia');
        $doc_referencia->setLabel('Doc. Refer&ecirc;ncia');
        $doc_referencia->setAttribs(array(
            'size' => 60));
        /**
         *
         * @var $dia Zend_Form_Element_Text
         */
        $dia = new Zend_Form_Element_Text('dia');
        $dia->setLabel('Data:*');
        $dia->setRequired(TRUE);
        $dia->addValidators(array(
            new Zend_Validate_Date()));
        $dia->setErrorMessages(array(
            self::ERR_DATA));
        $dia->setAttribs(array(
            'size' => 15));
        /**
         *
         * @var $obra Zend_Form_Element_Text
         */
        $obra = new Zend_Form_Element_Text('obra');
        $obra->setLabel('N&ordm; Obra:*');
        /*
         * $obra->setRequired(TRUE); $obra->addValidators(array( new
         * Zend_Validate_StringLength(5, 5))); $obra->setErrorMessages(array(
         * self::ERR_EMPTY_FIELD , self::ERR_COD_F3));
         */
        $obra->setAttribs(array(
            'size' => 5));
        
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
        $jobtype->setAttribs(array(
            'size' => 50));
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
        $qtd_recebida = new Zend_Form_Element_Text('qtd_recebida');
        $qtd_recebida->setLabel('Qtd. Recebida:');
        $qtd_recebida->addValidators(array(
            new Zend_Validate_Int()));
        $qtd_recebida->setErrorMessages(array(
            self::ERR_ONLY_NUMBERS_ALLOWED));
        $qtd_recebida->setAttribs(array(
            'size' => 10 , 
            'onfocus' => 'onlyInt("qtd_recebida")'));
        $qtd_reclamada = new Zend_Form_Element_Text('qtd_reclamada');
        $qtd_reclamada->setLabel('Qtd. Reclamada:');
        $qtd_reclamada->addValidators(array(
            new Zend_Validate_Int()));
        $qtd_reclamada->setErrorMessages(array(
            self::ERR_ONLY_NUMBERS_ALLOWED));
        $qtd_reclamada->setAttribs(array(
            'size' => 10));
        /**
         *
         *
         * Enter description here ...
         * 
         * @var unknown_type
         */
        $qtd_falta = new Zend_Form_Element_Text('qtd_falta');
        $qtd_falta->setLabel('Qtd. em Falta:');
        $qtd_falta->addValidators(array(
            new Zend_Validate_Int()));
        $qtd_falta->setErrorMessages(array(
            self::ERR_ONLY_NUMBERS_ALLOWED));
        $qtd_falta->setAttribs(array(
            'size' => 10 , 
            'onblur' => 'custo()'));
        $ordem_compra = new Zend_Form_Element_Text('ordem_compra');
        $ordem_compra->setLabel('Ordem Compra:');
        $ordem_compra->setAttribs(array(
            'size' => 20));
        $amostra_disponivel = new Zend_Form_Element_Checkbox('amostra_disponivel');
        $amostra_disponivel->setLabel('Amostra Dispon&iacute;vel:');
        $situacao_corrente = new Zend_Form_Element_Checkbox('situacao_recorrente');
        $situacao_corrente->setLabel('Situa&ccedil;&atilde;o Recorrente:');
        /**
         *
         * @var $dia Zend_Form_Element_Text
         */
        $data_detectada = new Zend_Form_Element_Text('data_detectada');
        $data_detectada->setLabel('Data:');
        // $data_detectada->setRequired(TRUE);
        $data_detectada->addValidators(array(
            new Zend_Validate_Date()));
        $data_detectada->setErrorMessages(array(
            self::ERR_DATA));
        $data_detectada->setAttribs(array(
            'size' => 15));
        $descricao_problema = new Zend_Form_Element_Textarea('descricao_problema');
        $descricao_problema->setLabel('Descri&ccedil;&atilde;o Problema: *');
        $descricao_problema->setRequired(TRUE);
        $descricao_problema->setErrorMessages(array(
            self::ERR_EMPTY_FIELD));
        $descricao_problema->setAttribs(array(
            'rows' => 10 , 
            'cols' => 50));
        $notificacao = new Zend_Form_Element_Checkbox('notificacao');
        $notificacao->setLabel('Notifica&ccedil;&atilde;o:');
        $rejeicao = new Zend_Form_Element_Checkbox('rejeicao');
        $rejeicao->setLabel('Rejei&ccedil;&atilde;o:');
        $nao_aceite = new Zend_Form_Element_Checkbox('nao_aceite');
        $nao_aceite->setLabel('N&atilde;o aceite:');
        $anomalia = new Zend_Form_Element_Checkbox('anomalia');
        $anomalia->setLabel('Anomalia:');
        $registo = new Zend_Form_Element_Checkbox('registo');
        $registo->setLabel('Registo:');
        $reavaliacao = new Zend_Form_Element_Checkbox('reavaliacao');
        $reavaliacao->setLabel('Reavalia&ccedil;&atilde;o:');
        /*
         * $accao = new Zend_Form_Element_MultiCheckbox('accao', array(
         * 'multiOptions' => array( 0 => 'Notifica&ccedil;&atilde;o' , 1 =>
         * 'Rejei&ccedil;&atilde;o' , 2 => 'N&atilde;o aceite' )));
         * $accao->setLabel('Ac&ccedil;&atilde;o'); $accao->setRequired(TRUE);
         * $accao->setErrorMessages(array( self::ERR_EMPTY_FIELD ));
         */
        /**
         *
         * @var unknown_type
         */
        $detectado = new Zend_Form_Element_Text('detectado');
        $detectado->setLabel('Detectado por:');
        $detectado->setAttribs(array(
            'size' => 30));
        /**
         *
         * @var unknown_type
         */
        $cod_def = new Zend_Form_Element_Text('cod_def');
        $cod_def->setLabel('Codifica&ccedil;&atilde;o do defeito:');
        $cod_def->setAttribs(array(
            'size' => 30));
        /**
         *
         * @var $submit Zend_Form_Element_Submit
         */
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Actualizar Ocorr&ecirc;ncia');
        /**
         * AN�LISE
         */
        /**
         *
         * @var unknown_type
         */
        $investigacao_efectuada = new Zend_Form_Element_Textarea('investigacao_efectuada');
        $investigacao_efectuada->setLabel('Investiga&ccedil;&atilde;o Efectuada:');
        $investigacao_efectuada->setAttribs(array(
            'rows' => 10 , 
            'cols' => 50));
        /**
         *
         * @var $data_investigacao Zend_Form_Element_Text
         */
        $data_investigacao = new Zend_Form_Element_Text('data_investigacao');
        $data_investigacao->setLabel('Data Investiga&ccedil;&atilde;o:');
        $data_investigacao->addValidators(array(
            new Zend_Validate_Date()));
        $data_investigacao->setErrorMessages(array(
            self::ERR_DATA));
        $data_investigacao->setAttribs(array(
            'size' => 15));
        /**
         *
         * @var unknown_type
         */
        $preenchido_investigacao = new Zend_Form_Element_Text('preenchido_investigacao');
        $preenchido_investigacao->setLabel('Preenchido por:');
        /**
         *
         * @var unknown_type
         */
        $correcoes = new Zend_Form_Element_Textarea('correcoes');
        $correcoes->setLabel('Ac&ccedil;&otilde;es para Correc&ccedil;&atilde;o: ');
        $correcoes->setAttribs(array(
            'rows' => 10 , 
            'cols' => 50));
        /**
         */
        $data_correccoes = new Zend_Form_Element_Text('data_correccoes');
        $data_correccoes->setLabel('Data Correc&ccedil;&otilde;es:');
        $data_correccoes->addValidators(array(
            new Zend_Validate_Date()));
        $data_correccoes->setErrorMessages(array(
            self::ERR_DATA));
        $data_correccoes->setAttribs(array(
            'size' => 15));
        /**
         */
        $custo_correccoes = new Zend_Form_Element_Text('custo_correccoes');
        $custo_correccoes->setLabel('Custo Correc&ccedil;&otilde;es:');
        $custo_correccoes->addValidators(array(
            new Zend_Validate_Float("en-US")));
        $custo_correccoes->setErrorMessages(array(
            self::ERR_FLOAT));
        /**
         */
        $resp_correccoes = new Zend_Form_Element_Text('resp_correccoes');
        $resp_correccoes->setLabel('Respons&aacute;vel Correc&ccedil;&otilde;es:');
        // ===
        /**
         *
         * @var unknown_type
         */
        $id_causas = new Zend_Form_Element_Textarea('id_causas');
        $id_causas->setLabel('Identifica&ccedil;&atilde;o das causas:');
        $id_causas->setAttribs(array(
            'rows' => 10 , 
            'cols' => 50));
        /**
         */
        $data_causas = new Zend_Form_Element_Text('data_causas');
        $data_causas->setLabel('Data identifica&ccedil;&atilde;o:');
        $data_causas->addValidators(array(
            new Zend_Validate_Date()));
        $data_causas->setErrorMessages(array(
            self::ERR_DATA));
        $data_causas->setAttribs(array(
            'size' => 15));
        /**
         */
        $responsavel_causas = new Zend_Form_Element_Text('responsavel_causas');
        $responsavel_causas->setLabel('Operador:');
        /**
         */
        $seccao_causas = new Zend_Form_Element_Select('seccao_causas');
        $seccao_causas->setLabel('Sec&ccedil;&atilde;o:');
        $seccao_causas->addMultiOptions(array(
            '' => 'Seleccione uma op&ccedil;&atilde;o:' , 
            'AEM' => 'Acabamentos Embalagem' , 
            'AMKT' => 'Acabamentos Marketing' , 
            'PP' => 'PrePress' , 
            'IMP' => 'Impress&atilde;o' , 
            'FORN' => 'Fornecedor' , 
            'EXP' => 'Expedi&ccedil;&atilde;o' , 
            'ARM' => 'Armaz&eacute;m' , 
            'PROD' => 'Produ&ccedil;&atilde;o' , 
            'QAS' => 'Qualidade, Ambiente e Seguran&ccedil;a' , 
            'CQ' => 'Controle de Qualidade' , 
            'DTEC' => 'Departamento T&eacute;cnico' , 
            'CdR FSC' => 'CdR FSC' , 
            'CdR PEFC' => 'CdR PEFC' , 
            'OUT' => 'Outros'));
        /**
         * ACCOES
         */
        $def_ac_prev_corr = new Zend_Form_Element_Textarea('def_ac_prev_corr');
        $def_ac_prev_corr->setLabel('Definic&ccedil;&atilde;o Ac&ccedil;&otilde;es Correctivas: ');
        $def_ac_prev_corr->setAttribs(array(
            'rows' => 10 , 
            'cols' => 50));
        $data_ac_prev_corr = new Zend_Form_Element_Text('data_ac_prev_corr');
        $data_ac_prev_corr->setLabel('Data Ac&ccedil;&otilde;es Correctivas:');
        $data_ac_prev_corr->addValidators(array(
            new Zend_Validate_Date()));
        $data_ac_prev_corr->setErrorMessages(array(
            self::ERR_DATA));
        $data_ac_prev_corr->setAttribs(array(
            'size' => 15));
        /**
         */
        $resp_ac_prev_corr = new Zend_Form_Element_Text('resp_ac_prev_corr');
        $resp_ac_prev_corr->setLabel('Respons&aacute;vel:');
        $resp_ac_prev_corr->setAttribs(array(
            'size' => 50));
        /**
         */
        $custo_ac_prev_corr = new Zend_Form_Element_Text('custo_ac_prev_corr');
        $custo_ac_prev_corr->setLabel('Custo: ');
        $custo_ac_prev_corr->addValidators(array(
            new Zend_Validate_Float("en-US")));
        $custo_ac_prev_corr->setErrorMessages(array(
            self::ERR_FLOAT));
        /**
         */
        $prazo_ac_prev_corr = new Zend_Form_Element_Text('prazo_ac_prev_corr');
        $prazo_ac_prev_corr->setLabel('Prazo:');
        $prazo_ac_prev_corr->addValidators(array(
            new Zend_Validate_Date()));
        $prazo_ac_prev_corr->setErrorMessages(array(
            self::ERR_DATA));
        $prazo_ac_prev_corr->setAttribs(array(
            'size' => 15));
        /**
         */
        $fechado_ac_prev_corr = new Zend_Form_Element_Checkbox('fechado_ac_prev_corr');
        $fechado_ac_prev_corr->setLabel('Ac&ccedil;&atilde;o pode ser fechada:');
        /**
         */
        /**
         */
        /**
         */
        $def_ac_preventivas = new Zend_Form_Element_Textarea('def_ac_preventivas');
        $def_ac_preventivas->setLabel('Definic&ccedil;&atilde;o Ac&ccedil;&otilde;es Preventivas: ');
        $def_ac_preventivas->setAttribs(array(
            'rows' => 10 , 
            'cols' => 50 , 
            ));
        $data_ac_preventivas = new Zend_Form_Element_Text('data_ac_preventivas');
        $data_ac_preventivas->setLabel('Data Ac&ccedil;&otilde;es Preventivas:');
        $data_ac_preventivas->addValidators(array(
            new Zend_Validate_Date()));
        $data_ac_preventivas->setErrorMessages(array(
            self::ERR_DATA));
        $data_ac_preventivas->setAttribs(array(
            'size' => 15 , 
            ));
        /**
         */
        $resp_ac_preventivas = new Zend_Form_Element_Text('resp_ac_preventivas');
        $resp_ac_preventivas->setLabel('Respons&aacute;vel:');
        $resp_ac_preventivas->setAttribs(array(
            'size' => 50 , 
            ));
        /**
         */
        $custo_ac_preventivas = new Zend_Form_Element_Text('custo_ac_preventivas');
        $custo_ac_preventivas->setLabel('Custo: ');
        $custo_ac_preventivas->addValidators(array(
            new Zend_Validate_Float("en-US")));
        $custo_ac_preventivas->setErrorMessages(array(
            self::ERR_FLOAT));
        
        /**
         */
        $prazo_ac_preventivas = new Zend_Form_Element_Text('prazo_ac_preventivas');
        $prazo_ac_preventivas->setLabel('Prazo:');
        $prazo_ac_preventivas->addValidators(array(
            new Zend_Validate_Date()));
        $prazo_ac_preventivas->setErrorMessages(array(
            self::ERR_DATA));
        $prazo_ac_preventivas->setAttribs(array(
            'size' => 15 , 
            ));
        /**
         */
        $fechado_ac_preventivas = new Zend_Form_Element_Checkbox('fechado_ac_preventivas');
        $fechado_ac_preventivas->setLabel('Ac&ccedil;&atilde;o pode ser fechada:');
        /**
         */
        /**
         */
        /**
         */
        $def_ac_melhoria = new Zend_Form_Element_Textarea('def_ac_melhoria');
        $def_ac_melhoria->setLabel('Definic&ccedil;&atilde;o Ac&ccedil;&otilde;es Melhoria: ');
        $def_ac_melhoria->setAttribs(array(
            'rows' => 10 , 
            'cols' => 50));
        $data_ac_melhoria = new Zend_Form_Element_Text('data_ac_melhoria');
        $data_ac_melhoria->setLabel('Data Ac&ccedil;&otilde;es Melhoria:');
        $data_ac_melhoria->addValidators(array(
            new Zend_Validate_Date()));
        $data_ac_melhoria->setErrorMessages(array(
            self::ERR_DATA));
        $data_ac_melhoria->setAttribs(array(
            'size' => 15));
        /**
         */
        $resp_ac_melhoria = new Zend_Form_Element_Text('resp_ac_melhoria');
        $resp_ac_melhoria->setLabel('Respons&aacute;vel:');
        $resp_ac_melhoria->setAttribs(array(
            'size' => 50));
        /**
         */
        $custo_ac_melhoria = new Zend_Form_Element_Text('custo_ac_melhoria');
        $custo_ac_melhoria->setLabel('Custo: ');
        $custo_ac_melhoria->addValidators(array(
            new Zend_Validate_Float("en-US")));
        $custo_ac_melhoria->setErrorMessages(array(
            self::ERR_FLOAT));
        /**
         */
        $prazo_ac_melhoria = new Zend_Form_Element_Text('prazo_ac_melhoria');
        $prazo_ac_melhoria->setLabel('Prazo:');
        $prazo_ac_melhoria->addValidators(array(
            new Zend_Validate_Date()));
        $prazo_ac_melhoria->setErrorMessages(array(
            self::ERR_DATA));
        $prazo_ac_melhoria->setAttribs(array(
            'size' => 15 , 
            'id' => 'prazo_ac_melhoria'));
        /**
         */
        $fechado_ac_melhoria = new Zend_Form_Element_Checkbox('fechado_ac_melhoria');
        $fechado_ac_melhoria->setLabel('Ac&ccedil;&atilde;o pode ser fechada:');
        /**
         */
        /**
         *
         * @var $impacto_ambiental Zend_Form_Element_Text
         */
        $impacto_ambiental = new Zend_Form_Element_Text('impacto_ambiental');
        $impacto_ambiental->setLabel('Impacto Ambiental: ');
        $impacto_ambiental->setAttribs(array(
            'size' => 50));
        /**
         *
         * @var unknown_type
         */
        $perigos = new Zend_Form_Element_Text('perigos');
        $perigos->setLabel('Perigos e Riscos: ');
        $perigos->setAttribs(array(
            'size' => 50));
        /**
         * FIM AN�LISE
         */
        /**
         * FECHO
         */
        $evento_fechado = new Zend_Form_Element_Checkbox('evento_fechado');
        $evento_fechado->setLabel('Evento Pode ser Fechado:');
        /**
         *
         * @var unknown_type
         */
        $info_adicional = new Zend_Form_Element_Textarea('info_adicional');
        $info_adicional->setLabel('Informa&ccedil;&atilde;o Adicional: ');
        $info_adicional->setAttribs(array(
            'rows' => 10 , 
            'cols' => 50));
        /**
         */
        $eficaz = new Zend_Form_Element_Radio('eficaz', array(
            'multiOptions' => array(
                "1" => 'N&atilde;o Aplic&aacute;vel' , 
                "2" => 'N&atilde;o' , 
                "3" => 'Sim')));
        $eficaz->setLabel('Eficaz:');
        $eficaz->setValue(array(
            0));
        $eficaz->setSeparator('');
        $abertura_obra = new Zend_Form_Element_Radio('abertura_obra');
        $abertura_obra->setLabel('Abertura Novo Boletim de Obra:');
        $abertura_obra->addMultiOptions(array(
            1 => 'Sim' , 
            0 => 'N&atilde;o'));
        $abertura_obra->setSeparator('');
        $abertura_obra->setDecorators($this->radioDecorators);
        /**
         */
        $custo_total = new Zend_Form_Element_Text('custo_total');
        $custo_total->setLabel('Custo Total: ');
        $custo_total->addValidators(array(
            new Zend_Validate_Float("en-US")));
        $custo_total->setErrorMessages(array(
            self::ERR_FLOAT));
        /**
         */
        $respcliente = new Zend_Form_Element_Text('respcliente');
        $respcliente->setLabel('Data resposta ao cliente:');
        $respcliente->addValidators(array(
            new Zend_Validate_Date()));
        $respcliente->setErrorMessages(array(
            self::ERR_DATA));
        $respcliente->setAttribs(array(
            'size' => 15));
        $data_fecho = new Zend_Form_Element_Text('data_fecho');
        $data_fecho->setLabel('Data fecho:');
        $data_fecho->addValidators(array(
            new Zend_Validate_Date()));
        $data_fecho->setErrorMessages(array(
            self::ERR_DATA));
        $data_fecho->setAttribs(array(
            'size' => 15));
        /**
         */
        $resp_fecho = new Zend_Form_Element_Text('resp_fecho');
        $resp_fecho->setLabel('Respons&aacute;vel:');
        /**
         */
        $resultado = new Zend_Form_Element_Text('resultado');
        $resultado->setLabel('Resultado:');
        /**
         * FIM FECHO
         */
        $this->addElements(array(
            $abertura_obra , 
            $id , 
            $anulada , 
            $tipo_registo , 
            $origem , 
            $sistema , 
            $doc_referencia , 
            $obra ,
            $fsc , 
            $entidade , 
            $trabalho , 
            $jobtype , 
            $lote , 
            $qtd_recebida , 
            $qtd_reclamada , 
            $qtd_falta , 
            $ordem_compra , 
            $amostra_disponivel , 
            $situacao_corrente , 
            $data_detectada , 
            $descricao_problema , 
            $notificacao , 
            $rejeicao , 
            $nao_aceite , 
            $anomalia , 
            $detectado , 
            $cod_def , 
            $investigacao_efectuada , 
            $data_investigacao , 
            $preenchido_investigacao , 
            $correcoes , 
            $data_correccoes , 
            $custo_correccoes , 
            $resp_correccoes , 
            $id_causas , 
            $data_causas , 
            $responsavel_causas , 
            $seccao_causas , 
            $def_ac_prev_corr , 
            $data_ac_prev_corr , 
            $resp_ac_prev_corr , 
            $custo_ac_prev_corr , 
            $prazo_ac_prev_corr , 
            $fechado_ac_prev_corr , 
            $def_ac_preventivas , 
            $data_ac_preventivas , 
            $resp_ac_preventivas , 
            $custo_ac_preventivas , 
            $prazo_ac_preventivas , 
            $fechado_ac_preventivas , 
            $def_ac_melhoria , 
            $data_ac_melhoria , 
            $resp_ac_melhoria , 
            $custo_ac_melhoria , 
            $prazo_ac_melhoria , 
            $fechado_ac_melhoria , 
            $impacto_ambiental , 
            $perigos , 
            $info_adicional , 
            $resultado , 
            $eficaz , 
            $evento_fechado , 
            $custo_total , 
            $resp_fecho , 
            $respcliente , 
            $data_fecho , 
            $registo , 
            $reavaliacao , 
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
        $this->addDisplayGroup(array(
            'anulada' , 
            'tipo_registo' , 
            'origem' , 
            'sistema' , 
            'doc_referencia' , 
            'obra' ,
            'matcert' , 
            'entidade' , 
            'trabalho' , 
            'jobtype' , 
            'lote' , 
            'qtd_recebida' , 
            'qtd_reclamada' , 
            'qtd_falta' , 
            'ordem_compra' , 
            'amostra_disponivel' , 
            'situacao_recorrente' , 
            'data_detectada' , 
            'descricao_problema' , 
            'detectado' , 
            'cod_def' , 
            'submit' , 
            'id'), 'identificacao');
        $this->addDisplayGroup(array(
            'notificacao' , 
            'rejeicao' , 
            'nao_aceite' , 
            'registo' , 
            'reavaliacao'), 'analise_notificaoes');
        $this->addDisplayGroup(array(
            'investigacao_efectuada' , 
            'data_investigacao' , 
            'preenchido_investigacao'), 'analise_investigacao');
        $this->addDisplayGroup(array(
            'abertura_obra' , 
            'correcoes' , 
            'data_correccoes' , 
            'custo_correccoes' , 
            'resp_correccoes' , 
            'submit'), 'analise_correccoes');
        $this->addDisplayGroup(array(
            'id_causas' , 
            'data_causas' , 
            'responsavel_causas' , 
            'custo_causas' , 
            'seccao_causas'), 'analise_causas');
        $this->addDisplayGroup(array(
            'impacto_ambiental' , 
            'perigos' , 
            'submit'), 'analise_fim');
        $this->addDisplayGroup(array(
            'def_ac_melhoria' , 
            'data_ac_melhoria' , 
            'resp_ac_melhoria' , 
            'custo_ac_melhoria' , 
            'prazo_ac_melhoria' , 
            'fechado_ac_melhoria' , 
            'submit'), 'accoes_melhoria');
        $this->addDisplayGroup(array(
            'def_ac_prev_corr' , 
            'data_ac_prev_corr' , 
            'resp_ac_prev_corr' , 
            'custo_ac_prev_corr' , 
            'prazo_ac_prev_corr' , 
            'fechado_ac_prev_corr' , 
            'submit'), 'accoes_correctivas');
        $this->addDisplayGroup(array(
            'def_ac_preventivas' , 
            'data_ac_preventivas' , 
            'resp_ac_preventivas' , 
            'custo_ac_preventivas' , 
            'prazo_ac_preventivas' , 
            'fechado_ac_preventivas' , 
            'submit'), 'accoes_preventivas');
        $this->addDisplayGroup(array(
            'info_adicional' , 
            'resultado' , 
            'eficaz' , 
            'evento_fechado' , 
            'custo_total' , 
            'resp_fecho' , 
            'respcliente' , 
            'data_fecho' , 
            'submit'), 'fecho');
        $this->setDisplayGroupDecorators(array(
            'FormElements' , 
            array(
                'HtmlTag' , 
                array(
                    'tag' => 'table'))));
    }
}