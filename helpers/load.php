<div id="backup-info">
<?php
    include 'vars.php';
    include 'functions.php';

    # audio format
    # iterate throughout the directory
    $DirectoryIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    # find files of type XML
    $xml_files = new RegexIterator($DirectoryIterator, '/\.xml$/');
    $loaded='';

    # Upload the files to the database (will only add files not previously uploaded)
    if (count(iterator_to_array($xml_files)) < 1){
        echo "<subtitle>Nothing to load</subtitle>";
    }
    else {
        foreach ($xml_files as $file) {
            $base_dir = pathinfo($file, PATHINFO_DIRNAME);
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $recording = str_replace("\\", "/", $base_dir."/".$filename.".".$media_ext);
            $filepath = $dir."/".$file;
            uploadFile($file, $recording);
        }
        echo "<subtitle>The archives have been loaded</subtitle>";
    }
?>    
    <button id="accept" onclick="clearAlert()">OK</button>

</div>