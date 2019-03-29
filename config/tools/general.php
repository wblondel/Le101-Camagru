<?php declare(strict_types=1);

/**
 * @param string $message
 * @param string $expectedAnswer
 *
 * @return bool
 */
function ask_user(string $message, string $expectedAnswer = "yes")
{
    echo $message . " Type '" . $expectedAnswer . "' to continue: ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    fclose($handle);
    return trim($line) == 'yes';
}
