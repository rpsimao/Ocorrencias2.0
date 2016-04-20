<?php

class Application_Model_Registos implements RPS_Interfaces_CRUD
{
	
    protected $registos;
    
	public function __construct(){
	    
	    $config = Zend_Registry::get('registos');
	    $db = Zend_Db::factory($config->database);
	    Zend_Db_Table_Abstract::setDefaultAdapter($db);
	    
	    $this->registos = new Application_Model_DbTable_Registos();
	    
	    
	}
	
	/* (non-PHPdoc)
     * @see RPS_Interfaces_CRUD::deleteRecord()
     */public function deleteRecord ($id)
     {
        $where = $this->registos->getAdapter()->quoteInto('id = ?', $id);
        $this->registos->delete($where);
        }

	/* (non-PHPdoc)
     * @see RPS_Interfaces_CRUD::findById()
     */public function findById ($id)
        {
            $row = $this->registos->find($id);
            $result = $row->toArray();
            
            return $result[0];
        }

	/* (non-PHPdoc)
     * @see RPS_Interfaces_CRUD::getAllRecords()
     */public function getAllRecords ()
    {
        $rows = $this->registos->fetchAll();
        
        return $rows;
     }

	/* (non-PHPdoc)
     * @see RPS_Interfaces_CRUD::insertData()
     */
     public function insertData (array $values)
     {
         
         
         $data = array(
                
                "origem"              => $values['origem'],
                "tipo_registo"        => $values['tipo_registo'],
                "sistema"             => $values['sistema'],
                "obra"                => $values['obra'],
                "matcert"             => $values['matcert'],
                "doc_referencia"      => $values['doc_referencia'],
                "data_detectada"      => $values['data_detectada'],
                "trabalho"            => $values['trabalho'],
                "jobtype"             => $values['jobtype'],
                "lote"                => $values['lote'],
                "entidade"            => $values['entidade'],
                "qtd_recebida"        => $values['qtd_recebida'],
                "qtd_reclamada"       => $values['qtd_reclamada'],
                "qtd_falta"           => $values['qtd_falta'],
                "ordem_compra"        => $values['ordem_compra'],
                "amostra_disponivel"  => $values['amostra_disponivel'],
                "situacao_recorrente" => $values['situacao_recorrente'],
                "descricao_problema"  => $values['descricao_problema'],
                "detectado"           => $values['detectado'],
                "ip"                  => $_SERVER["REMOTE_ADDR"],
               
                 
        
        );
        
            $this->registos->insert($data);
            
            return $this->registos->getAdapter()->lastInsertId();
         
           
     
     }

	

