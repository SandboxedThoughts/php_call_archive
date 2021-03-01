# php_call_archive
provides a solution to neatly display exported WAV/XML pairs of call recordings for users to download locally.

## How to use:
load into your webserver and download XML/WAV pairs and directories to phone_recordings

## What it does:
1. Recurses through the phone_recordings directory
2. Collects the XML data for each WAV/XML pair
3. Uploads data and relative filepath to the audio recording to MYSQL Database
4. Displays the collected information in a table on index.php to with an available download link that will download the audio recording to the user's local machine. 