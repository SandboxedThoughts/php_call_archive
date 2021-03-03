<?php
    include 'helpers/vars.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Phone Records</title>
        <link rel="stylesheet" href="static/style.css">
    </head>
</head>
    <body>
        <?php
            # Set starting page and record limit per page:
            if (!isset($_GET['page'])){$page = 1;} else {$page = $_GET['page'];}
            if (!isset($_GET['per_page'])){$per_page = 1;} else {$per_page = $_GET['per_page'];}
            # Set starting sort column and order
            $sort_on = "date_created_ts";
            $sort_order = "desc";
            # Get the records for the page
            $sql = "SELECT * FROM recording_log ORDER BY " . $sort_on . " " . $sort_order . " LIMIT " . ($page - 1) . "," . $per_page;
            if ($result = mysqli_query($conn, $sql)){
            
            # Pagination
            include 'helpers/pagination.php'; 
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
                    ?>
                    <tr class="<?php echo $rowCount; ?>">
                        <td><a href="<?php echo $row['recording']; ?>" target='download'>Download</a></td>
                        <td><?php echo $row['recording_tag']; ?></td>
                        <td><?php echo $row['from_caller_id']; ?></td>
                        <td><?php echo $row['to_caller_id']; ?></td>
                        <td><?php echo $row['duration']; ?></td>
                        <td><?php echo $row['date_created_ts']; ?></td>
                    </tr>
                    <?php                
                        if ($rowCount == 'odd') {$rowCount = 'even';}
                            else {$rowCount = 'odd';}
                        }
                    }
                    ?>
                </tbody>
            </table>  
        </div>
        <?php include 'helpers/pagination.php'; ?>
        <script src="static/scripts.js"></script>
    </body>
</html>