<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <title>Login</title>
  <h1>Login</h1>

</head>
<style>
  body {
    font-family: "Century Gothic", sans-serif;
    background-color: #ffffff;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none; border: none;
    text-decoration: none;
    text-transform: capitalize;
    transition: .2s linear;
}
</style>
<body>
    <form method="post" action="login.php">
        <h2>Username:</h2>
        <input type="text" name="username">
        <h2>Password:</h2>
        <input type="password" name="password"><br>
        <input type="submit" name="submit">
        <input type="hidden" name="logsub" value="TRUE">
    </form>
  <form>
</br>
</br>
<a href="signup.php">Dont have an account?</a>
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
