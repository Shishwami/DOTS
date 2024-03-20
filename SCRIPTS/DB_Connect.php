<?php

$servername = "localhost";
$database = "DOTS";
$username = "root";
$password = "";


$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $database
);


if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

function getPdoConnection()
{

    global $servername, $database, $username, $password;

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // Set PDO to throw exceptions on errors
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die ("Connection failed: " . $e->getMessage());
    }
}


?>