<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <title>Login</title>
  <h1>Login</h1>

</head>

<body>
    <form method="post" action="login.php">
        <h2>Username:</h2>
        <input type="text" name="username">
        <h2>Password:</h2>
        <input type="text" name="password"><br>
        <input type="submit" name="submit">
        <input type="hidden" name="logsub" value="TRUE">
    </form>

    
    <?php
    require_once('connectdb.php');
    if(isset($_POST['logsub'])){
      $user=$_POST['username'];
      $pass=$_POST['password'];
    
    
    if($user==null || $pass==null){
      echo("enter username and password");
    }
    else{
      $login=$db->prepare('SELECT password FROM logindetails WHERE username=?');
      $login->bindParam(1,$user);

      $login->execute();
      $Apass=$login->fetch();

      if($login->rowCount()>0){
        if(password_verify($pass,$Apass['password'])){
          echo('success');
          
          $sessionid=$db->prepare('SELECT user_id FROM logindetails WHERE username=?');
          $sessionid->bindParam(1,$user);
          
          $sessionid->execute();
          $Asessionid=$sessionid->fetch();

          session_start();
          $_SESSION["username"]=$user;
          $_SESSION["user_id"]=$Asessionid['user_id'];
          
          header("Location:index.php");
          exit();
        
        }else{
          echo('incorrect password');
        }


      }else{
        echo('incorrect user');
      }

    }

  }
    ?>

</body>
</html>
