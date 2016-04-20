<?php

class NewController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
    }

    public function createAction()
    {
        if ($this->getRequest()->isPost()) {
            
            $db = new Application_Model_Registos();
            
            $data = array(
                    'tipo_registo'        => $this->_request->getPost('tipo_registo'),
                    'origem'              => $this->_request->getPost('origem'),
                    'sistema'             => $this->_request->getPost('sistema'),
                    'obra'                => $this->_request->getPost('obra'),
                    'entidade'            => $this->_request->getPost('entidade'),
                    'trabalho'            => $this->_request->getPost('trabalho'),
                    'jobtype'             => $this->_request->getPost('jobtype'),
                    'matcert'             => $this->_request->getPost('matcert'),
                    'doc_referencia'      => $this->_request->getPost('doc_referencia'),
                    'lote'                => $this->_request->getPost('lote'),
                    'qtd_recebida'        => $this->_request->getPost('qtd_recebida'),
                    'qtd_reclamada'       => $this->_request->getPost('qtd_reclamada'),
                    'qtd_falta'           => $this->_request->getPost('qtd_falta'),
                    'ordem_compra'        => $this->_request->getPost('ordem_compra'),
                    'amostra_disponivel'  => $this->_request->getPost('amostra_disponivel'),
                    'situacao_recorrente' => $this->_request->getPost('situacao_recorrente'),
                    'descricao_problema'  => $this->_request->getPost('descricao_problema'),
                    'data_detectada'      => $this->_request->getPost('data_detectada'),
                    'detectado'           => $this->_request->getPost('detectado'),
                   );
            
            $id = $db->insertData($data);
                     
            $today  = Zend_Date::now()->toString("YYYY-MM-dd");
            
            $records = $db->getRecordsByDate("2013-06-04");
            
            $this->view->records = $records;
            $this->view->today   = $today;
            $this->view->id      = $id;
            
           
        }
    }


}



