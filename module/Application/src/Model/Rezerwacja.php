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
    private $adapter;
    public function __construct() {
        $this->adapter = new Database();
        $this->adapter = $this->adapter->getConnection();
    }

    public function fetchAll(){
        //$data = $this->adapter->query("SELECT * from flota", Adapter::QUERY_MODE_EXECUTE);
        $adapter = $this->adapter;
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->from('flota');
        $selectString = $sql->getSqlStringForSqlObject($select);
        $data = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        return $data;
    }
    
    public function dodajAction($data){
        $adapter = $this->adapter;
        $sql = new Sql($this->adapter);
        $select = $sql->insert($data);
    }
    
    public function usunAction(){
        
    }
    
    public function szukajAction(){
        
    }
}
