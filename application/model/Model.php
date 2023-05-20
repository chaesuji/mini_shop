<?php 

// CREATE TABLE shop_info(
//     u_no INT PRIMARY KEY AUTO_INCREMENT,
//     u_id VARCHAR(20) NOT NULL,
//     u_pw VARCHAR(512) NOT NULL,
//     u_name VARCHAR(30) NOT null,
//     u_birth DATE NOT NULL,
//     u_addr VARCHAR(100) NOT null,
//     u_email VARCHAR(50) NOT null,
//     u_dflg CHAR(1) NOT NULL DEFAULT 0,
//     u_auth_no CHAR(1) NOT NULL DEFAULT 0);

namespace application\model;
use PDO;
use EXCEPTION;

class Model{
    protected $conn;

    public function __construct() {
        $dns = "mysql:host="._DB_HOST.";dbname="._DB_NAME.";charset="._DB_CHARSET;
        $option = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->conn = new PDO($dns, _DB_USER, _DB_PASSWORD, $option);

        } catch (Exception $e) {
            echo "DB Connect Error : ".$e->getMessage();
            exit();
        }
    }

    // DB Connect 파기
    public function close() {
        $this->conn = null;
    }

    // Transaction Start
    public function beginTransaction() {
        $this->conn->beginTransaction();
    }

    // commit
    public function commit() {
        $this->conn->commit();
    }

    // rollback
    public function rollback() {
        $this->conn->rollback();
    }
}