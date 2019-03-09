<?php

require('tools/sql_import.php');
$config = require('database.php');
$filePath = 'database.sql';

echo "Restoring database to default state - are you sure? Type 'yes' to continue: ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
if (trim($line) != 'yes') {
    echo "ABORTING!\n";
    exit;
}
fclose($handle);
echo "Continuing...\n";

// PDO connection
$driver = 'mysql';
$port = 3306;
$options = [
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
	\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
	\PDO::ATTR_EMULATE_PREPARES   => true,
	\PDO::ATTR_CURSOR             => \PDO::CURSOR_FWDONLY,
];

try {
    // Get the connection's DSN
    $dsn = $driver . ':host=' . $config["db_host"] . ';port=' . $port . ';dbname=' . $config["db_name"] . ';charset=utf8mb4';

    // Connect to the database server
    $pdo = new \PDO($dsn, $config["db_user"], $config["db_pass"], $options);
} catch (\PDOException $e) {
	die("Can't connect to the database server. ERROR: " . $e->getMessage());
} catch (\Exception $e) {
	die("The database connection failed. ERROR: " . $e->getMessage());
}
// PDO connection

// Import the SQL file
$res = importSqlFile($pdo, $filePath);
if ($res === false) {
    die('ERROR');
}
echo ("DONE\n");

// =============================

echo "Do you want to import the demo content (users and images) ? Type 'yes' to continue: ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
if (trim($line) != 'yes') {
    echo "ABORTING!\n";
    exit;
}
fclose($handle);
echo "Continuing...\n";

$filePath = 'demo_content.sql';

// Downloading random images
echo "Downloading images...\n";
$dir = "../public/uploads/pictures/";

for ($i = 1; $i <= 100; $i++) {
    file_put_contents($dir . $i . ".jpg", fopen("https://picsum.photos/200/300?image=" . $i, 'r'));
}

echo "Importing SQL file...\n";
// Import the SQL file
$res = importSqlFile($pdo, $filePath);
if ($res === false) {
    die('ERROR');
}
echo ("DONE\n");