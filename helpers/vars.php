<?php

# DATABASE VARIABLES 
# (preloaded are defaults of WAMP Server installation, replace with your own database information)
$RECORDINGS_HOST        ="localhost";
$RECORDINGS_USER        ="root";
$RECORDINGS_PASSWORD    ="";
$RECORDINGS_DB          ="recordings";

# base directory
$dir = "./phone_recordings";

# Backups loaded
$loaded = '';

# audio file extension
$media_ext = 'wav';
# Connect to the database
$conn = mysqli_connect($RECORDINGS_HOST, $RECORDINGS_USER, $RECORDINGS_PASSWORD, $RECORDINGS_DB);

# Initial sql query: get everything
$sql = "SELECT * FROM recording_log";

$get_total = mysqli_query($conn, $sql);
$total_rows = mysqli_num_rows($get_total);

$page = 1;
$per_page = 10;
$sort_on = "date_created_ts";
$sort_order = 'desc';

?>