<?php

require_once '../../config/db_config.php';

class AdminMenuModel {
    private $conn;

    public function __construct() {
        global $db_host, $db_username, $db_password, $db_name;
        
        $this->conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAllMahasiswaUsers() {
        $sql = "SELECT * FROM user_auth WHERE role = 'MAHASISWA'";
        $result = $this->conn->query($sql);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    public function deleteUser($userId) {
        $userId = $this->conn->real_escape_string($userId);

        // Track the email of the user
        $emailQuery = "SELECT email FROM user_auth WHERE user_id = '$userId'";
        $result = $this->conn->query($emailQuery);
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Delete user_auth record
        $deleteAuthQuery = "DELETE FROM user_auth WHERE email = '$email'";
        $this->conn->query($deleteAuthQuery);

        // Delete user_info record (optional, based on your requirements)
        $deleteInfoQuery = "DELETE FROM user_info WHERE email = '$email'";
        $this->conn->query($deleteInfoQuery);
    }
    
}

?>
