<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <?php
  require_once('connectdb.php');
  ?>
<title>Customer Accounts</title>
<h1>Customer Accounts</h1>

</head>

<body>
<table>
        <tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Default Address</th>
        <th>Username</th>
        <th>Email</th>
        </tr>
<?php
$fulltable=$db->prepare("SELECT * FROM customerdetails");
$fulltable->execute();
while($row = $fulltable->fetch()){
    $link=$db->prepare("
    SELECT c.customer_id,c.name,c.default_address,l.username AS username, l.email AS email, l.password AS password
    FROM customerdetails c 
    JOIN logindetails l ON c.user_id=l.user_id
    WHERE customer_id={$row["customer_id"]};
    ");
    $userp=$db->prepare("
    SELECT c.customer_id,c.name,c.default_address,l.username AS username, l.email AS email, l.password AS password
    FROM customerdetails c 
    JOIN logindetails l ON c.user_id=l.user_id
    WHERE customer_id={$row["customer_id"]};
    ");
    $link->execute();
    $userp->execute();
    $userd=$userp->fetch();
    $details=json_encode($link->fetch(PDO::FETCH_ASSOC));
    echo("<tr><td>".$row["customer_id"]."</td><td>".$row["name"]."</td><td>".$row["default_address"]."</td><td>".$userd["username"]."</td><td>".$userd["email"]);
}
?>
</table>
<br>
<form name="edit-input" method="post" action="Admin-account-management.php" >

    <select id="cid" name="cid">
    <option value="default">Enter Customer ID</option>
       <?php
        $cid_query = $db->prepare("SELECT customer_id FROM customerdetails");
        $cid_query->execute();
        $customer_ids = $cid_query->fetchAll(PDO::FETCH_COLUMN);
    
        foreach ($customer_ids as $customer_id) {
            echo '<option value="' . $customer_id . '">' . $customer_id . '</option>';
        }
       
       ?>
    </select>



    <select id="edit-field" name="edit-field">
        <option value="default">Enter Field</option>
        <option value="name">Name</option>
        <option value="defualt_address">Default Address</option>
        <option value="email">Email</option>
        <option value="username">Username</option>
        <option value="password">Password</option>

    </select>

    


    <input type="text" id="edit-input" name="edit-input" placeholder="Enter edit">

    

    <input type="submit" value="sub" name="sub">

</form>
<?php
if(isset($_POST['sub'])){
$field=$_POST['edit-field'];
$cid=$_POST['cid'];
$val=$_POST['edit-input'];

if($cid=='default' ||$cid =='default'|| $val==null ){
    echo("please fill in all fields");
}else{
    $check=$db->prepare("SHOW COLUMNS FROM customerdetails LIKE '$field'");
    $check->execute();
    if($check->fetch()){
        $push=$db->prepare("UPDATE customerdetails SET $field = ? WHERE customer_id = $cid");
        $push->execute([$val]);
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    } else{
        if($field=='password'){
            $val=password_hash($val,PASSWORD_DEFAULT);
            $push=$db->prepare("
            UPDATE logindetails AS l
            INNER JOIN customerdetails AS c ON l.user_id = c.user_id
            SET l.$field = ?
            WHERE c.customer_id = $cid
            ");
            $push->execute([$val]);
            header("Location: $_SERVER[PHP_SELF]");
            exit();

        }else{
        $push=$db->prepare("
        UPDATE logindetails AS l
        INNER JOIN customerdetails AS c ON l.user_id = c.user_id
        SET l.$field = ?
        WHERE c.customer_id = $cid
        ");
        $push->execute([$val]);
        header("Location: $_SERVER[PHP_SELF]");
        exit();
        }
    }

}


}

?>

</body>