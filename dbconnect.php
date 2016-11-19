<?php

// this will avoid mysql_connect() deprecation error.
error_reporting(~E_DEPRECATED & ~E_NOTICE);
// but I strongly suggest you to use PDO or MySQLi.

$dbHostName = 'localhost';
$dbName = 'dbmanager';
$dbUserName = 'root';
$dbPassword = '';
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'dbmanager');

$conn = mysqli_connect($dbHostName, $dbUserName, $dbPassword, $dbName);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}