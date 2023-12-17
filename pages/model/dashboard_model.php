<?php

require_once '../../config/db_config.php';
require_once '../../google_config.php';

class DashboardModel {
    private $conn;

    public function __construct() {
        global $db_host, $db_username, $db_password, $db_name;
        
        $this->conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getUserInfo($email) {
        $email = $this->conn->real_escape_string($email);

        $sql = "SELECT * FROM user_info WHERE email = '$email'";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    public function logout() {
        global $client;
        //Reset OAuth access token
        $client->revokeToken();

        //Destroy entire session data.
        session_destroy();

        // Close the database connection
        mysqli_close($this->conn);
    }
}

?>