       public function updateRecord (array $values)
       {
           $data = array(
                   'anulada'                 => $values['anulada'] ,
                   'tipo_registo'            => $values['tipo_registo'] ,
                   'origem'                  => $values['origem'] ,
                   'sistema'                 => $values['sistema'] ,
                   'obra'                    => $values['obra'] ,
                   'matcert'                 => $values['matcert'] ,
                   'entidade'                => $values['entidade'] ,
                   'trabalho'                => $values['trabalho'] ,
                   'jobtype'                 => $values['jobtype'] ,
                   'lote'                    => $values['lote'] ,
                   'qtd_recebida'            => $values['qtd_recebida'] ,
                   'qtd_reclamada'           => $values['qtd_reclamada'] ,
                   'qtd_falta'               => $values['qtd_falta'] ,
                   'ordem_compra'            => $values['ordem_compra'] ,
                   'amostra_disponivel'      => $values['amostra_disponivel'] ,
                   'situacao_recorrente'     => $values['situacao_recorrente'] ,
                   'descricao_problema'      => $values['descricao_problema'] ,
                   'notificacao'             => $values['notificacao'] ,
                   'rejeicao'                => $values['rejeicao'] ,
                   'nao_aceite'              => $values['nao_aceite'] ,
                   'reavaliacao'             => $values['reavaliacao'] ,
                   'registo'                 => $values['registo'] ,
                   'investigacao_efectuada'  => $values['investigacao_efectuada'] ,
                   'data_investigacao'       => $values['data_investigacao'] ,
                   'preenchido_investigacao' => $values['preenchido_investigacao'] ,
                   'correcoes'               => $values['correcoes'] ,
                   'abertura_obra' 		     => $values['abertura_obra'] ,
                   'data_correccoes'         => $values['data_correccoes'] ,
                   'custo_correccoes'        => $values['custo_correccoes'] ,
                   'id_causas'               => $values['id_causas'] ,
                   'data_causas'             => $values['data_causas'] ,
                   'responsavel_causas'      => $values['responsavel_causas'] ,
                   'seccao_causas'			 => $values['seccao_causas'] ,
                   'def_ac_prev_corr'        => $values['def_ac_prev_corr'] ,
                   'data_ac_prev_corr'       => $values['data_ac_prev_corr'] ,
                   'resp_ac_prev_corr'       => $values['resp_ac_prev_corr'] ,
                   'custo_ac_prev_corr'      => $values['custo_ac_prev_corr'] ,
                   'prazo_ac_prev_corr'	     => $values['prazo_ac_prev_corr'] ,
                   'fechado_ac_prev_corr'	 => $values['fechado_ac_prev_corr'] ,
                   //
                   'def_ac_preventivas'      => $values['def_ac_preventivas'] ,
                   /*'data_ac_preventivas'     => $values['data_ac_preventivas'] , */
                   'resp_ac_preventivas'     => $values['resp_ac_preventivas'] ,
                   'custo_ac_preventivas'    => $values['custo_ac_preventivas'] ,
                   'prazo_ac_preventivas'	 => $values['prazo_ac_preventivas'] ,
                   'fechado_ac_preventivas'  => $values['fechado_ac_preventivas'] ,
                   //
                   'def_ac_melhoria'         => $values['def_ac_melhoria'] ,
                   'data_ac_melhoria'        => $values['data_ac_melhoria'] ,
                   'resp_ac_melhoria'        => $values['resp_ac_melhoria'] ,
                   'custo_ac_melhoria'       => $values['custo_ac_melhoria'] ,
                   'prazo_ac_melhoria' 	     => $values['prazo_ac_melhoria'] ,
                   'fechado_ac_melhoria'	 => $values['fechado_ac_melhoria'] ,
                   //
                   'evento_fechado'          => $values['evento_fechado'] ,
                   'info_adicional'          => $values['info_adicional'] ,
                   'eficaz'                  => $values['eficaz'] ,
                   'custo_total'             => $values['custo_total'] ,
                   'data_fecho'              => $values['data_fecho'] ,
                   'resp_fecho'              => $values['resp_fecho'] ,
                   'doc_referencia'          => $values['doc_referencia'] ,
                   'data_detectada'          => $values['data_detectada'] ,
                   'detectado'               => $values['detectado'] ,
                   'resp_correccoes'         => $values['resp_correccoes'] ,
                   'resultado'               => $values['resultado'] ,
                   'perigos'                 => $values['perigos'] ,
                   'impacto_ambiental'		 => $values['impacto_ambiental'] ,
                   'cod_def'                 => $values['cod_def'],
                   'respcliente'             => $values['respcliente'],
                   'ip'                      => $_SERVER["REMOTE_ADDR"],
       
           );
           
           
           
           $where = $this->registos->getAdapter()->quoteInto('id = ?',(int) $values['id']);
           $this->registos->update($data, $where);
       }
    
       public function getAllOcorrenciasNotClosed ()
       {
       
           $sql = $this->registos->select();
           $sql->where('evento_fechado = ?', False);
           $sql->where('entidade != ?', 'ANULADA');
           
           $rows = $this->registos->fetchAll($sql);
           
           return $rows->toArray();
           
           
           
       }
       
