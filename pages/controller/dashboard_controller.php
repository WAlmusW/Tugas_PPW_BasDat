<?php

require_once '../model/dashboard_model.php';
require_once '../view/dashboard_view.php';

class DashboardController {
    private $model;
    private $view;

    public function __construct(DashboardModel $model, DashboardView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function renderPage() {
        // Check if the email session is set before proceeding
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            // Fetch user data
            $userData = $this->model->getUserInfo($email);

            // Render the dashboard page
            $this->view->renderPage($userData);
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
$view = new DashboardView();
$controller = new DashboardController($model, $view);
$controller->renderPage();

?>
