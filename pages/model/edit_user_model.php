<?php

require_once '../../config/db_config.php';

class EditUserModel {
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

    public function getUserById($userId) {
        $userId = $this->conn->real_escape_string($userId);
        $sql = "SELECT * FROM user_auth WHERE user_id = $userId";
        $result = $this->conn->query($sql);

        return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
    }

    public function updateUser($userId, $email, $password, $method) {
        $userId = $this->conn->real_escape_string($userId);
        $email = $this->conn->real_escape_string($email);
        $password = $this->conn->real_escape_string($password);
        $method = $this->conn->real_escape_string($method);

        $emailQuery = "SELECT * FROM user_auth WHERE user_id = '$userId'";
        $result = $this->conn->query($emailQuery);
        $row = $result->fetch_assoc();
        $prevEmail = $row['email'];

        $this->disableForeignKeyChecks();

        $sql = "UPDATE user_auth SET email='$email', password='$password', method='$method', role='MAHASISWA' WHERE email='$prevEmail'";
        $sql2 = "UPDATE user_info SET email='$email' WHERE email='$prevEmail'";

        $this->conn->query($sql);
        $out = $this->conn->query($sql2);

        $this->enableForeignKeyChecks();
        return $out;
    }
}

?>
