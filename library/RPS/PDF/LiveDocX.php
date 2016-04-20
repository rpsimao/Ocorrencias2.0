<?php

/** 
 * @author rpsimao
 * 
 */
class RPS_PDF_LiveDocX
{
    // TODO - Insert your code here
    
    /**
     */
    
    private $tipo;
    private $user;
    private $template;
    
    function __construct ($tipo, $user)
    {
        
        $this->tipo = $tipo;
        $this->user = $user;
        
        $this->template = $this->_defineTemplate();
    }
    
    
    public function createPDF(array $values)
    {
        
        
        $phpLiveDocx = new Zend_Service_LiveDocx_MailMerge(array(
                'username' => 'fterceiro' ,
                'password' => 'f32611k12'));
        
        $phpLiveDocx->assign('id', $values['id']);
        $phpLiveDocx->assign('origem', $this->origem($values['origem']));
        $phpLiveDocx->assign('sistema', $values['sistema']);
        $phpLiveDocx->assign('obra', RPS_Helpers_Clean::Obra($values['obra']));
        $phpLiveDocx->assign('trabalho', $values['trabalho']);
        $phpLiveDocx->assign('entidade', $values['entidade']);
        $phpLiveDocx->assign('qtd_recebida', $this->qtd($values['qtd_recebida']));
        $phpLiveDocx->assign('qtd_reclamada', $this->qtd($values['qtd_reclamada']));
        $phpLiveDocx->assign('qtd_falta', $this->qtd($values['qtd_falta']));
        $phpLiveDocx->assign('ordem_compra', $values['ordem_compra']);
        $phpLiveDocx->assign('amostra_disponivel', $this->translate1($values['amostra_disponivel']));
        $phpLiveDocx->assign('situacao_recorrente', $this->translate1($values['situacao_recorrente']));
        $phpLiveDocx->assign('descricao_problema', $values['descricao_problema']);
        $phpLiveDocx->assign('notificacao', $this->translate1($values['notificacao']));
        $phpLiveDocx->assign('rejeicao', $this->translate1($values['rejeicao']));
        $phpLiveDocx->assign('nao_aceite', $this->translate1($values['nao_aceite']));
        $phpLiveDocx->assign('reavaliacao', $this->translate1($values['reavaliacao']));
        $phpLiveDocx->assign('data_investigacao', $this->cleandata($values['data_investigacao']));
        $phpLiveDocx->assign('preenchido_investigacao', $values['preenchido_investigacao']);
        $phpLiveDocx->assign('correccoes', $values['correcoes']);
        $phpLiveDocx->assign('investigacao_efectuada', $values['investigacao_efectuada']);
        $phpLiveDocx->assign('id_causas', $this->cleandata($values['id_causas']));
        $phpLiveDocx->assign('data_correccoes', $this->cleandata($values['data_correccoes']));
        $phpLiveDocx->assign('custos_correccoes', $this->custo($values['custo_correccoes']));
        $phpLiveDocx->assign('data_causas', $this->cleandata($values['data_causas']));
        $phpLiveDocx->assign('responsavel_causas', $values['responsavel_causas']);
        $phpLiveDocx->assign('seccao_causas', $values['seccao_causas']);
        $phpLiveDocx->assign('def_ac_prev_corr', $values['def_ac_prev_corr']);
        $phpLiveDocx->assign('data_ac_prev_corr', $this->cleandata($values['data_ac_prev_corr']));
        $phpLiveDocx->assign('resp_ac_prev_corr', $values['resp_ac_prev_corr']);
        $phpLiveDocx->assign('custo_ac_prev_corr', $this->custo($values['custo_ac_prev_corr']));
        $phpLiveDocx->assign('def_ac_preventivas', $values['def_ac_preventivas']);
        $phpLiveDocx->assign('data_ac_preventivas', $this->cleandata($values['data_ac_preventivas']));
        $phpLiveDocx->assign('resp_ac_preventivas', $values['resp_ac_preventivas']);
        $phpLiveDocx->assign('custo_ac_preventivas', $this->custo($values['custo_ac_preventivas']));
        $phpLiveDocx->assign('def_ac_melhoria', $values['def_ac_melhoria']);
        $phpLiveDocx->assign('data_ac_melhoria', $this->cleandata($values['data_ac_melhoria']));
        $phpLiveDocx->assign('resp_ac_melhoria', $values['resp_ac_melhoria']);
        $phpLiveDocx->assign('custo_ac_melhoria', $this->custo($values['custo_ac_melhoria']));
        $phpLiveDocx->assign('evento_fechado', $this->translate1($values['evento_fechado']));
        $phpLiveDocx->assign('custo_total', $this->custo($values['custo_total']));
        $phpLiveDocx->assign('eficaz', $this->eficaz($values['eficaz']));
        $phpLiveDocx->assign('info_adicional', $values['info_adicional']);
        $phpLiveDocx->assign('resp_fecho', $values['resp_fecho']);
        $phpLiveDocx->assign('data_fecho', $this->cleandata($values['data_fecho']));
        $phpLiveDocx->assign('doc_referencia', $values['doc_referencia']);
        $phpLiveDocx->assign('data_detectada', $this->cleandata($values['data_detectada']));
        $phpLiveDocx->assign('detectado', $values['detectado']);
        $phpLiveDocx->assign('resp_correccoes', $values['resp_correccoes']);
        $phpLiveDocx->assign('resultado', $values['resultado']);
        $phpLiveDocx->assign('perigos', $values['perigos']);
        $phpLiveDocx->assign('cod_def', $values['cod_def']);
        $phpLiveDocx->assign('impacto_ambiental', $values['impacto_ambiental']);
        $phpLiveDocx->assign('tipo_registo', $this->sistema($values['tipo_registo']));
        $phpLiveDocx->assign('registo', $this->translate1($values['registo']));
        $phpLiveDocx->assign('prazo_ac_prev_corr', $this->cleandata($values['prazo_ac_prev_corr']));
        $phpLiveDocx->assign('fechado_ac_prev_corr', $this->evento($values['fechado_ac_prev_corr']));
        $phpLiveDocx->assign('prazo_ac_preveventivas', $this->cleandata($values['prazo_ac_preventivas']));
        $phpLiveDocx->assign('fechado_ac_preventivas', $this->evento($values['fechado_ac_preventivas']));
        $phpLiveDocx->assign('prazo_ac_melhoria', $this->cleandata($values['prazo_ac_melhoria']));
        $phpLiveDocx->assign('fechado_ac_melhoria', $this->evento($values['fechado_ac_melhoria']));
        $phpLiveDocx->assign('data_impressao', date('d-m-Y G:i'));
        //$phpLiveDocx->setLocalTemplate('docs/registo2.docx');
        //$phpLiveDocx->setRemoteTemplate('registo2.docx');
        
        $phpLiveDocx->setRemoteTemplate($this->template);
        $phpLiveDocx->createDocument();
        
        
        return  $phpLiveDocx->retrieveDocument('pdf');
        
     }
     
     
     
