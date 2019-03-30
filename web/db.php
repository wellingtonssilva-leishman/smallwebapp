<?php

// Fucntion to open DB connection
function connect(){

    // Set DB parameters
    $servername = "localhost";
    $username = "swa";
    $password = "smallwebapp";

    // Try to open DB connection
    try {
        $db = new PDO("mysql:host=$servername;dbname=smallwebapp", $username, $password);
        // Set ATTR_ERRORMODE to Throw exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Set ATTR_EMULATE_PREPARES to use native prepared statements
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // Return connection
        return $db;
    }

    // Catch exception and return an error message
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }    
}

?>
