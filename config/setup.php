<?php declare(strict_types=1);

require('tools/sql_import.php');
require('tools/general.php');

$config = require('database.php');
$file_path = 'database.sql';

if (ask_user("Restoring database to default state - are you sure?") === true) {
    // PDO connection
    $driver = 'mysql';
    $port = 3306;
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => true,
        PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,
    ];

    try {
        // Get the connection's DSN
        $dsn = $driver . ':host=' . $config["db_host"] .
            ';port=' . $port .
            ';dbname=' . $config["db_name"] .
            ';charset=utf8mb4';

        // Connect to the database server
        $pdo = new PDO($dsn, $config["db_user"], $config["db_pass"], $options);
    } catch (PDOException $e) {
        die("Can't connect to the database server. ERROR: " . $e->getMessage());
    } catch (Exception $e) {
        die("The database connection failed. ERROR: " . $e->getMessage());
    }

    // Import the SQL file
    if (import_sql_file($pdo, $file_path) === false) {
        die('ERROR');
    }
    echo("DONE\n");

    if (ask_user("Do you want to import the demo content (users and images)?") === true) {
        $file_path = 'demo_content.sql';

        if (ask_user("Do you want to DOWNLOAD random images?") === true) {
            // Downloading random images
            echo "Downloading images...\n";
            $directory = "../public/uploads/pictures/";

            for ($i = 1; $i <= 100; $i++) {
                file_put_contents($directory . $i . ".jpg", fopen("https://picsum.photos/200/300/?random", 'r'));
            }
        }

        echo "Importing SQL file...\n";
        // Import the SQL file
        if (import_sql_file($pdo, $file_path) === false) {
            die('ERROR');
        }
        echo("DONE\n");
    } else {
        die("Aborting.\n");
    }
} else {
    die("Aborting.\n");
}
