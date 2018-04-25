<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Lokalizacja
 *
 * @author Konrad
 */

namespace Application\Model;

use Application\Model\Database;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class Lokalizacja {

    private $adapter;
    private $db;

    public function __construct() {
        $this->db = new Database();
        $this->adapter = $this->db->getConnection();
    }

    public function fetchAll() {
        //$data = $this->adapter->query("SELECT * from flota", Adapter::QUERY_MODE_EXECUTE);
        $adapter = $this->adapter;
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('lokalizacja');
        $selectString = $sql->getSqlStringForSqlObject($select);
        $data = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);

        return $data;
    }

    public function dodajAction() {
        
    }

    public function usunAction() {
        
    }

}
