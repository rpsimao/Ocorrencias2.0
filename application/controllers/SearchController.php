<?php

class SearchController extends Zend_Controller_Action
{

    private $registos;

    public function init()
    {
        $this->registos = new Application_Model_Registos();
    }

    public function indexAction()
    {
        // action body
    }

    public function customersAction()
    {
        
        $cliente = $this->_request->getPost('customer-modal-search');
        $ano     = $this->_request->getPost('customer-modal-ano');
        $mes     = $this->_request->getPost('customer-modal-mes');
        $oc      = $this->_request->getPost('customer-modal-oc');
        $origem  = $this->_request->getPost('customer-modal-origem');
        
        
        
        if ($this->getRequest()->isPost()) {
            
            $sess = new Zend_Session_Namespace('customer-modal-search-session');
            
           if ($cliente !="" && $oc == "" && $ano == "" && $mes == "") {

                $sql = $this->registos->searchModalCliente(1, $cliente, null, null ,$oc, $origem);
                $sess->sql = $sql;
                $sess->cliente = $cliente;
                $sess->number = count($sql);
                $this->view->titulo = " Cliente - " . $cliente;
                $page = $this->_getParam('page', 1);
                $paginator = Zend_Paginator::factory($sql);
                $paginator->setItemCountPerPage(15);
                $paginator->setCurrentPageNumber($page);
                $this->view->paginator = $paginator;
                $this->view->number = count($sql);
            }
            
            
            if ($cliente !="" && $oc != "" && $ano == "" && $mes == "") {
            
                $sql = $this->registos->searchModalCliente(2, $cliente, null, null ,$oc, $origem);
                $sess->sql = $sql;
                $sess->cliente = $cliente;
                $sess->number = count($sql);
                $this->view->titulo = " Cliente - " . $cliente;
                $page = $this->_getParam('page', 1);
                $paginator = Zend_Paginator::factory($sql);
                $paginator->setItemCountPerPage(15);
                $paginator->setCurrentPageNumber($page);
                $this->view->paginator = $paginator;
                $this->view->number = count($sql);
            }
            
            if ($cliente !="" && $oc == "" && $ano != "" && $mes != "") {
            
                $sql = $this->registos->searchModalCliente(3, $cliente, $mes, $ano, null, $origem);
                $sess->sql = $sql;
                $sess->cliente = $cliente;
                $sess->number = count($sql);
                $this->view->titulo = " Cliente - " . $cliente;
                $page = $this->_getParam('page', 1);
                $paginator = Zend_Paginator::factory($sql);
                $paginator->setItemCountPerPage(15);
                $paginator->setCurrentPageNumber($page);
                $this->view->paginator = $paginator;
                $this->view->number = count($sql);
            }
            
            if ($cliente !="" && $oc == "" && $ano != "" && $mes == "") {
            
                $sql = $this->registos->searchModalCliente(4, $cliente, null, $ano, null, $origem);
                $sess->sql = $sql;
                $sess->cliente = $cliente;
                $sess->number = count($sql);
                $this->view->titulo = " Cliente - " . $cliente;
                $page = $this->_getParam('page', 1);
                $paginator = Zend_Paginator::factory($sql);
                $paginator->setItemCountPerPage(15);
                $paginator->setCurrentPageNumber($page);
                $this->view->paginator = $paginator;
                $this->view->number = count($sql);
            }
        
         } else {
             
             $sess = new Zend_Session_Namespace('customer-modal-search-session');
             
             $this->view->titulo = " Cliente - " . $sess->cliente;
             $page = $this->_getParam('page', 1);
             $paginator = Zend_Paginator::factory($sess->sql);
             $paginator->setItemCountPerPage(15);
             $paginator->setCurrentPageNumber($page);
             $this->view->paginator = $paginator;
             $this->view->number = $sess->number;
             
         }
        
        
    }

