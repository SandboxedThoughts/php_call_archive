<?php
    include 'helpers/vars.php';
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Phone Recordings</title>
        <link rel="stylesheet" href="static/css/style.css">
    </head>
    <body>
        <div class="title">
            <h1>Voicemail Archive</h1>
        </div>
        <div class="actions">
            <form action="" method="post" id="load-backups">
                <input type="submit" value="Load Backups" name="loaded">
            </form>
            <form action="records.php" method="post" id="records">
                <input type="submit" value="View Records">
            </form>
        </div>
        <?php
        # If the load button is clicked:
            if (isset($_REQUEST['loaded'])) {
                include 'helpers/load.php';
            }
        ?>
        <script src="static/js/scripts.js"></script> 
    </body>

</html>

