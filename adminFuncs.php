<?php

/**
 * Created by PhpStorm.
 * User: mnc
 * Date: 1/4/16
 * Time: 9:45 PM
 */
function printRecipes()
{
    $query = "select * from Recipes";
    $result = mysql_query($query);

    while ($recipeArray = mysql_fetch_array($result)) {

        $query3 = "select userName from Users where userID=" . $recipeArray['whoAdded'];
        $result2 = mysql_query($query3);
        $usersArray = mysql_fetch_array($result2);

        echo '<br>';
        echo '<table border="1"  style="width=100%"> <tr> <td>';
        echo '<form method="post" action="#"> ';
        echo 'Tarif idsi: ' . $recipeArray['recipeID'] .
            '<br>tarif: ' . $recipeArray['recipeText'] .
            '<br>ekleyen: ' . $recipeArray['whoAdded'] .
            '<br>ekleyen kullanıcı ismi: ' . $usersArray['userName'] .
            '<br>beğenen kullanıcıların idleri: ' . $recipeArray['whoFaved'];
        echo '<input type="hidden" name="recipeID" value="' . $recipeArray['recipeID'] . '">';
        echo '<input type="submit" name="submit" value="sil">';
        echo '</form>';
        echo '</td> </tr> </table>';

    }
    if (isset($_POST['submit'])) {

        $query2 = "delete from Recipes where recipeID=" . $_POST['recipeID'];
        mysql_query($query2);

    }

}

function printComments()
{
    $query = "select * from Comments";
    $result = mysql_query($query);

    while ($commentArray = mysql_fetch_array($result)) {
        $query3 = "select userName from Users where userID=" . $commentArray['whoWrote'];
        $result2 = mysql_query($query3);
        $usersArray = mysql_fetch_array($result2);
        echo '<br>';
        echo '<table border="1"  style="width=100%"> <tr> <td>';
        echo '<form method="post" action="#"> ';
        echo 'Yorum idsi: ' . $commentArray['commentID'] .
            '<br>yorum: ' . $commentArray['commentText'] .
            '<br>ekleyen idsi: ' . $commentArray['whoWrote'] .
            '<br>ekleyen kullanıcı adı: ' . $usersArray['userName'] .
            '<br>Hangi Tarif idsi için: ' . $commentArray['forRecipeID'];
        echo '<input type="hidden" name="commentID" value="' . $commentArray['commentID'] . '">';
        echo '<input type="submit" name="submit" value="sil">';
        echo '</form>';
        echo '</td> </tr> </table>';

    }
    if (isset($_POST['submit'])) {

        $query2 = "delete from Comments where commentID=" . $_POST['commentID'];
        mysql_query($query2);

    }

}

?>