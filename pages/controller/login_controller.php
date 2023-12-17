<?php

require_once '../model/login_model.php';
require_once '../view/login_view.php';

class LoginController {
    private $model;
    private $view;

    public function __construct(LoginModel $model, LoginView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function renderPage() {
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

            // Check if user exists for normal login
            $userExists_Normal = $this->model->checkUserExistence_Normal($email, $password, $userAnswer, $expectedAnswer);

            if ($userExists_Normal) {
                $_SESSION['email'] = $email;
                $this->redirectTo('dashboard_controller.php');
            } else {
                // User does not exist or incorrect password, redirect back to login form
                $this->redirectTo('login_controller.php');
            }
        }
    }

    public function handleGoogleAuth() {
        // Check if the email session is set before proceeding
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            // Check if user exists for Google login
            $userExists_Google = $this->model->checkUserExistence_Google($email);

            if ($userExists_Google) {
                $this->redirectTo('dashboard_controller.php');
            } else {
                $this->redirectTo('login_controller.php');
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

$model = new LoginModel();
$view = new LoginView();
$controller = new LoginController($model, $view);
$controller->renderPage();
$controller->handleRequest();

?>
