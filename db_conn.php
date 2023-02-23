<?php

// connection for authentication
$sName = "localhost";
$uName = "root";
$pass = "password";
$db_name = "test_db";

try {
    $conn = new PDO(
        "mysql:host=$sName;dbname=$db_name",
        $uName,
        $pass
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
}

// connection for objects
$con = mysqli_connect("localhost", "root", "password", "test_db");

if (!$con) {
    die('Connection Failed' . mysqli_connect_error());
}
