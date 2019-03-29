<?php declare(strict_types=1);
/**
 * Import SQL File
 *
 * @param PDO $pdo
 * @param string $sqlFile
 * @param string $tablePrefix
 * @param string $inFilePath
 *
 * @return bool
 */
function import_sql_file(PDO $pdo, string $sqlFile, string $tablePrefix = null, string $inFilePath = null)
{
    try {
        // Enable LOAD LOCAL INFILE
        $pdo->setAttribute(PDO::MYSQL_ATTR_LOCAL_INFILE, true);

        $hasError = false;

        // Temporary variable, used to store current query
        $tmpLine = '';

        // Read in entire file
        $lines = file($sqlFile);

        // Loop through each line
        foreach ($lines as $line) {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || trim($line) == '') {
                continue;
            }

            // Read & replace prefix
            $line = str_replace(['<<prefix>>', '<<InFilePath>>'], [$tablePrefix, $inFilePath], $line);

            // Add this line to the current segment
            $tmpLine .= $line;

            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';') {
                try {
                    // Perform the Query
                    $pdo->exec($tmpLine);
                } catch (PDOException $e) {
                    echo "<br><pre>Error performing Query: '<strong>" . $tmpLine . "</strong>': " .
                        $e->getMessage() . "</pre>\n";
                    $hasError = true;
                }

                // Reset temp variable to empty
                $tmpLine = '';
            }
        }

        // Check if error is detected
        if ($hasError) {
            return false;
        }
    } catch (Exception $e) {
        echo "<br><pre>Exception => " . $e->getMessage() . "</pre>\n";
        return false;
    }

    return true;
}
