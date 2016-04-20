<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initRegistry ()
    {
        Zend_Registry::set('optimus', new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'optimus'));
        Zend_Registry::set('embalagem', new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'embalagem'));
        Zend_Registry::set('passwords', new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'passwords'));
        Zend_Registry::set('pessoal', new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'pessoal'));
        
        
        if (APPLICATION_ENV == "development")
        {
             Zend_Registry::set('registos', new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'registos_teste'));
             
        } else {
             
            Zend_Registry::set('registos', new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'registos'));
        }
        
        
    }
    
    protected function _initHeader ()
    {
    
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->addHelperPath(APPLICATION_PATH . "/views/helpers", "Application_View_Helper");
        $view->doctype("HTML5");
        $view->headTitle('Fernandes & Terceiro, S.A. :: Ocorrências');
        $view->headMeta()->setCharset('utf-8');
        $view->headScript()->appendFile('http://cdn.fterceiro.pt/library/external/html5.js','text/javascript', array('conditional' => 'lt IE 9'));
        $view->headScript()->appendFile('http://cdn.fterceiro.pt/library/external/IE7.js','text/javascript', array('conditional' => 'lt IE 7'));
        $view->headScript()->appendFile('http://cdn.fterceiro.pt/library/external/IE8.js','text/javascript', array('conditional' => 'lt IE 8'));
        $view->headScript()->appendFile('http://cdn.fterceiro.pt/library/external/IE9.js','text/javascript', array('conditional' => 'lt IE 9'));
        $view->headScript()->appendFile('http://cdn.fterceiro.pt/library/js/jquery/latest/min.js', 'text/javascript');
        $view->headScript()->appendFile('http://cdn.fterceiro.pt/library/js/jqueryui/bootstrap/jquery-ui-1.9.2.custom.min.js', 'text/javascript');
        $view->headScript()->appendFile('http://cdn.fterceiro.pt/library/plugins/qtip2/jquery.qtip.min.js', 'text/javascript');
        $view->headScript()->appendFile('/js/app.bootstrap.js', 'text/javascript');
        $view->headLink()->appendStylesheet('http://cdn.fterceiro.pt/library/js/jqueryui/themes/bootstrap/jquery-ui-1.9.2.custom.css');
        $view->headScript()->appendFile('http://cdn.fterceiro.pt/library/bootstrap/js/bootstrap.min.js','text/javascript');
        $view->headScript()->appendFile('http://cdn.fterceiro.pt/library/bootstrap/js/bootstrap-notify.js','text/javascript');
        $view->headLink()->appendStylesheet('http://cdn.fterceiro.pt/library/bootstrap/css/bootstrap.min.css');
        $view->headLink()->appendStylesheet('http://cdn.fterceiro.pt/library/bootstrap/css/font-awesome.min.css');
        $view->headLink()->appendStylesheet('http://cdn.fterceiro.pt/library/bootstrap/css/bootstrap-responsive.min.css');
        $view->headLink()->appendStylesheet('http://cdn.fterceiro.pt/library/bootstrap/css/bootstrap-notify.css');
        $view->headLink()->appendStylesheet('http://cdn.fterceiro.pt/library/bootstrap/css/alert-notification-animations.css');
        $view->headLink()->appendStylesheet('http://cdn.fterceiro.pt/library/bootstrap/css/alert-blackgloss.css');
        $view->headLink()->appendStylesheet('http://cdn.fterceiro.pt/library/plugins/qtip2/jquery.qtip.min.css');
        $view->headLink()->appendStylesheet('/css/styles.css');
        $view->headLink()->headLink(array('rel' => 'icon' ,'href' => 'http://static.fterceiro.pt/assets/public/images/favicon.ico', 'type'=>"image/x-icon"), 'PREPEND');
        $view->headMeta()->appendHttpEquiv('X-UA-Compatible', 'chrome=1');
        $view->headMeta()->appendName('Author', 'Ricardo Simao');
        $view->headMeta()->appendName('Email', 'ricardo.simao@fterceiro.pt');
        $view->headMeta()->appendName('Copyright', 'Fernandes e Terceiro, S.A.');
        $view->headMeta()->appendName('Zend Framework', Zend_Version::VERSION);
        $view->headMeta()->appendName('PHP',  phpversion());
        $view->headMeta()->appendName('Version', '@@BuildNumber@@');
        $view->headMeta()->appendName('BuildDate', '@@BuildDate@@');
    }
    
    protected function _initValidateTranslation()
    {
       $translator = new Zend_Translate(
          array(
                'adapter' => 'array',
                'content' => APPLICATION_PATH . '/languages/resources/',
                'locale'  => new Zend_Locale('pt_PT'),
                'scan'    => Zend_Translate::LOCALE_DIRECTORY)
        );
        Zend_Validate_Abstract::setDefaultTranslator($translator);
    }
    
    
    protected function _initRoutes()
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();
         
        $route = new Zend_Controller_Router_Route('view/:id', array(
                'controller' => 'view' ,
                'action' => 'index'));
        $router->addRoute('view_index', $route);
        
        
        $router = Zend_Controller_Front::getInstance()->getRouter();
         
        $route = new Zend_Controller_Router_Route('export/pdf/*', array(
                'controller' => 'export' ,
                'action' => 'pdf'));
        $router->addRoute('export_pdf', $route);
        
        $route = new Zend_Controller_Router_Route('search/searchgroup/*', array(
                'controller' => 'search' ,
                'action' => 'searchgroup'));
        $router->addRoute('search_searchgroup', $route);
    
        
    }
    
    

}

