<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>admin sayfası</title>
</head>
<body>

<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'YemekPaylas');
define('DB_USER','root');
define('DB_PASSWORD','damniforgot');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
session_start();
ob_start();
include ('adminFuncs.php');

printRecipes();
printComments();
?>
</body>
</html>