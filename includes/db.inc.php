<?php
/**
 * php flags to enable error reporting
 */
ini_set('display_errors', 1);
error_reporting(~0);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


$username       = "root";
$password       = "";
$servername     = "localhost";
$dbname         = "klaver";

$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);

// Check connection
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
