<?php

class BiodataView {
    public function renderPage($userData) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link href="../../style/biodata_style.css" rel="stylesheet">
            <title>Biodata</title>

            <!-- Add CodePen CSS -->
            <link rel="stylesheet" href="path/to/codepen.css">
        </head>
        <body>

            <!-- Use CodePen HTML structure -->
            <div class="container">
                <form class="well form-horizontal" action="../controller/biodata_controller.php" method="post" enctype="multipart/form-data" id="contact_form">

                    <!-- Text input for Name -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Name</label>  
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo $userData['name'] ?? ''; ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Text input for Address -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Address</label>  
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                <input type="text" name="address" placeholder="Address" class="form-control" value="<?php echo $userData['address'] ?? ''; ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Text input for NIM -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">NIM</label>  
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="nim" placeholder="NIM" class="form-control" value="<?php echo $userData['nim'] ?? ''; ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Text input for Gender -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Gender</label>  
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="gender" placeholder="Gender" class="form-control" value="<?php echo $userData['gender'] ?? ''; ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Text input for Program Studi -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Program Studi</label>  
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="program_studi" placeholder="Program Studi" class="form-control" value="<?php echo $userData['program_studi'] ?? ''; ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Text input for Fakultas -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Fakultas</label>  
                        <div class="col-md-4 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="fakultas" placeholder="Fakultas" class="form-control" value="<?php echo $userData['fakultas'] ?? ''; ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- File input for Profile Picture -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Profile Picture</label>
                        <div class="col-md-4 inputGroupContainer">
                            <?php if ($userData !== null && $userData['profile_picture_path'] !== null): ?>
                                <img src="<?php echo $userData['profile_picture_path']; ?>" alt="Profile Picture" class="profile-picture">
                            <?php else: ?>
                                <div class="placeholder-block"></div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        </div>
                    </div>

                    <!-- Add other form fields as per the CodePen structure -->

                    <!-- ... -->

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <input type="submit" class="btn btn-warning" value="Save Biodata">
                        </div>
                    </div>

                </form>

                <a href="../controller/dashboard_controller.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
            </div>

            <script src="../../script/biodata_script.js"></script> 

        </body>
        </html>
        <?php
    }
}

?>