     /**
      * 
      * @param string $group
      * @param string $name
      * @param string $sistema
      * @param int $type
      * @return multitype:
      */
       public function getAllOcorrenciasNotClosedGroupBy($group, $name, $sistema, $origem, $type)
       {
            
           $sql = $this->registos->select();
           
           switch ($type) {
               case 1:
                   $sql->where('evento_fechado = ?', False);
                   $sql->where($group .' = ?', urldecode($name));
                   $sql->where("sistema = ?", $sistema);
                  break;
               
               case 2:
                   $sql->where('evento_fechado = ?', False);
                   $sql->where($group .' = ?', urldecode($name));
                   $sql->where("origem = ?", $sistema);
                  break;
              
              case 3:
                  $sql->where('evento_fechado = ?', False);
                  $sql->where("sistema = ?", $sistema);
                  break;
                   
              case 4:
                  $sql->where('evento_fechado = ?', False);
                  $sql->where("origem = ?", $origem);
                 break;
                  
              case 5:
                  $sql->where('evento_fechado = ?', False);
                  $sql->where($group .' = ?', urldecode($name));
                  $sql->where("origem = ?", $origem);
                 break;
                 
                 case 6:
                     $sql->where('matcert = 1');
                     $sql->where($group .' = ?', urldecode($name));
                    break;
                 
                 case 7:
                     $sql->where('matcert = 1');
                     $sql->where($group .' = ?', urldecode($name));
                     $sql->where("sistema = ?", $sistema);
                    break;
                      
                 case 8:
                      $sql->where('matcert = 1');
                      $sql->where($group .' = ?', urldecode($name));
                      $sql->where("origem = ?", $origem);
                     break;
               
               default:
                  $sql->where('evento_fechado = ?', False);
                  $sql->where($group .' = ?', urldecode($name));
               break;
           }
           
           
           $rows = $this->registos->fetchAll($sql);
           
           return $rows->toArray();
            
            
            
       }
       
       public function getAllRecordsByEntidade ($entidade)
       {
       
           $sql = $this->registos->select();
           $sql->where('entidade = ?', $entidade);
           $sql->order('id DESC');
           
           $rows = $this->registos->fetchAll($sql);
           
           return $rows->toArray();
       }
       
       public function getAllRecordsByObra ($obra)
       {
       
           $sql = $this->registos->select();
           $sql->where('obra = ?', $obra);
           $sql->order('id DESC');
           
           $rows = $this->registos->fetchAll($sql);
           
           return $rows->toArray();
       }
       
       
       
       public function getAllRecordsByDateRange ($date1, $date2)
       {
       
           $rows = $this->registos->getAdapter()->fetchAll('select * from registos where data_detectada between "'.$date1.'" and "'.$date2.'"');
           
           return $rows;
       
       
       }
       
       /**
        * 
        * @param date $date
        * @example date is ISO-8601 - YYYY-MM-DD
        */
       
       public function getRecordsByDate($date)
       {
           
         $sql = $this->registos->select();
         $sql->where('DATE(abertura) = ?', $date);
         
         $rows = $this->registos->fetchAll($sql);
          
         return $rows->toArray();
         
       }
       
       public function getCertJobs()
       {
           $sql = $this->registos->select();
           $sql->where("matcert = 1");
           $sql->order('data_detectada DESC');
           
           $rows = $this->registos->fetchAll($sql);
            
           return $rows->toArray();
       }
       
       
       /**
        * 
        * @param int $type
        * @param string $cliente
        * @param int $mes
        * @param int $ano
        * @param string $oc
        * @param string $origem
        * @return multitype:
        */
       
       public function searchModalCliente($type, $cliente, $mes = null, $ano = null, $oc = null, $origem)
       {
           $sql = $this->registos->select();
           
           if ($origem =="Interna" || $origem =="Externa") {
              $rtOrigem =  $sql->where("origem = ?", $origem);
           } else {
               $rtOrigem = null;
           }
           
           switch ($type) {
               case 1:
                   $sql->where("entidade = ?", $cliente);
                   $rtOrigem;
               break;
               
               case 2:
                   $sql->where("entidade = ?", $cliente);
                   $sql->where("ordem_compra = ?", $oc);
                   $rtOrigem;
               break;
               
               case 3:
                   $sql->where("entidade = ?", $cliente);
                   $sql->where('MONTH(data_detectada) = ?', $mes);
                   $sql->where('YEAR(data_detectada) = ?', $ano);
                   $rtOrigem;
               break;
               
               case 4:
                   $sql->where("entidade = ?", $cliente);
                   $sql->where('YEAR(data_detectada) = ?', $ano);
                   $rtOrigem;
                 break;

               
           }
           

           $rows = $this->registos->fetchAll($sql);
           return $rows->toArray();
           
       }
       
       
       /**
        * 
        * @param int $job
        */
       public function findByJob($job)
       {
           $sql = $this->registos->select();
           $sql->where("obra = ?", (int) $job);
           
           $rows = $this->registos->fetchAll($sql);
           
           return $rows;
           
       }
       
       

}