     private function _defineTemplate()
     {
         
         
         if ($this->tipo == "interno" && $this->user == null)
         {
             $template = "registo2.docx";
         }
         
         if ($this->tipo == "externo" && $this->user == "carina")
         {
             $template = "registo2_ext_Carina.docx";
         }
         
         /**if ($this->tipo == "externo" && $this->user == "ana")
         {
             $template = "registo2_ext_ana.docx";
         }*/

         if ($this->tipo == "externo" && $this->user == "marta")
         {
             $template = "registo2_ext_Marta.docx";
         }
         
         if ($this->tipo == "externo" && $this->user == "ines")
         {
             $template = "registo2_ext_Ines.docx";
         }
         
         if ($this->tipo == "externo" && $this->user == "margarida")
         {
             $template = "registo2_ext_Margarida.docx";
         }
         
        return $template;       
                         
     }
     
    
     private function cleandata ($value)
     {
     
         $clean = ($value == "0000-00-00") ? '' : $value;
         return $clean;
     }
     
     private function translate1 ($value)
     {
     
         $clean = ($value == 0) ? '' : 'Sim';
         return $clean;
     }
     
     private function evento ($value)
     {
     
         $clean = ($value == 0) ? '' : 'Sim';
         return $clean;
     }
     
     private function custo ($value)
     {
     
         $clean = ($value > 0) ? round($value, 2) . ' €' : '';
         return $clean;
     }
     
     private function qtd ($value)
     {
     
         $clean = ($value > 0) ? $value : '';
         return $clean;
     }
     
     private function eficaz ($value)
     {
     
         switch ($value) {
             case 1:
                 return "Não aplicável";
                 break;
             case 2:
                 return "Não";
                 break;
             case 3:
                 return "Sim";
                 break;
             default:
                 return "";
                 break;
         }
     }
     
     private function origem ($value)
     {
     
         $clean = ($value == 'Reclamacao') ? 'Reclamação' : $value;
         return $clean;
     }
     
     private function sistema ($value)
     {
     
         switch ($value) {
             case 'Seguranca':
                 return 'Segurança';
                 break;
             case 'Ambiente e Seguranca':
                 return 'Ambiente e Segurança';
                 break;
             case 'ocorrencia':
                 return 'Ocorrência';
                 break;
             case 'nao_conformidade':
                 return 'Não Conformidade';
                 break;
             case 'reclamacao':
                 return 'Reclamação';
                 break;
             case 'oportunidade_melhoria':
                 return 'Oportunidade de Melhoria';
                 break;
         }
     }
     
}

?>