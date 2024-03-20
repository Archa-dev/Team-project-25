<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <?php
  require_once('connectdb.php');
  ?>
<title>Account approval</title>
<h1>Account Approval</h1>

</head>

<body>

<table>
        <tr>
        <th>Username</th>
        <th>Email</th>
        </tr>
<?php
$fulltable=$db->prepare("SELECT * FROM pending_admin_accounts");
$fulltable->execute();
while($row = $fulltable->fetch()){
    $link=$db->prepare("
    SELECT * FROM pending_admin_accounts
    WHERE pending_user_id={$row["pending_user_id"]};
    ");
    $userp=$db->prepare("
    SELECT * FROM pending_admin_accounts
    WHERE pending_user_id={$row["pending_user_id"]};
    ");
    $link->execute();
    $userp->execute();
    $userd=$userp->fetch();
    $details = json_encode(array(
        "username" => $row["username"],
        "email" => $row["email"],
        "pending_user_id" => $row["pending_user_id"],
        "password"=> $row["password"]
    ));




    echo("<tr><td>".$row["username"]."</td><td>".$row["email"]."</td><td>"." <form action='Admin-account-approval.php' method='post'>"."<button type='submit' class='button' name='data_link' data-link='$details'>"."<input type='hidden' name='data_link' value='$details'>"."approve"."</button>"."</form>"."</td><td>"." <form action='Admin-account-approval.php' method='post'>"."<button type='submit' class='button' name='data_link2' data-link='$details'>"."<input type='hidden' name='data_link2' value='$details'>"."refuse"."</button>"."</form>");
}
?>
</table>
    
<br>

<?php
if(isset($_POST['data_link'])){
$details = json_decode($_POST['data_link'], true);
$user=$details["username"];
$email=$details["email"];
$pass=$details["password"];
$id=$details["pending_user_id"];

$rej=$db->prepare("insert into logindetails (username,password,email) value (?,?,?)");
$rej->bindParam(1,$user);
$rej->bindParam(2,$pass);
$rej->bindParam(3,$email);

$rej->execute();

$crej=$db->prepare("insert into customerdetails (user_id) value (?)");
$crej->bindParam(1,$id);
$crej->execute();

$del=$db->prepare("DELETE FROM pending_admin_accounts WHERE pending_user_id = ?");
$del->bindParam(1,$id);
$del->execute();

header("Location: $_SERVER[PHP_SELF]");
exit();
       
}
if(isset($_POST['data_link2'])){
$details = json_decode($_POST['data_link2'], true);
$user=$details["username"];
$email=$details["email"];
$pass=$details["password"];
$id=$details["pending_user_id"];

$dro=$db->prepare("DELETE FROM pending_admin_accounts WHERE pending_user_id = ?");
$dro->bindParam(1,$id);
$dro->execute();

header("Location: $_SERVER[PHP_SELF]");
exit();
           
    }
 

?>

</body>
