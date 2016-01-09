<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarif ekle</title>
</head>
<body>


<form method="POST" action="#">

    <textarea name="recipeText" maxlength="1000"></textarea>
    <input id="button" type="submit" name="submit" value="Gonder">
</form>
<a href="http://localhost/agproje/index.php">anasayfaya dönmek için tıklayın</a>
<?php

include('recipeFuncs.php');

session_start();
if (!empty($_POST['submit'])) {

    sendRecipe($_SESSION['userID'], $_POST['recipeText']);

}

?>

</body>
</html>