<?php
$config = require('database.php');

/* PDO connection start */
$connection = new PDO(
    'mysql' . ':dbname=' . $config["db_name"] . ';host=' . $config["db_host"],
    $config["db_user"],
    $config["db_pass"]
);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->exec("SET CHARACTER SET utf8mb4");
/* PDO connection end */

// your config
$filename = 'database.sql';

$max_runtime = 8; // less then your max script execution limit


$deadline = time() + $max_runtime;
$progressfilename = $filename . '_filepointer'; // tmp file for progress
$error_filename = $filename . '_error'; // tmp file for erro


($fp = fopen($filename, 'r')) or die('failed to open file:' . $filename);

// check for previous error
if (file_exists($error_filename)) {
    die('<pre> previous error: ' . file_get_contents($error_filename));
}

// activate automatic reload in browser
echo '<html><head> <meta http-equiv="refresh" content="' . ($max_runtime + 2) . '"></head><body><pre>';

// go to previous file position
$file_position = 0;
if (file_exists($progressfilename)) {
    $file_position = file_get_contents($progressfilename);
    fseek($fp, $file_position);
}

$query_count = 0;
$query = '';
while ($deadline > time() and ($line = fgets($fp, 1024000))) {
    if (substr($line, 0, 2) == '--' or trim($line) == '') {
        continue;
    }

    $query .= $line;
    if (substr(trim($query), -1) == ';') {
        $igweze_prep = $connection->prepare($query);

        if (!($igweze_prep->execute())) {
            $error = 'Error performing query \'<strong>' . $query . '\': ' . print_r($connection->errorInfo());
            file_put_contents($error_filename, $error . "\n");
            exit;
        }
        $query = '';
        file_put_contents($progressfilename, ftell($fp)); // save the current file position for
        $query_count++;
    }
}

if (feof($fp)) {
    echo 'dump successfully restored!';
} else {
    echo ftell($fp) . '/' . filesize($filename) . ' ' . (round(ftell($fp) / filesize($filename), 2) * 100) . '%' . "\n";
    echo $query_count . ' queries processed! please reload or wait for automatic browser refresh!';
}
?>
