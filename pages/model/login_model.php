<?php

require_once '../../config/db_config.php';

class LoginModel {
    private $conn;

    public function __construct() {
        global $db_host, $db_username, $db_password, $db_name;
        
        $this->conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function checkUserExistence_Google($email) {
        $email = $this->conn->real_escape_string($email);

        $sql = "SELECT * FROM user_auth WHERE email = '$email' AND method = 'GOOGLE'";
        $result = $this->conn->query($sql);

        return $result->num_rows > 0;
    }

    public function checkUserExistence_Normal($email, $password, $userAnswer, $expectedAnswer) {
        $email = $this->conn->real_escape_string($email);
        $password = $this->conn->real_escape_string($password);

        // Check if the captcha answer is correct
        if ((int)$userAnswer !== (int)$expectedAnswer) {
            return false;
        }

        $sql = "SELECT * FROM user_auth WHERE email = '$email' AND password = '$password' AND method = 'NORMAL'";
        $result = $this->conn->query($sql);

        return $result->num_rows > 0;
    }
}

?>
