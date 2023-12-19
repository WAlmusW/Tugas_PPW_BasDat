<?php

require_once '../model/admin_menu_model.php';
require_once '../view/admin_menu_view.php';

class AdminMenuController {
    private $model;
    private $view;

    public function __construct(AdminMenuModel $model, AdminMenuView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function renderPage() {
        // Fetch all users for displaying in the table
        $users = $this->model->getAllMahasiswaUsers();

        // Render the Admin Menu page with user table
        $this->view->renderPage($users);
    }

    public function handleAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'edit':
                    // Redirect to Edit User page
                    $this->redirectTo('edit_user_controller.php?user_id=' . $_GET['user_id']);
                    break;

                case 'add':
                    // Redirect to Add User page
                    $this->redirectTo('add_user_controller.php');
                    break;

                case 'delete':
                    // Handle Delete User action
                    $this->handleDeleteAction();
                    break;

                // Add more cases if needed for other actions

                default:
                    // Handle unknown action
                    echo "Unknown action!";
                    exit();
            }
        }
    }

    public function handleDeleteAction() {
        if (isset($_GET['user_id'])) {
            $userId = $_GET['user_id'];

            // Delete the user in the model
            $this->model->deleteUser($userId);

            // Redirect back to the Admin Menu after deletion
            $this->redirectTo('admin_menu_controller.php');
        } else {
            // Handle missing user_id error
            echo "User ID not provided for deletion!";
            exit();
        }
    }

    public function redirectTo($location) {
        header("Location: $location");
        exit();
    }
}

$model = new AdminMenuModel();
$view = new AdminMenuView();
$controller = new AdminMenuController($model, $view);
$controller->renderPage();
$controller->handleAction();

?>
