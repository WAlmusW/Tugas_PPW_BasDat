<?php

require_once '../../config/db_config.php';

class BiodataModel {
    private $conn;

    public function __construct() {
        global $db_host, $db_username, $db_password, $db_name;
        
        $this->conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getUserData($email) {
        $email = $this->conn->real_escape_string($email);

        $sql = "SELECT * FROM user_info WHERE email = '$email'";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    public function updateUserData($email, $nim, $name, $address, $gender, $program_studi, $fakultas, $profilePicture) {
        $email = $this->conn->real_escape_string($email);
        $nim = $this->conn->real_escape_string($nim);
        $name = $this->conn->real_escape_string($name);
        $address = $this->conn->real_escape_string($address);
        $gender = $this->conn->real_escape_string($gender);
        $program_studi = $this->conn->real_escape_string($program_studi);
        $fakultas = $this->conn->real_escape_string($fakultas);

        // Check if a new profile picture is uploaded
        $profilePicturePath = '';
        if ($profilePicture['name']) {
            $profilePicturePath = $this->uploadProfilePicture($email, $profilePicture);
        }

        $sql = "UPDATE user_info 
                SET name = '$name', address = '$address', nim = '$nim',
                    gender = '$gender', program_studi = '$program_studi',
                    fakultas = '$fakultas', profile_picture_path = '$profilePicturePath'
                WHERE email = '$email'";

        $this->conn->query($sql);
    }

    private function uploadProfilePicture($email, $profilePicture) {
        $targetDir = '../../temp/profile_picture/';
        $targetFile = $targetDir . $email . '.' . pathinfo($profilePicture['name'], PATHINFO_EXTENSION);
        move_uploaded_file($profilePicture['tmp_name'], $targetFile);
        return $targetFile;
    }
}

?>
