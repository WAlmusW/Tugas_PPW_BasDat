<?php

require_once '../../google_config.php';
require '../../config/db_config.php';

class RegisterLoginView {
    public function renderForms($loginCaptchaQuestion, $loginNum1, $loginNum2) {
        global $client;
        $authUrl = $client->createAuthUrl();

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link href="../../style/register_login_style.css" rel="stylesheet">
            <title>Register and Login</title>
        </head>
        <body>
            <div class="container right-panel-active">
                <!-- Register -->
                <div class="container__form container--signup">
                    <form class="form" action="../controller/register_login_controller.php" method="post">
                        <h2 class="form__title">Register</h2>
                        <input type="text" class="input" id="email" name="email" placeholder="Email" required/>
                        <input type="password" class="input" id="password" name="password" placeholder="Password" required/>
                        <div class="mb-3">
                            <label for="captcha" class="form-label"><?php echo $loginCaptchaQuestion; ?></label>
                            <input type="text" class="input" id="captcha" name="captcha" required>
                            <input type="hidden" id="expected-answer" name="expected-answer" value="<?php echo $loginNum1 + $loginNum2; ?>">
                        </div>
                        <button class="btn r-btn" type="submit" name="register">Register</button>
                    </form>

                    <div class="google-container">
                        <a type="button" class="google" href="<?php echo $authUrl; ?>">
                            <img src="../../assets/images/google.png" height="50em" alt="Google Logo">
                        </a>
                    </div>
                </div>

                <!-- Login -->
                <div class="container__form container--signin">
                    <form class="form" action="../controller/register_login_controller.php" method="post">
                        <h2 class="form__title">Login</h2>
                        <input type="text" class="input" id="login_email" name="email" placeholder="Email" required/>
                        <input type="password" class="input" id="login_password" name="password" placeholder="Password" required/>
                        <div class="mb-3">
                            <label for="login_captcha" class="form-label"><?php echo $loginCaptchaQuestion; ?></label>
                            <input type="text" class="input" id="login_captcha" name="captcha" required>
                            <input type="hidden" id="login_expected-answer" name="expected-answer" value="<?php echo $loginNum1 + $loginNum2; ?>">
                        </div>
                        <button class="btn l-btn" type="submit" name="login">Login</button>
                    </form>

                    <div class="google-container">
                        <a type="button" class="google" href="<?php echo $authUrl; ?>">
                            <img src="../../assets/images/google.png" height="50em" alt="Google Logo">
                        </a>
                    </div>
                </div>

                <!-- Overlay -->
                <div class="container__overlay">
                    <div class="overlay">
                        <div class="overlay__panel overlay--left">
                            <button class="btn" id="signIn">Login</button>
                        </div>
                        <div class="overlay__panel overlay--right">
                            <button class="btn" id="signUp">Register</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-eKMf/C0Q/8BfQk7t9SNzJg5TsKI6p2w8OGtEmuLcFWfB1DBlu/JeqnF2b3HxmYg" crossorigin="anonymous"></script>
            <script src="../../script/register_login_script.js"></script> 
        </body>
        </html>
        <?php
    }
}

?>