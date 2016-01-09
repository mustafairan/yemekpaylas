<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'YemekPaylas');
define('DB_USER', 'root');
define('DB_PASSWORD', 'damniforgot');

$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());


function sendRecipe($userID, $recipeText)
{
    $query = "INSERT INTO Recipes (whoAdded,recipeText) VALUES ( '" . $userID . "','" . $recipeText . "')";

//echo $query;
    mysql_query($query);

}


?>