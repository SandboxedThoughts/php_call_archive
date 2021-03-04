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
        <link rel="stylesheet" href="static/css/style.css">
    </head>
</head>
    <body>
        <div class="content">
        <h1 class="title">HIA Phone Records</h1>

            <?php
                # Set starting page and record limit per page:
                if (!isset($_GET['page'])){$page = 1;} else {$page = $_GET['page'];}
                if (!isset($_GET['per_page'])){$per_page = 10;} else {$per_page = $_GET['per_page'];}
                # Set starting sort column and order
                if (!isset($_GET['sort_on'])){$sort_on = "date_created_ts";}else{$sort_on = $_GET['sort_on'];}
                if (!isset($_GET['sort_order'])){$sort_order = 'desc';}else{$sort_order = $_GET['sort_order'];}
                # Get the records for the page
                $sql = "SELECT * FROM recording_log ORDER BY " . $sort_on . " " . $sort_order . " LIMIT " . ($page - 1) . "," . $per_page;
                if ($result = mysqli_query($conn, $sql)){
                
                # Pagination
                include 'helpers/pagination.php'; 
            ?>
            <div class="table-container">
                <table id="recordings-table">
                    <thead>
                        <tr>
                            <?php
                                function sortByHead($sort_on){
                                    if (!isset($_GET['page'])){$page = 1;} else {$page = $_GET['page'];}
                                    if (!isset($_GET['per_page'])){$per_page = 10;} else {$per_page = $_GET['per_page'];}
                                    # Set starting sort column and order
                                    if (!isset($_GET['sort_on'])){$sort_on = "date_created_ts";}else{$sort_on = $_GET['sort_on'];}
                                    if (!isset($_GET['sort_order'])){$sort_order = 'desc';}else{$sort_order = $_GET['sort_order'];}
                                    if ($sort_order =='desc'){$sort_order='asc';}
                                    else{$sort_order = 'desc';}
                                    $link = "records.php?per_page=".$per_page."&page=". $page."&sort_on=".$sort_on."&sort_order=".$sort_order;
                                    return $link;
                                }
                            ?>
                            <th>Recording</th>
                            <th onclick="sortTable(1)">Recording Tag</th>
                            <th onclick="sortTable(2)">From Caller ID</th>
                            <th onclick="sortTable(3)">To Caller ID</th>
                            <th onclick="sortTable(4)">Duration</th>
                            <th onclick="sortTable(5)">Date Created (timestamp)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $rowCount = 'odd';
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr class="<?php echo $rowCount; ?>">
                            <td><a href="<?php echo $row['recording']; ?>" target='download'><img src="static/img/download.png" height=40 width=40 /></a></td>
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
        </div>
        <script src="static/js/scripts.js"></script>
    </body>
</html>