<?php

require_once '../model/register_model.php';
require_once '../view/register_view.php';

class RegisterController {
    private $model;
    private $view;

    public function __construct(RegisterModel $model, RegisterView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function renderPage() {
        // If coming from google_auth.php, $_SESSION['email'] will be set
        if (isset($_SESSION['email'])) {
            $this->handleGoogleAuth();
        } else {
            $num1 = rand(0, 9);
            $num2 = rand(0, 9);
            $captchaQuestion = "What is the sum of $num1 + $num2?";

            $this->view->renderForm($captchaQuestion, $num1, $num2);
        }
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve user input
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Retrieve captcha data
            $userAnswer = (int)$_POST['captcha'];
            $expectedAnswer = (int)$_POST['expected-answer'];

            // Register user
            $registrationResult = $this->model->registerUser_NORMAL($email, $password, $userAnswer, $expectedAnswer);

            if ($registrationResult) {
                // Registration successful, redirect to biodata.php
                $_SESSION['email'] = $email;
                $this->redirectTo('dashboard_controller.php');
            } else {
                // Registration failed, redirect back to the registration form with an error message
                $this->redirectTo('register_controller.php');
            }
        } 
    }

    public function handleGoogleAuth() {
        // Check if the email session is set before proceeding
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $this->model->registerUser_GOOGLE($email);

            $this->redirectTo('dashboard_controller.php');
        } else {
            // Handle the case when the email session is not set
            $this->redirectTo('register_controller.php');
        }
    }

    public function redirectTo($location) {
        header("Location: $location");
        exit();
    }
}

$model = new RegisterModel();
$view = new RegisterView();
$controller = new RegisterController($model, $view);
$controller->renderPage();
$controller->handleRequest();

?>
