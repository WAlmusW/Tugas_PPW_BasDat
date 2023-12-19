<?php

require_once '../model/edit_user_model.php';
require_once '../view/edit_user_view.php';

class EditUserController {
    private $model;
    private $view;

    public function __construct(EditUserModel $model, EditUserView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function renderPage() {
        // Fetch user details for editing
        if (isset($_GET['user_id'])) {
            $userId = $_GET['user_id'];
            $user = $this->model->getUserById($userId);

            if (!$user) {
                // Handle user not found error
                echo "User not found!";
                exit();
            }

            // Render the Edit User page with user details
            $this->view->renderPage($user);
        } else {
            // Handle missing user_id error
            echo "User ID not provided!";
            exit();
        }
    }

    public function handleRequest() {
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assuming you have an EditUserModel method like updateUser
            $userId = $_POST['user_id'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $method = $_POST['method'];

            // Update the user in the model
            $success = $this->model->updateUser($userId, $email, $password, $method);

            if ($success) {
                echo "User updated successfully!";
                $this->redirectTo('admin_menu_controller.php');
            } else {
                echo "Error updating user!";
                $this->redirectTo('admin_menu_controller.php');
            }
        }
    }

    public function redirectTo($location) {
        header("Location: $location");
        exit();
    }
}

$model = new EditUserModel();
$view = new EditUserView();
$controller = new EditUserController($model, $view);
$controller->handleRequest();
$controller->renderPage();

?>
