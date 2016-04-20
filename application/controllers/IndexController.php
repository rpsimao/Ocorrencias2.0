<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $frontendOptions = array('lifetime' => 7200 ,'automatic_serialization' => true);
        
        $backendOptions = array('cache_dir' => '/tmp/');
        $this->cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
        
        
        if( ($customers = $this->cache->load('getallclients')) === false ) {
        
            $this->cu = new Application_Model_Optimus();
            $customers = $this->cu->getAllCustomers();
            $this->cache->save($customers, 'getallclients');
        
            $this->view->customers = $this->cache->load('getallclients');
        
        } else {
        
            $this->view->customers = $this->cache->load('getallclients');
        }
        
    }

    public function indexAction()
    {
        
        $ns = new Zend_Session_Namespace("PasswdCacheAuth");
        
        if (isset($ns->passwd)) {
        
            $this->_helper->viewRenderer->setRender('new');
           
            $this->view->layout()->scriptTags = '<script type="text/javascript" src="/js/index/new.js"></script>';
            
            $this->view->form = new Application_Form_InitialForm();
            
            
            
        } else {
            
            $this->view->form = new Application_Form_New();
            
        }
        
    }

    public function optimusjobdataAction()
    {
        // action body
    }

    public function newAction()
    {
        
        $form = new Application_Form_New();
        
        $this->view->initform = $form;

        if ($this->getRequest()->isPost())
        {
            if ($form->isValid($_POST))
            {
                
                $this->view->form = new Application_Form_InitialForm();
                
                $ns = new Zend_Session_Namespace("PasswdCacheAuth");
                $ns->passwd = $this->_request->getPost('password');
               
                
                             
        
            } else {
        
                $this->view->errors = $form->getMessages();
                 
            }
        }
        
        
        
        
        
    }

    public function processAction()
    {
            
    }

    public function editAction()
    {
        // action body
    }

    public function updateAction()
    {
        // action body
    }

    public function searchgroupAction()
    {
        // action body
    }


}













