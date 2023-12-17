<?php

require_once '../../google_config.php';
require '../../config/db_config.php';

class LoginView {
    public function renderForm($captchaQuestion, $num1, $num2) {
        global $client;

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <title>Login</title>
        </head>
        <body>
            <h1 style="text-align: center; margin:30px;">Login</h1>
            <form style="padding:20px; margin:30px;" action="../controller/login_controller.php" method="post">

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

                <input type="submit" class="btn btn-primary" value="Login">
            </form>

            <div class="divider mb-3"> . </div>

            <div class="google-sign-in">
                <a type="button" class="btn btn-light d-block" href="<?= $client->createAuthUrl() ?>"><img src="../../assets/images/google.png" height="50em" alt="Google Logo"> Login with Google</a>
            </div>

            <div class="divider mb-3"> . </div>

            <div style="text-align: center;">
                <a class="btn btn-outline-success" href="../controller/register_controller.php">Belum punya akun? Register disini</a>
            </div>
        </body>
        </html>
        <?php
    }
}

?>
