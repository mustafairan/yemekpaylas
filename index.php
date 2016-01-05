<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>anasayfa</title>
</head>
<body>
<a href="addRecipe.php">addrecipe.php</a><br>
<a href="connectivity-sign-up.php">connectivity-sign-up.php.php</a><br>
<a href="connectivity.php">connectivity.php</a><br>
<a href="recipeFuncs.php">recipefuncs.php</a><br>
<a href="sign-up.html">sign-up.html</a><br>
<a href="Sign-In.html">Sign-In.html</a><br>


<?php
session_start();
ob_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'YemekPaylas');
define('DB_USER','root');
define('DB_PASSWORD','damniforgot');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
function favNumber($recipeID){

    $query1="select whoFaved from Recipes where recipeID= ". $recipeID ;

    $result=mysql_query($query1);
    $favs=mysql_fetch_array($result);



    $item = explode("%", $favs['whoFaved']);
    return (count($item)-1);



}
function favIt($recipeID){

    $query1="select whoFaved from Recipes where recipeID= ". $recipeID ;

    $result=mysql_query($query1);
    $old=mysql_fetch_array($result);
    //echo $old[0];

    $query2="update Recipes set whoFaved= '".$old[0] ."%". $_SESSION['userID']  ."' where recipeID= $recipeID" ;


    mysql_query($query2);
}


function buildForm()
{

    $query1 = mysql_query("select recipeID from Recipes ");
    $IDs = [];
    $i = 0;
    while ($ID = mysql_fetch_array($query1)) {
        $IDs[$i] = $ID['recipeID'];
        $i++;
    }

    foreach ($IDs as $eachID) {

    //echo $eachID;
        $query2 = "select recipeText from Recipes where recipeID=" . $eachID;
        $result = mysql_query($query2);
        $recipeText = mysql_fetch_array($result);


        echo '<br><br><br><br>
<table border="1px"  style="width=100%" > <tr><td>'.
            $recipeText['recipeText']
        .'</td></tr></table>';

        echo '
    <form method="post" action="#">



    <textarea name="commentText" >
    </textarea>
    <input type="hidden" name="recipeID" value="' . $eachID . '">
    Beğen<input type="checkbox" name="fav" >
    <input type="submit" name="submit" value="Tamam">


    </form>
    ';
        //print fav count
        if (favNumber($eachID)){
        echo favNumber($eachID) . " kisi bu tarifi begendi" . "<br>";}

        //print comments
        $query4="select * from Comments where forRecipeID=".$eachID;

        $result=mysql_query($query4);
        while ($commentArray=mysql_fetch_array($result))
        {
            $query5="select userName from Users where userID=".$commentArray['whoWrote'];
            $result2=mysql_query($query5);
            $userNameArray=mysql_fetch_array($result2);

            echo "<b>". $userNameArray['userName']. " </b> demis ki:<br>";

            echo '
            <table border="1"  style="width=100%">
  <tr>
    <td>'. $commentArray['commentText'] .'</td>
  </tr>
  </table>
  <br>';
            //echo " " $commentArray['commentText']. " " "<br>";

        }


     }

    if (isset($_POST['submit'])) {

        $query3 = "Insert Into Comments (whoWrote,commentText,forRecipeID) Values ( ". $_SESSION['userID']  .",'" . $_POST['commentText'] . " ',".  $_POST['recipeID'] ." )";
        echo $query3;
        mysql_query($query3);
        if ($_POST['fav']){


favIt($_POST['recipeID']);

        }


    }
}



//en çok favlanan 10 tarif //ekleyen ismi -text - fav sayısı
//en son eklenen 10 tarif //ekleyen ismi -text - fav sayısı

//yorum yapma imkanı

echo "anasayfa";
buildForm();
//header('Location: http://localhost/agproje/Sign-In.html');



//son eklenen tarifleri altına yorum yapılabilecek şekilde bas
//addComments fonksiyonunu kullan


?>


</body>
</html>