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
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class Database {
    protected $driver;
    protected $db;
    protected $username;
    protected $password;
    
    
    
    public function __construct() {
        $this->driver = "mysqli";
        $this->db = "csr";
        $this->username = "root";
        $this->password = "";
        $this->charset = "utf8";
    }
    
    public function getConnection(){
        $config = array(
            'driver' => $this->driver,
            'db' => $this->db,
            'username' => $this->username,
            'password' => $this->password,
            'charset' => $this->charset,
        );
        return $adapter = new Adapter($config);
    }
}
