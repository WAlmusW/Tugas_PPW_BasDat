<?php

class AddUserView {
    public function renderPage() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <title>Add User</title>
            <style>
                /* Add your custom styles here */
                body {
                    padding: 20px;
                }
            </style>
        </head>
        <body>
            <h1>Add User</h1>
            <form action="add_user_controller.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="method" class="form-label">Method</label>
                    <input type="text" class="form-control" id="method" name="method" required>
                </div>
                <button type="submit" class="btn btn-success">Add User</button>
            </form>
        </body>
        </html>
        <?php
    }
}

?>
