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
        <?php
            # If the load button is clicked:
                if (isset($_REQUEST['loaded'])) {
                    include 'helpers/load.php';
                }
            # Set starting page and record limit per page:
            if (!isset($_GET['page'])){$page = 1;} else {$page = $_GET['page'];}
            if (!isset($_GET['per_page'])){$per_page = 10;} else {$per_page = $_GET['per_page'];}
            # Set starting sort column and order
            if (!isset($_GET['sort_on'])){$sort_on = "date_created_ts";}else{$sort_on = $_GET['sort_on'];}
            if (!isset($_GET['sort_order'])){$sort_order = 'desc';}else{$sort_order = $_GET['sort_order'];}
            # Get the records for the page
            if(!isset($_GET['search'])){$search="";}else{$search = $_GET['search'];}
            if(!isset($_GET['search_col'])){$search_col="";}else{$search_col = $_GET['search_col'];}
            if (($search != "") AND ($search_col != "")){
                $sql = "SELECT * FROM recording_log WHERE ". $search_col . "LIKE '%". $search . "%' ORDER BY " . $sort_on . " " . $sort_order . " LIMIT " . ($page - 1) . "," . $per_page;
            }
            else {
                $sql = "SELECT * FROM recording_log ORDER BY " . $sort_on . " " . $sort_order . " LIMIT " . ($page - 1) . "," . $per_page;
            }
            if ($result = mysqli_query($conn, $sql)){
            echo "<h1>".$sql."</h1>";
        ?>
            <form class="search" action="/" method="GET">
                <label for="search">Search for: </label>
                <input type="text" name="search" />
                <label for="search_col"> in column:</label>
                <select name="search_col">
                    <option value="recording_tag">Recording Tag</option>
                    <option value="from_caller_id">From Caller ID</option>
                    <option value="to_caller_id">To Caller ID</option>
                </select>
                <input type="submit" value="search">
            </form>
            <div class="table-container">
                <table id="recordings-table">
                    <thead>
                        <tr>
                            <th class="recording-col">Recording</th>
                            <th class="recording-tag" onclick="sortTable(1)">Recording Tag</th>
                            <th class="from-caller-id" onclick="sortTable(2)">From Caller ID</th>
                            <th class="to-caller-id" onclick="sortTable(3)">To Caller ID</th>
                            <th class="duration" onclick="sortTable(4)">Duration</th>
                            <th class="date-created" onclick="sortTable(5)">Date Created (timestamp)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $rowCount = 'odd';
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr class="<?php echo $rowCount; ?>">
                            <td class="recording-col"><a href="<?php echo $row['recording']; ?>" target='download'><img src="static/img/download.png" height=40 width=40 /></a></td>
                            <td class="recording-tag"><?php echo $row['recording_tag']; ?></td>
                            <td class="from-caller-id"><?php echo $row['from_caller_id']; ?></td>
                            <td class="to-caller-id"><?php echo $row['to_caller_id']; ?></td>
                            <td class="duration"><?php echo $row['duration']; ?></td>
                            <td class="date-created"><?php echo $row['date_created_ts']; ?></td>
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
            <form action="" method="GET" id="per-page">
                <select class="rows-per-page" name="per_page">
                    <option value="10"<?php if ($per_page == 10){echo "selected";} ?>>10</option>
                    <option value="25"<?php if ($per_page == 25){echo "selected";} ?>>25</option>
                    <option value="50"<?php if ($per_page == 50){echo "selected";} ?>>50</option>
                    <option value="100"<?php if ($per_page == 100){echo "selected";} ?>>100</option>
                </select>
                <input type="submit" value="per page">
            </form>

            <?php include 'helpers/pagination.php'; ?>

        <script src="static/js/scripts.js"></script> 
    </body>

</html>

