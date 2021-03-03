<?php
function uploadFile($file, $audiofile){
    require 'vars.php';
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