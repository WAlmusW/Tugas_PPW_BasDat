<?php

require_once '../model/add_user_model.php';
require_once '../view/add_user_view.php';

class AddUserController {
    private $model;
    private $view;

    public function __construct(AddUserModel $model, AddUserView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function renderPage() {
        // Render the Add User page
        $this->view->renderPage();
    }

    public function handleAddUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $method = $_POST['method'];
            $role = $_POST['role'];

            // Add the user to the database
            $this->model->addUser($email, $password, $method, $role);

            // Redirect to AdminMenu page after adding
            header("Location: admin_menu_controller.php");
            exit();
        }
    }
}

$model = new AddUserModel();
$view = new AddUserView();
$controller = new AddUserController($model, $view);
$controller->renderPage();
$controller->handleAddUser();

?>
