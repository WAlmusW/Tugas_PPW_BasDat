<?php

class KHSView {
    public function renderPage($filePath) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link href="../../style/khs_style.css" rel="stylesheet">
            <title>KHS</title>
        </head>
        <body>
            <h1>KHS Page</h1>
            <?php if ($filePath): ?>
                <embed src="<?php echo $filePath; ?>" type="application/pdf" width="100%" height="600px">
            <?php else: ?>
                <p>No KHS file uploaded yet. Please upload your KHS PDF file.</p>
                <form action="../controller/khs_controller.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="khsFile" class="form-label">Upload KHS PDF file:</label>
                        <input type="file" class="form-control" id="khsFile" name="khsFile" accept=".pdf" required>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Upload KHS">
                </form>
            <?php endif; ?>
            <a href="../controller/dashboard_controller.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
        </body>
        </html>
        <?php
    }
}

?>
