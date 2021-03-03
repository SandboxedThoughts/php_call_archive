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
        <link rel="stylesheet" href="static/style.css">
    </head>
    <body>
        <div class="title">
            <h1><?php echo $total_rows; ?></h1>
            <h1>Voicemail Archive</h1>
        </div>
        <form action="" method="post" id="load-backups">
            <input type="submit" value="load backups" name="loaded">
        </form>
        <a href="records.php">View Records</a>
        <?php
        # If the load button is clicked:
            if (isset($_REQUEST['loaded'])) {
                include 'helpers/load.php';
            }
        ?>
        <script src="static/scripts.js"></script> 
    </body>

</html>

