<?php

require_once '../../google_config.php';
require '../../config/db_config.php';

class RegisterView {
    public function renderForm($captchaQuestion, $num1, $num2) {
        global $client;
        
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <title>Register</title>
        </head>
        <body>
            <div class="container">
                <h1 class="text-center mt-5">Register</h1>
                
                <form class="p-4" action="../controller/register_controller.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required/>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>
                    </div>

                    <div class="mb-3">
                        <label for="captcha" class="form-label"><?php echo $captchaQuestion; ?></label>
                        <input type="text" class="form-control" id="captcha" name="captcha" required>
                        <input type="hidden" id="expected-answer" name="expected-answer" value="<?php echo $num1 + $num2; ?>">
                    </div>

                    <button type="submit" class="btn btn-success">Register</button>
                </form>

                <div class="mb-3 text-center">
                    <a type="button" class="btn btn-light" href="<?= $client->createAuthUrl() ?>">
                        <img src="../../assets/images/google.png" height="50em" alt="Google Logo"> Register with Google
                    </a>
                </div>

                <div class="text-center">
                    <a class="btn btn-outline-primary" href="../controller/login_controller.php">Sudah punya akun? Login disini</a>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-eKMf/C0Q/8BfQk7t9SNzJg5TsKI6p2w8OGtEmuLcFWfB1DBlu/JeqnF2b3HxmYg" crossorigin="anonymous"></script>
        </body>
        </html>
        <?php
    }
}
?>
