<?php
class Application_View_Helper_Navbar extends Zend_View_Helper_Abstract
{
   /**
    * 
    * Database
    */
    private $db;
    
    /**
     * Generated HTML
     * @var string
     */
    private $html;
    
    
    
    public function __construct()
    {
        
        $this->db = new Application_Model_Registos();
        
    }
    
    
    /**
     * 
     * @param string $active
     * @return string
     */
    public function Navbar ($active)
    {
        
        
        $this->html = '<div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <span class="brand">REGISTO OCORRÊNCIAS</span>
                    <ul class="nav">
                       '.$this->_html($active).'
                   </ul>
              </div>
        </div>
    </div>';
        return $this->html;
    }
    
    
    
    
    /**
     * 
     * @param string $active
     * @return string
     */
    private function _html($active)
    {
    
        switch ($active) {
            case "index":
                return $this->_generateNavbar("active", null, null, null);
                break;
    
            case "edit":
                return $this->_generateNavbar(null, "active", null, null);
                break;
    
            case "export":
                return $this->_generateNavbar(null, null, "active", null);
                break;
                 
            case "search":
                return $this->_generateNavbar(null, null, null, "active");
                break;
    
            default:
                return ' <li><a href="/"><i class="icon-file icon-white"></i> Nova</a></li>
                        <li><a href="/edit"><i class="icon-edit icon-white"></i> Editar</a></li>
                        <li><a href="/export"><i class="icon-share icon-white"></i> Exportar</a></li>
                       <li class="dropdown">
                          '.$this->_dropDownHTML().'
                        </li>';
                break;
        }
    
    
    }
    
    /**
     * 
     * @param string $nav1
     * @param string $nav2
     * @param string $nav3
     * @param string $nav4
     * @return string
     */
    private function _generateNavbar($nav1, $nav2, $nav3, $nav4)
    {
    
        $li1 = '<li class="active">';
        $li2 = '<li>';
    
        $a  = '<a href="/"><i class="icon-file icon-white"></i> Nova</a>';
        $b  = '<a href="/edit"><i class="icon-edit icon-white"></i> Editar</a>';
        $c  = '<a href="/export"><i class="icon-share icon-white"></i> Exportar</a>';
        $d  = '<li class="dropdown">'.$this->_dropDownHTML().'</li>';
        $d1 = '<li class="dropdown active">'.$this->_dropDownHTML().'</li>';
    
    
        if ($nav1 == "active" ){ return $li1.$a.$li2.$b.$li2.$c.$d;}
        if ($nav2 == "active" ){ return $li2.$a.$li1.$b.$li2.$c.$d;}
        if ($nav3 == "active" ){ return $li2.$a.$li2.$b.$li1.$c.$d;}
        if ($nav4 == "active" ){ return $li2.$a.$li2.$b.$li2.$c.$d1;}
    
    }
    
    
    /**
     * 
     * @return string
     */
    private function _dropDownHTML()
    {
       return '<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search icon-white"></i> Procurar <b class="caret"></b></a> <ul class="dropdown-menu" role="menu" aria-labelledby="drop1"><li><a tabindex="-1" href="javascript:searchNumber()"><i class="icon-list-ol"></i> Por Número</a></li><li><a tabindex="-1" href="javascript:searchCliente()"><i class="icon-user"></i> Por Cliente</a></li><li><a tabindex="-1" href="javascript:searchJob()"><i class="icon-list-alt"></i> Por Obra</a></li><li><a tabindex="-1" href="javascript:searchDates()"><i class="icon-calendar"></i> Por Datas</a></li><!--<li class="divider"></li> --><li><a tabindex="-1" href="/search/fscpefc"><i class="icon-leaf"></i> FSC / PEFC &nbsp;<span class="badge badge-success">'.$this->_getFSC().'</span></a></li><li><a tabindex="-1" href="/search/open"><i class="icon-folder-open-alt"></i> Abertas &nbsp;<span class="badge badge-info">'.$this->_getOpen().'</span></a></li></ul>';
    }
    
    /**
     * 
     * @return number
     */
    private function _getOpen()
    {
        $records = count($this->db->getAllOcorrenciasNotClosed());
        return $records;
     }
    
     /**
      * 
      * @return number
      */
    private function _getFSC()
    {
        $records = count($this->db->getCertJobs());
        return $records;
    }
   
}
?>