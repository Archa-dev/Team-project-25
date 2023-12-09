<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<form action="logout-button.php" method="post"><!--CHANGE FORM ACTION TO CURRENT FILE-->
    <button name="logout">Logout</button>
</form>
<?php
if(isset($_POST['logout'])){
session_start();

session_unset();

session_destroy();

header("Location:login.php");
exit();
}
?>

</body>
</html>