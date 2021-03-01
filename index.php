<?php
function uploadFile($file, $audiofile){
    $conn = mysqli_connect(getenv("RECORDINGS_HOST"), getenv("RECORDINGS_USER"), getenv("RECORDINGS_PASSWORD"), getenv("RECORDINGS_DB"));
    # assign the xml file and open for parsing
    $xml = simplexml_load_file($file) or die("err: Cannot create object");

    # Define the variables
    $recording = $audiofile;
    $recording_tag = $xml->recording_tag;
    $recorded_call_id = $xml->recorded_call_id;
    $recorder_cid = $xml->recorder_cid;
    $recorded_cid = $xml->recorded_cid;
    $recorder_account_id = $xml-> recorder_account_id;
    $recorded_account_id = $xml->recorded_account_id;
    $from_account_id = $xml-> from_account_id;
    $from_caller_id = $xml-> from_caller_id;
    $to_account_id = $xml-> to_account_id;
    $to_caller_id = $xml-> to_caller_id;
    $duration = $xml-> duration;
    $date_created_ts = $xml-> date_created_ts;
    $date_created_secs = $xml-> date_created_secs;

    # instert the file into the database recordings under recording_log
    $sql = "INSERT INTO recording_log (recording, recording_tag, recorded_call_id, recorder_cid, recorded_cid, recorder_account_id, recorded_account_id, from_account_id, from_caller_id, to_account_id, to_caller_id, duration, date_created_ts, date_created_secs) VALUES ('" . $recording . "','" . $recording_tag  . "','" . $recorded_call_id . "','" . $recorder_cid . "','" . $recorded_cid . "','" . $recorder_account_id . "','" . $recorded_account_id . "','" . $from_account_id . "','" . $from_caller_id . "','" . $to_account_id . "','" . $to_caller_id . "','" . $duration . "','" . $date_created_ts . "','" . $date_created_secs . "')";

    # get the results of the mysql upload
    $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Recordings</title>
    <style>
        table, th, td{font-size: 12pt;justify-content: center;align-items:left; border-collapse: collapse; border: 1px solid black;padding:10px;}
        .odd{background-color: #dddddd;}
        .table-container{display: flex; width: 80vw; margin:auto; justify-content: center; align-items: center;}
        .title{display: flex; width: 100%; justify-content: center; align-items: center;}
    </style>
</head>
<body>
    <div class="title">
        <h1>Voicemail Archive</h1>
    </div>
<?php
    # base directory
    $dir = "./phone_recordings";
    $media_ext = 'wav';
    $DirectoryIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $xml_files = new RegexIterator($DirectoryIterator, '/\.xml$/');
    foreach ($xml_files as $file) {
        $base_dir = pathinfo($file, PATHINFO_DIRNAME);
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $recording = str_replace("\\", "/", $base_dir."/".$filename.".".$media_ext);
        $filepath = $dir."/".$file;
        uploadFile($file, $recording);
    }
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "recordings");
$sql = "SELECT * FROM recording_log";
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
        echo "<td>" . $row['recording'] . "</td>";
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
</body>
</html>

