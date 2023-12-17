<?php

require_once '../../config/db_config.php';

class RegisterModel {
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

    public function registerUser_NORMAL($email, $password, $userAnswer, $expectedAnswer) {
        $email = $this->conn->real_escape_string($email);
        $password = $this->conn->real_escape_string($password);

        // Check if the captcha answer is correct
        if ((int)$userAnswer !== (int)$expectedAnswer) {
            return false;
        }

        $this->disableForeignKeyChecks();

        $query = "INSERT INTO user_auth (email, password, method) VALUES ('$email', '$password', 'NORMAL')";
        $registrationResult = $this->conn->query($query);

        $sql = "INSERT INTO user_info (email) VALUES ('$email')";
        $this->conn->query($sql);

        $this->enableForeignKeyChecks();

        return $registrationResult;
    }

    public function registerUser_GOOGLE($email) {
        $email = $this->conn->real_escape_string($email);

        $this->disableForeignKeyChecks();

        $query = "INSERT INTO user_auth (email, method) VALUES ('$email', 'GOOGLE')";
        $registrationResult = $this->conn->query($query);

        $sql = "INSERT INTO user_info (email) VALUES ('$email')";
        $this->conn->query($sql);

        $this->enableForeignKeyChecks();

        return $registrationResult;
    }
}

?>
