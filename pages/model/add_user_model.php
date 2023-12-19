<?php

require_once '../../config/db_config.php';

class AddUserModel {
    private $conn;

    public function __construct() {
        global $db_host, $db_username, $db_password, $db_name;
        
        $this->conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function disableForeignKeyChecks() {
        mysqli_query($this->conn, 'SET FOREIGN_KEY_CHECKS=0');
    }

    private function enableForeignKeyChecks() {
        mysqli_query($this->conn, 'SET FOREIGN_KEY_CHECKS=1');
    }

    public function addUser($email, $password, $method) {
        $email = $this->conn->real_escape_string($email);
        $password = $this->conn->real_escape_string($password);
        $method = $this->conn->real_escape_string($method);

        $this->disableForeignKeyChecks();

        // Insert user_auth record
        $addAuthQuery = "INSERT INTO user_auth (email, password, method, role) VALUES ('$email', '$password', '$method', 'MAHASISWA')";
        $this->conn->query($addAuthQuery);

        // Insert user_info record
        $addInfoQuery = "INSERT INTO user_info (email) VALUES ('$email')";
        $this->conn->query($addInfoQuery);

        $this->enableForeignKeyChecks();
    }
}

?>
