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
        <h1>Voicemail Archive</h1>
    </div>
    <form action="" method="post" id="load-backups">
        <input type="submit" value="load backups" name="loaded">
    </form>
        <?php if (isset($_REQUEST['loaded'])) {
            include 'helpers/load.php';
        } ?>
<?php
# Check to make sure that there is at least one row of information in the database, then output the data into a table.
if ($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result)>0){
?>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Recording</th>
                    <th>Recording Tag</th>
                    <th>From Caller ID</th>
                    <th>To Caller ID</th>
                    <th>Duration</th>
                    <th>Date Created (timestamp)</th>
                </tr>
            </thead>
            <tbody>
<?php

    $rowCount = 'odd';
    while ($row = mysqli_fetch_array($result)) {
        echo '<tr class="'.$rowCount.'">';
        echo "<td><a href='" . $row['recording'] . "' target='download'>Download Recording</a></td>";
        echo "<td>" . $row['recording_tag'] . "</td>";
        echo "<td>" . $row['from_caller_id'] . "</td>";
        echo "<td>" . $row['to_caller_id'] . "</td>";
        echo "<td>" . $row['duration'] . "</td>";
        echo "<td>" . $row['date_created_ts'] . "</td>";
        echo "</tr>";
        if ($rowCount == 'odd') {
            $rowCount = 'even';
        } else {
            $rowCount = 'odd';
        }
    }
    
    }
}
?>
            </tbody>
        </table>
    </div>
    <script src="static/scripts.js"></script>
</body>
</html>

