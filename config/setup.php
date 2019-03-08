<?php

require('tools/sql_import.php');
$config = require('database.php');
$filePath = 'database.sql';

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