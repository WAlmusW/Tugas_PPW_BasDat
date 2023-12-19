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
        </head>
        <body>
            <h1>Biodata Page</h1>
            <div class="form-container">
                <form action="../controller/biodata_controller.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $userData['name'] ?? ''; ?>" required/>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo $userData['address'] ?? ''; ?>" required/>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" value="<?php echo $userData['nim'] ?? ''; ?>" required/>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender" value="<?php echo $userData['gender'] ?? ''; ?>" required/>
                    </div>
                    <div class="mb-3">
                        <label for="program_studi" class="form-label">Program Studi</label>
                        <input type="text" class="form-control" id="program_studi" name="program_studi" placeholder="Program Studi" value="<?php echo $userData['program_studi'] ?? ''; ?>" required/>
                    </div>
                    <div class="mb-3">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <input type="text" class="form-control" id="fakultas" name="fakultas" placeholder="Fakultas" value="<?php echo $userData['fakultas'] ?? ''; ?>" required/>
                    </div>
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture</label>
                        <?php if ($userData !== null && $userData['profile_picture_path'] !== null): ?>
                            <img src="<?php echo $userData['profile_picture_path']; ?>" alt="Profile Picture" class="profile-picture">
                        <?php else: ?>
                            <div class="placeholder-block"></div>
                        <?php endif; ?>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Save Biodata">
                </form>
            </div>
            <a href="../controller/dashboard_controller.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
        </body>
        </html>
        <?php
    }
}

?>
