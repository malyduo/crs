<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rezerwacja
 *
 * @author Konrad
 */

namespace Application\Model;
use Application\Model\Database;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class Rezerwacja {
    protected $adapter;
    protected $db;
    public function __construct() {
        $this->db = new Database();
        $this->adapter = $this->db->getConnection();
    }

    public function fetchAll(){
        //$data = $this->adapter->query("SELECT * from flota", Adapter::QUERY_MODE_EXECUTE);
        $adapter = $this->adapter;
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('flota');
        $selectString = $sql->getSqlStringForSqlObject($select);
        $data = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        return $data;
    }
    
    public function rezerwujAction($data){
        $adapter = $this->adapter;
        $sql = new Sql($adapter);
        $insert = $sql->insert('rezerwacja');
        $insert->values($data);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
    }
    
    public function dodajAction($data){
        
    }
    
    public function usunAction(){
        
    }
    
    public function szukajAction(){
        
    }
}
