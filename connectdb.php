<?php
$db_host='localhost';
$db_name='team_project_year_2';
$username='root';
$password='';

try {
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password); 
    //echo("successfully connected<br>");
}catch(PDOException $ex){
    echo("failed to connect");
    echo($ex->getMessage());
    exit;
}
?>