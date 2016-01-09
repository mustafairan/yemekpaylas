<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'YemekPaylas');
define('DB_USER', 'root');
define('DB_PASSWORD', 'damniforgot');

$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());

if ($_POST) {
    session_start();
    ob_start();
    $kadi = $_POST['user'];
    $sifre = $_POST['pass'];
    $query = mysql_query("SELECT *  FROM Users where userName = '" . $_POST['user'] . "' AND pass = '" . $_POST['pass'] . "'") or die(mysql_error());
    $row = mysql_fetch_array($query);
    if ($row['userName'] == $kadi && $row['pass'] == $sifre) {

        $_SESSION['userName'] = $row['userName'];
        $_SESSION['userID'] = $row['userID'];
        //echo $_SESSION['userID'];
        echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
        header('Location: http://localhost/agproje/index.php');
    } else {

        echo "Kullanıcı adı ya da parolanız yanlış";
        echo "<br><a href='Sign-In.html'><---- geri dön</a>";
    }
}

?>