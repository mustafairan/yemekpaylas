<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'YemekPaylas');
define('DB_USER','root');
define('DB_PASSWORD','damniforgot');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
/**
 * Created by PhpStorm.
 * User: mnc
 * Date: 1/4/16
 * Time: 9:45 PM
 */
//verilen ıd ye ait tarif satırını bas
//verilen id ye ait kulanıcıyı bas
//verilen id ye ait yorumu bas
function printRecipes(){
    $query="select * from Recipes";
    $result=mysql_query($query);

    while($recipeArray=mysql_fetch_array($result)){
        echo '<br>';
        echo '<table border="1"  style="width=100%"> <tr> <td>';
        echo '<form method="post" action="#"> ';
        echo 'Tarif idsi: '.$recipeArray['recipeID'].
             '<br>tarif: '. $recipeArray['recipeText'].
             '<br>ekleyen: ' .$recipeArray['whoAdded'].
             '<br>beğenenler: ' .$recipeArray['whoFaved'];
        echo '<input type="hidden" name="recipeID" value="' .$recipeArray['recipeID'].'">' ;
        echo '<input type="submit" name="submit" value="sil">';
        echo '</form>';
        echo '</td> </tr> </table>';

    }
    if (isset($_POST['submit'])){

        $query2="delete from Recipes where recipeID=".$_POST['recipeID'];
        mysql_query($query2);

    }

}

function printComments(){
    $query="select * from Comments";
    $result=mysql_query($query);

    while($commentArray=mysql_fetch_array($result)){
        echo '<br>';
        echo '<table border="1"  style="width=100%"> <tr> <td>';
        echo '<form method="post" action="#"> ';
        echo 'Yorum idsi: '.$commentArray['commentID'].
            '<br>tarif: '. $commentArray['commentText'].
            '<br>ekleyen: ' .$commentArray['whoWrote'].
            '<br>Hangi Tarif idsi için: ' .$commentArray['forRecipeID'];
        echo '<input type="hidden" name="commentID" value="' .$commentArray['commentID'].'">' ;
        echo '<input type="submit" name="submit" value="sil">';
        echo '</form>';
        echo '</td> </tr> </table>';

    }
    if (isset($_POST['submit'])){

        $query2="delete from Comments where commentID=".$_POST['commentID'];
        mysql_query($query2);

    }

}





//printRecipes();
//printComments();
?>