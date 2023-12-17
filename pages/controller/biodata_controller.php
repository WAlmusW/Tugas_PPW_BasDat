<?php

session_start(); // Start the session

require_once '../model/biodata_model.php';
require_once '../view/biodata_view.php';

class BiodataController {
    private $model;
    private $view;

    public function __construct(BiodataModel $model, BiodataView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function renderPage() {
        // Check if the email session is set before proceeding
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            // Fetch user data
            $userData = $this->model->getUserData($email);
            $this->view->renderPage($userData);
        } else {
            // Handle the case when the email session is not set
            $this->redirectTo('login_controller.php');
        }
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve user input
            $email = $_SESSION['email']; 
            $nim = $_POST['nim'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $program_studi = $_POST['program_studi'];
            $fakultas = $_POST['fakultas'];
            $profilePicture = $_FILES['profile_picture'];

            // Update user data in the database
            $this->model->updateUserData($email, $nim, $name, $address, $gender, $program_studi, $fakultas, $profilePicture);

            // Redirect to the dashboard page after updating data
            $this->redirectTo('dashboard_controller.php');
        }
    }

    public function redirectTo($location) {
        header("Location: $location");
        exit();
    }
}

$model = new BiodataModel();
$view = new BiodataView();
$controller = new BiodataController($model, $view);
$controller->renderPage();
$controller->handleRequest();

?>
