<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Flota
 *
 * @author Konrad
 */

namespace Application\Model;

use Application\Model\Database;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class Flota {

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
        $select->from('flota');
        $selectString = $sql->getSqlStringForSqlObject($select);
        $data = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);

        return $data;
    }

    public function pobierzSamochodyById($array_id) {
        foreach ($array_id as $id) {
            $adapter = $this->adapter;
            $sql = new Sql($this->adapter);
            $select = $sql->select();
            $select->from('flota');
            $select->where(array('id' => $id));
            $selectString = $sql->buildSqlString($select);
            $data = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE)->toArray();
        }
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function sprawdzSamochod($id) {
        $adapter = $this->adapter;
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->from('flota');
        $select->where(array('id' => $id));
        $selectString = $sql->buildSqlString($select);
        $data = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE)->toArray();
        $data = array_shift($data);
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function dodajAction() {
        
    }

    public function usunAction() {
        
    }

    public function szukajAction($data_wypozyczenia, $data_zwrotu) {
        $adapter = $this->adapter;
        $sql = new Sql($this->adapter);
        $select = $sql->select()->columns(array('id_flota'));
        $select->from('rezerwacja');
        $select->where('data_wypozyczenia NOT BETWEEN \'' . $data_wypozyczenia . '\' and \'' . $data_zwrotu . '\'');
        $select->where('data_zwrotu NOT BETWEEN \'' . $data_wypozyczenia . '\' and \'' . $data_zwrotu . '\'');
        $select->group('id_flota');
        $selectString = $sql->buildSqlString($select);
        $data = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE)->toArray();
        $rezerwacje = [];
        foreach ($data as $key => $value) {
            array_push($rezerwacje, $value['id_flota']);
        };

        if ($data) {
            return $rezerwacje;
        } else {
            return false;
        }
    }

}
