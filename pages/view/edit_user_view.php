<?php

class EditUserView {
    public function renderPage($user) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <title>Edit User</title>
            <style>
                /* Add your custom styles here */
                body {
                    padding: 20px;
                }
            </style>
        </head>
        <body>
            <h1>Edit User</h1>
            <form action="edit_user_controller.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="method" class="form-label">Method</label>
                    <input type="text" class="form-control" id="method" name="method" value="<?php echo $user['method']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" value="<?php echo $user['role']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </body>
        </html>
        <?php
    }
}

?>
