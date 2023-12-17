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
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <style>
                body {
                    padding: 20px;
                }
                .navbar {
                    background-color: #f8f9fa;
                }
                .navbar-nav {
                    width: 200px;
                }
                .navbar-item {
                    padding: 10px;
                }
                .user-info {
                    margin-top: 20px;
                }
                .profile-picture {
                    max-width: 150px;
                    max-height: 150px;
                    margin-bottom: 10px;
                }

                .placeholder-block {
                    width: 150px;
                    height: 150px;
                    background-color: #eee;
            </style>
            <title>Dashboard</title>
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div class="navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item navbar-item">
                                <a class="nav-link" href="../controller/krs_controller.php">KRS</a>
                            </li>
                            <li class="nav-item navbar-item">
                                <a class="nav-link" href="../controller/khs_controller.php">KHS</a>
                            </li>
                            <li class="nav-item navbar-item">
                                <a class="nav-link" href="../controller/biodata_controller.php">Biodata</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="user-info">
                <?php if ($userData): ?>
                    <h2>Welcome, <?php echo $userData['name']; ?>!</h2>
                    <p>Email: <?php echo $userData['email']; ?></p>
                    <p>NIM: <?php echo $userData['nim']; ?></p>
                    <p>Address: <?php echo $userData['address']; ?></p>
                    <p>Gender: <?php echo $userData['gender']; ?></p>
                    <p>Program Studi: <?php echo $userData['program_studi']; ?></p>
                    <p>Fakultas: <?php echo $userData['fakultas']; ?></p>
                    <?php if ($userData['profile_picture_path'] !== null): ?>
                        <img src="<?php echo $userData['profile_picture_path']; ?>" alt="Profile Picture" class="profile-picture">
                    <?php else: ?>
                        <div class="placeholder-block"></div>
                    <?php endif; ?>
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
