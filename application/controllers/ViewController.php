<?php

class ViewController extends Zend_Controller_Action
{

    public function init()
    {
       $this->view->setEscape('stripslashes');
    }

    public function indexAction()
    {
        $id = $this->_getParam('id');
        
        $db = new Application_Model_Registos();
        $values = $db->findById($id);
        
        $form = new Application_Form_OcorrenciaCompleta();
        
        
        $formPopulate = $form->populate(array(
                'id'                      => $values['id'] ,
                'anulada'                 => $values['anulada'] ,
                'tipo_registo'            => $values['tipo_registo'] ,
                'origem'                  => $values['origem'] ,
                'sistema'                 => $values['sistema'] ,
                'obra'                    => $values['obra'] ,
                'matcert'                 => $values['matcert'] ,
                'entidade'                => $values['entidade'] ,
                'trabalho'                => $values['trabalho'] ,
                'lote'                    => $values['lote'] ,
                'qtd_recebida'            => RPS_Helpers_Clean::Zero($values['qtd_recebida']) ,
                'qtd_reclamada'           => RPS_Helpers_Clean::Zero($values['qtd_reclamada']) ,
                'ordem_compra'            => $values['ordem_compra'] ,
                'amostra_disponivel'      => $values['amostra_disponivel'] ,
                'situacao_recorrente'     => $values['situacao_recorrente'] ,
                'descricao_problema'      => $values['descricao_problema'] ,
                'notificacao'             => $values['notificacao'] ,
                'rejeicao'                => $values['rejeicao'] ,
                'nao_aceite'              => $values['nao_aceite'] ,
                'registo'                 => $values['registo'] ,
                'reavaliacao'             => $values['reavaliacao'] ,
                'investigacao_efectuada'  => $values['investigacao_efectuada'] ,
                'data_investigacao'       => RPS_Helpers_Clean::date($values['data_investigacao']) ,
                'preenchido_investigacao' => $values['preenchido_investigacao'] ,
                'correcoes'               => $values['correcoes'] ,
                'data_correccoes'         => RPS_Helpers_Clean::date($values['data_correccoes']) ,
                'custo_correccoes'        => RPS_Helpers_Clean::Zero($values['custo_correccoes']) ,
                'id_causas'               => $values['id_causas'] ,
                'data_causas'             => RPS_Helpers_Clean::date($values['data_causas']) ,
                'responsavel_causas'      => $values['responsavel_causas'] ,
                'seccao_causas'           => $values['seccao_causas'] ,
                'def_ac_prev_corr'        => $values['def_ac_prev_corr'] ,
                'data_ac_prev_corr'       => RPS_Helpers_Clean::date($values['data_ac_prev_corr']) ,
                'resp_ac_prev_corr'       => $values['resp_ac_prev_corr'] ,
                'custo_ac_prev_corr'      => RPS_Helpers_Clean::Zero($values['custo_ac_prev_corr']) ,
                'def_ac_preventivas'      => $values['def_ac_preventivas'] ,
                'data_ac_preventivas'     => RPS_Helpers_Clean::date($values['data_ac_preventivas']) ,
                'resp_ac_preventivas'     => $values['resp_ac_preventivas'] ,
                'custo_ac_preventivas'    => RPS_Helpers_Clean::Zero($values['custo_ac_preventivas']) ,
                'def_ac_melhoria'         => $values['def_ac_melhoria'] ,
                'data_ac_melhoria'        => RPS_Helpers_Clean::date($values['data_ac_melhoria']) ,
                'resp_ac_melhoria'        => $values['resp_ac_melhoria'] ,
                'custo_ac_melhoria'       => RPS_Helpers_Clean::Zero($values['custo_ac_melhoria']) ,
                'evento_fechado'          => $values['evento_fechado'] ,
                'info_adicional'          => $values['info_adicional'] ,
                'eficaz'                  => $values['eficaz'] ,
                'custo_total'             => RPS_Helpers_Clean::Zero($values['custo_total']) ,
                'data_fecho' => RPS_Helpers_Clean::date($values['data_fecho']) ,
                'resp_fecho' => $values['resp_fecho'] ,
                'doc_referencia' => $values['doc_referencia'] ,
                'data_detectada' => RPS_Helpers_Clean::date($values['data_detectada']) ,
                'detectado' => $values['detectado'] ,
                'resp_correccoes' => $values['resp_correccoes'] ,
                'resultado' => $values['resultado'] ,
                'perigos' => $values['perigos'] ,
                'impacto_ambiental' => $values['impacto_ambiental'] ,
                'cod_def' => $values['cod_def'] ,
                'prazo_ac_prev_corr' => RPS_Helpers_Clean::date($values['prazo_ac_prev_corr']) ,
                'fechado_ac_prev_corr' => $values['fechado_ac_prev_corr'] ,
                'prazo_ac_preventivas' => RPS_Helpers_Clean::date($values['prazo_ac_preventivas']) ,
                'fechado_ac_preventivas' => $values['fechado_ac_preventivas'] ,
                'prazo_ac_melhoria' => RPS_Helpers_Clean::date($values['prazo_ac_melhoria']) ,
                'respcliente' => RPS_Helpers_Clean::date($values['respcliente']) ,
                'fechado_ac_melhoria' => $values['fechado_ac_melhoria'] ,
                'abertura_obra' => $values['abertura_obra']));
        $this->view->form = $formPopulate;
        $this->view->id = $id;
        
    }


}

