<?php

require_once '../../config/db_config.php';
require_once '../model/dashboard_model.php';
require_once '../view/dashboard_view.php';
require_once '../view/admin_dash_view.php';

class DashboardController {
    private $conn;
    private $model;
    private $view_MAHASISWA;
    private $view_ADMIN;

    public function __construct(DashboardModel $model, DashboardView $view_MAHASISWA, AdminDashboardView $view_ADMIN) {
        $this->model = $model;
        $this->view_MAHASISWA = $view_MAHASISWA;
        $this->view_ADMIN = $view_ADMIN;

        global $db_host, $db_username, $db_password, $db_name;
        
        $this->conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function renderPage() {
        // Check if the email session is set before proceeding
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            // Fetch user data
            $userData = $this->model->getUserInfo($email);
            
            $query = "SELECT role FROM user_auth WHERE email = '$email'";
            $result = $this->conn->query($query);
            $row = $result->fetch_assoc();
            $userRole = $row['role'];

            if ($userRole === 'ADMIN') {
                $this->view_ADMIN->renderPage($userData);
            } else {
                $this->view_MAHASISWA->renderPage($userData);
            }
            
        } else {
            // Handle the case when the email session is not set
            $this->redirectTo('login_controller.php');
        }
    }

    public function redirectTo($location) {
        header("Location: $location");
        exit();
    }
}

$model = new DashboardModel();
$view_MAHASISWA = new DashboardView();
$view_ADMIN = new AdminDashboardView();
$controller = new DashboardController($model, $view_MAHASISWA, $view_ADMIN);
$controller->renderPage();

?>
