<?php

class AdminMenuView {
    public function renderPage($users) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <title>Admin Menu</title>
            <style>
                /* Add your custom styles here */
                body {
                    padding: 20px;
                }
                table {
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <h1>Admin Menu</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Method</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <th scope="row"><?php echo $user['user_id']; ?></th>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['password']; ?></td>
                            <td><?php echo $user['method']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td>
                                <a href="admin_menu_controller.php?action=edit&user_id=<?php echo $user['user_id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="?action=delete&user_id=<?php echo $user['user_id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="admin_menu_controller.php?action=add" class="btn btn-success">Add User</a>
        </body>
        </html>
        <?php
    }
}

?>
