<?php

require_once '../../google_config.php';
require '../../config/db_config.php';

class DashboardView {
    public function renderPage($userData) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
            <link href="../../style/dashboard_style.css" rel="stylesheet">
            <title>Dashboard</title>
        </head>
        <body class="dashboard-body">
            <nav class="main-menu">
                <ul>
                    <li>
                        <a href="../controller/admin_menu_controller.php">
                            <i class="fa fa-home fa-2x"></i>
                            <span class="nav-text">Admin Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="../controller/biodata_controller.php">
                            <i class="fa fa-user fa-2x"></i>
                            <span class="nav-text">Biodata</span>
                        </a>
                    </li>
                    <!-- Add additional menu items as needed -->
                </ul>

                <ul class="logout">
                    <li>
                        <a href="../controller/logout_controller.php">
                            <i class="fa fa-power-off fa-2x"></i>
                            <span class="nav-text">Logout</span>
                        </a>
                    </li>  
                </ul>
            </nav>

            <div class="user-info">
                <?php if ($userData): ?>
                    <div class="main">
                        <div class="head">
                            <?php if ($userData['profile_picture_path'] !== null): ?>
                                <img src="<?php echo $userData['profile_picture_path']; ?>" alt="Profile Picture" class="profile-picture">
                            <?php else: ?>
                                <div class="placeholder-block"></div>
                            <?php endif; ?>
                            <h1><?php echo $userData['name']; ?></h1>
                            <h4><?php echo $userData['nim']; ?></h4>
                        </div>
                        <div class="body">
                            <h2>Personal Details:</h2>
                            <ul>
                                <li>Email: <span class="right"><?php echo $userData['email']; ?></span></li>
                                <li>NIM: <span class="right"><?php echo $userData['nim']; ?></span></li>
                                <li>Address: <span class="right"><?php echo $userData['address']; ?></span></li>
                                <li>Gender: <span class="right"><?php echo $userData['gender']; ?></span></li>
                                <li>Program Studi: <span class="right"><?php echo $userData['program_studi']; ?></span></li>
                                <li>Fakultas: <span class="right"><?php echo $userData['fakultas']; ?></span></li>
                                <hr>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Not set yet, please go to Biodata to set the information.</p>
                <?php endif; ?>
            </div>

            <div>
                <a href="../controller/logout_controller.php"  class="logout-button">Logout</a>    
            </div>
        </body>
        </html>
        <?php
    }
}

?>
