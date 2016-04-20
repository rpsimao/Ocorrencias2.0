<?php

class ExportController extends Zend_Controller_Action
{
    
    private $registos;

    public function init ()
    {
        $this->registos = new Application_Model_Registos();
        $this->view->formExport = new Application_Form_Export();
        $this->view->setEscape('stripslashes');
    }

    public function indexAction (){}

    public function pdfAction ()
    {
        if ($this->getRequest()->isPost()) {
            
               
        if ($this->view->formExport->isValid($this->getAllParams())) {

        $this->_helper->layout->disableLayout();
        $id = $this->_getParam('id');
        $values = $this->registos->findById($id);
        
        
        if ($values['anulada'] == TRUE) {
            //$pdf = Zend_Pdf::load('pdf/anulada.pdf');
            //$this->document = $pdf->render();
            $this->redirect("/export/anulada");
        } else {
            
            
            $fv =  $this->view->formExport->getValues();           
            
            $lvDocX = new RPS_PDF_LiveDocX($fv['tipo'], $fv['user']);
            $pdf = $lvDocX->createPDF($values);
            
            $this->view->document = $pdf;
          
            
            }
         } else {
             $this->view->errors = $this->view->formExport->getMessages();
        }
        
        
        } else {
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer->setRender('pdfid');
            $id = $this->_getParam("id");
            $user = $this->_getParam('u');
            $template = $this->_getParam('t');
            
            $values = $this->registos->findById($id);
            
            $lvDocX = new RPS_PDF_LiveDocX($template, $user);
            $pdf = $lvDocX->createPDF($values);
            
            $this->view->document = $pdf;
            
        }
        
        
    }

    public function anuladaAction (){}

    
}






