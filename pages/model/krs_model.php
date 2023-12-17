<?php

require_once '../../config/db_config.php';

class KRSModel {
    private $conn;

    public function __construct() {
        global $db_host, $db_username, $db_password, $db_name;
        
        $this->conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function saveKRSPath($email, $filePath) {
        $email = $this->conn->real_escape_string($email);
        $filePath = $this->conn->real_escape_string($filePath);

        $sql = "UPDATE user_info SET krs_path = '$filePath' WHERE email = '$email'";
        $this->conn->query($sql);
    }

    public function getKRSPath($email) {
        $email = $this->conn->real_escape_string($email);

        $sql = "SELECT krs_path FROM user_info WHERE email = '$email'";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        return isset($row['krs_path']) ? $row['krs_path'] : null;
    }
}

?>
