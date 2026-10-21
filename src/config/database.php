<?php
/*
 * DATABASE CONFIGURATION FILE
 * This script creates a connection to the MySQL database using PDO (PHP Data Objects).
 * It also creates the necessary parameters such as host, database name, username, and password.
 */

define('DB_HOST', 'localhost'); // Database host
define('DB_USER', 'root'); // Database username - the default user name for local XAMPP is "root"
define('DB_PASS', ''); // Database password - the default password is ""
define('DB_NAME', 'InventoryDB'); // Database name

function getDatabaseConnection() {
    try {
        //Setting Up the Data source name (DSN) for the PDO connection
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";


        //Configuring the PDO connection for Error handling & Safety
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch results as associative arrays
            PDO::ATTR_EMULATE_PREPARES => false, // Use native prepared statements if possible
        ];

        return new PDO($dsn, DB_USER, DB_PASS, $options);
        
    } catch (PDOException $exception) {
        //STOPS Execution and displays the error message if the connection fails
        die("❌ Critical Database Connection Failure: " . $exception->getMessage());
        return null;
    }
}