    public function jobAction()
    {
            $obra = $this->_request->getPost('job-modal-search');
            $this->view->obra = $obra;
            $this->view->titulo = " Obra Nº" . $obra;
            $sql  = $this->registos->getAllRecordsByObra($obra);
            $page = $this->_getParam('page', 1);
            $paginator = Zend_Paginator::factory($sql);
            $paginator->setItemCountPerPage(15);
            $paginator->setCurrentPageNumber($page);
            $this->view->paginator = $paginator;
            $this->view->number = count($sql);
    }

    public function dateAction()
    {
        $this->_helper->viewRenderer->setRender('job');
        
        if ($this->getRequest()->isPost()) {
        
            $sess  = new Zend_Session_Namespace('customer-modal-search-session');
            $date1 = $this->_request->getPost('dates-modal-search1');
            $date2 =  $this->_request->getPost('dates-modal-search2');
            
            $sql = $this->registos->getAllRecordsByDateRange($date1, $date2);
            $sess->sql   = $sql;
            $sess->date1 = $date1;
            $sess->date2 = $date2;
            $sess->number = count($sql);
            $page = $this->_getParam('page', 1);
            $paginator = Zend_Paginator::factory($sql);
            $paginator->setItemCountPerPage(15);
            $paginator->setCurrentPageNumber($page);
            $this->view->paginator = $paginator;
            $this->view->date1  = $sess->date1;
            $this->view->date2  = $sess->date2;
            $this->view->number = $sess->number;
            $this->view->titulo = " entre - " . $sess->date1 . " e " . $sess->date2;
        
        } else {
            
            $sess = new Zend_Session_Namespace('customer-modal-search-session');
             
            $this->view->titulo = " entre " . $sess->date1 . " e " . $sess->date2;
            $page = $this->_getParam('page', 1);
            $paginator = Zend_Paginator::factory($sess->sql);
            $paginator->setItemCountPerPage(15);
            $paginator->setCurrentPageNumber($page);
            $this->view->paginator = $paginator;
            $this->view->number = $sess->number;
            $this->view->date1  = $sess->date1;
            $this->view->date2  = $sess->date2;
            $this->view->number = $sess->number;
            
        }
        
    }

    public function fscpefcAction()
    {
       
       
       $this->view->titulo = " com Matéria Certificada FSC/PEFC";
        
       $sql  = $this->registos->getCertJobs();
       $page = $this->_getParam('page', 1);
       $paginator = Zend_Paginator::factory($sql);
       $paginator->setItemCountPerPage(15);
       $paginator->setCurrentPageNumber($page);
       $this->view->paginator = $paginator;
       $this->view->number = count($sql);
    }

    public function openAction()
    {
            $this->view->titulo = " Abertas [" . count($this->registos->getAllOcorrenciasNotClosed()) ."]";
        
            $sql  = $this->registos->getAllOcorrenciasNotClosed();
            $page = $this->_getParam('page', 1);
            $paginator = Zend_Paginator::factory($sql);
            $paginator->setItemCountPerPage(15);
            $paginator->setCurrentPageNumber($page);
            $this->view->paginator = $paginator;
            $this->view->number = count($sql);
    }

    public function idAction()
    {
        
        $id = $this->_request->getPost('numero-modal-search');
            
        $this->view->id = $id;
        $sql = $this->registos->findById($id);
        
        $this->view->boletim = $sql;
        $this->view->number = count($sql);
        
        
            
    }

    public function searchgroupAction()
    {
        $group   = $this->_getParam('group');
        $name    = $this->_getParam('name');
        $sistema = $this->_getParam('sistema');
        $origem  = $this->_getParam('origem');
        $type    = $this->_getParam('type');
        
        
        $sql  = $this->registos->getAllOcorrenciasNotClosedGroupBy($group, $name, $sistema, $origem, $type);
        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($sql);
        $paginator->setItemCountPerPage(15);
        $paginator->setCurrentPageNumber($page);
        $this->view->paginator = $paginator;
        $this->view->number = count($sql);
        
    }


}