<?php

session_start(); // Start the session

require_once '../model/krs_model.php';
require_once '../view/krs_view.php';

class KRSController {
    private $model;
    private $view;

    public function __construct(KRSModel $model, KRSView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function renderPage() {
        // Check if the email session is set before proceeding
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            // Get KRS file path
            $filePath = $this->model->getKRSPath($email);

            // Render the KRS page
            $this->view->renderPage($filePath);
        } else {
            // Handle the case when the email session is not set
            $this->redirectTo('login_controller.php');
        }
    }

    public function handleUpload() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the email session is set before proceeding
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];

                // Handle file upload
                $targetDir = '../../temp/KRS/';
                $targetFile = $targetDir . $email . '.pdf';
                $uploadOk = 1;
                $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Check if the file already exists
                if (file_exists($targetFile)) {
                    $uploadOk = 0;
                }

                // Check file size (You can adjust this value according to your needs)
                if ($_FILES["krsFile"]["size"] > 5000000) {
                    $uploadOk = 0;
                }

                // Allow only PDF files
                if ($fileType != "pdf") {
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    // Handle the case when the file upload fails
                    echo "Sorry, your file was not uploaded.";
                } else {
                    // Upload the file
                    if (move_uploaded_file($_FILES["krsFile"]["tmp_name"], $targetFile)) {
                        // Save the file path to the database
                        $this->model->saveKRSPath($email, $targetFile);

                        // Redirect to the KRS page
                        $this->redirectTo('krs_controller.php');
                    } else {
                        // Handle the case when the file upload fails
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                // Handle the case when the email session is not set
                $this->redirectTo('login_controller.php');
            }
        }
    }

    public function redirectTo($location) {
        header("Location: $location");
        exit();
    }
}

$model = new KRSModel();
$view = new KRSView();
$controller = new KRSController($model, $view);

// Check if the file upload form is submitted
if (isset($_FILES["krsFile"])) {
    $controller->handleUpload();
} else {
    // Render the KRS page
    $controller->renderPage();
}

?>
