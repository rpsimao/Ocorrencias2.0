<?php

/** 
 * @author rpsimao
 * 
 */
interface RPS_Interfaces_CRUD
{

    /**
     * Insert or Update Values
     * 
     * @param array $params            
     */
    public function insertData (array $params);

    /**
     * Get Values By ID
     * 
     * @param int $id            
     */
    public function findById ($id);

    /**
     * Fetch all records
     */
    public function getAllRecords ();

    /**
     * Delete Record by ID
     * 
     * @param int $id            
     */
    public function deleteRecord ($id);
}

?>