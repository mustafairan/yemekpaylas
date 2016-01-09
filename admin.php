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
define('DB_USER', 'root');
define('DB_PASSWORD', 'damniforgot');

$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());
session_start();
ob_start();
include('adminFuncs.php');
if (($_SESSION['userID'] == 1) or ($_SESSION['userID'] == 2)) {
    printRecipes();
    printComments();
} else {
    echo "bu sayfayı görmeye yetkili değilsiniz<br>";
    echo "bu sayfa sadece kullanıcı idsi 1 ve 2 olan kişiler tarafından görülebilir<br>";
    echo '<a href="http://localhost/agproje/Sign-In.html">oturum açmak için tıklayın</a>'
}
?>
</body>
</html>