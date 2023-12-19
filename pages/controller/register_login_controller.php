<?php

require_once '../model/register_model.php';
require_once '../model/login_model.php';
require_once '../view/register_login_view.php';

class RegisterLoginController {
    private $registerModel;
    private $loginModel;
    private $registerLoginView;

    public function __construct(RegisterModel $registerModel, LoginModel $loginModel, RegisterLoginView $registerLoginView) {
        $this->registerModel = $registerModel;
        $this->loginModel = $loginModel;
        $this->registerLoginView = $registerLoginView;
    }

    public function renderPage() {
        // If coming from google_auth.php, $_SESSION['email'] will be set
        if (isset($_SESSION['email'])) {
            $this->handleGoogleAuth();
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handleRequest();
        } else {
            $num1 = rand(0, 9);
            $num2 = rand(0, 9);
            $captchaQuestion = "What is the sum of $num1 + $num2?";

            $this->registerLoginView->renderForms($captchaQuestion, $num1, $num2);
        }
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $userAnswer = (int)$_POST['captcha'];
            $expectedAnswer = (int)$_POST['expected-answer'];

            // Check if the request is for registration or login
            if (isset($_POST['register'])) {
                $registrationResult = $this->registerModel->registerUser_NORMAL($email, $password, $userAnswer, $expectedAnswer);

                if ($registrationResult) {
                    $_SESSION['email'] = $email;
                    $this->redirectTo('dashboard_controller.php');
                } else {
                    $this->redirectTo('register_login_controller.php');
                }
            } elseif (isset($_POST['login'])) {
                $userExists_Normal = $this->loginModel->checkUserExistence_Normal($email, $password, $userAnswer, $expectedAnswer);
                
                if ($userExists_Normal) {
                    $_SESSION['email'] = $email;
                    $this->redirectTo('dashboard_controller.php');
                } else {
                    $this->redirectTo('register_login_controller.php');
                }
            }
        }
    }

    public function handleGoogleAuth() {
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $mode = $_SESSION['mode'];

            // Check if user exists for Google login
            if ($mode === "login") {
                $userExists_Google = $this->loginModel->checkUserExistence_Google($email);

                if ($userExists_Google) {
                    $this->redirectTo('dashboard_controller.php');
                } else {
                    $this->redirectTo('register_login_controller.php');
                }
            } elseif ($mode === "register") {
                $this->registerModel->registerUser_GOOGLE($email);
                $this->redirectTo('dashboard_controller.php');
            }
            
        }
    }

    public function redirectTo($location) {
        header("Location: $location");
        exit();
    }
}

// Creating instances of models and view
$registerModel = new RegisterModel();
$loginModel = new LoginModel();
$registerLoginView = new RegisterLoginView();

// Creating instance of the combined controller
$registerLoginController = new RegisterLoginController($registerModel, $loginModel, $registerLoginView);
$registerLoginController->renderPage();
$registerLoginController->handleRequest();

?>