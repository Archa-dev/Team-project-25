<?php
require_once('connectdb.php');
//session_start(); 
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
      //session_start();          
      $sessionid=$db->prepare('SELECT * FROM logindetails WHERE username=?');
      $sessionid->bindParam(1,$user);
      
      $sessionid->execute();
      $Asessionid=$sessionid->fetch();

      $_SESSION["username"]=$user;
      $_SESSION["user_id"]=$Asessionid['user_id'];
      $_SESSION["authorization_level"]=$Asessionid['authorization_level'];

      if($_SESSION["authorization_level"]=="admin"){
        header("Location:admin-homepage.php");
        exit(); 
      }
      else if($_SESSION["authorization_level"]=="customer"){
        $Csessionid=$db->prepare('SELECT customer_id FROM customerdetails WHERE user_id=?');
        $Csessionid->bindParam(1,$_SESSION['user_id']);
        $Csessionid->execute();
        $cid=$Csessionid->fetchColumn();
        
        $_SESSION['customer_id']=$cid;
        header("Location:homepage.php");
        exit();
      }
    }else{
      echo('incorrect password');
    }
  }else{
    echo('incorrect user');
  }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - SHADED</title>
  <script src="https://kit.fontawesome.com/58e0ebdcbf.js" crossorigin="anonymous"></script>
  
 <style>
html, body{
  margin: 0;
  padding: 0;
  font-family: "Century Gothic", sans-serif;
  box-sizing: border-box;
  height: 100%;
}
body{
            margin: 0;
            padding: 0;
            position: relative;
        }

.container{
  width : 100%;
  height : 100vh;
  background-image:  url(images/8.jpeg);
  /* linear-gradient(rgba(0, 59, 70, 0.8), rgba(0, 59, 70, 0.8)) */ /* If want to color the background image Green */
  background-position: centre;
  background-size: cover;
  position: relative;
  z-index: 0;
  
}
.form-box{
  width: 80%;
  max-width: 400px;
  position:absolute;
  top: 50%;
  left: 0;
  transform: translate(20%,-50%);
  padding: 4px 2px 6px;
  text-align: center;
  border-radius: 10px;
  box-shadow: 0px 0px 30px 5px ; 
  
}
.form-box h1{
  font-size: 30px;
  margin-bottom: 60px;
  color: #003B46;
  position: relative;
}
.form-box h1::after{
  content: '';
  width: 30px;
  height: 4px;
  border-radius: 3px;
  background: #003B46;
  position: absolute;
  bottom: -12px;
  left: 50%;
  transform: translateX(-50%);
}
.form-box a{
  color: #003B46;
}
.form-box a:hover{
  color: #07575B;
}
.input-group{
  height : 150px;
}
.input-field{
  background: #eaeaea;
  margin: 15px 0;
  border-radius: 3px;
  display: flex;
  align-items: center;
}
input{
  width: 100%;
  background: transparent;
  border: 0;
  outline: 0;
  padding: 18px 15px ;
}
.input-field i{
  margin-left: 15px;
  color: #999;
}
.btn-field {
  width : 100%;
  display: flex;
  justify-content:center;
}
.btn-field button{
  flex-basis: 48%;
  background: #003B46;
  color: #fff;
  height: 40px;
  border-radius: 20px;
  border : 0 ;
  outline: 0;
  cursor: pointer;
  transition: backgroud 1s;
  margin-bottom: 50px;
}
.btn-field button:hover{
  background-color: #07575B;
}

.footer {
  background: rgba(255, 255, 255, 0.6);
            color: grey;
            padding: 0px;
            height: 1cm;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            font-size: 12px;
            box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.1);
        }

.social-icons a {
            margin: 0 20px;
            color: grey;
            font-size: 12px;
        }

.terms-links a {
    margin-left: 5px;
    color: #6c757d; 
    text-decoration: none;
}

 </style>
</head>
<body>
  <div class = "container">
    <div class = "form-box">
      <h1>Login</h1>
      <form method="post" action="login.php" class="login-form">
        <div class = "input-group">
          <div class = "input-field">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="username" placeholder="Username">
          </div>

          <div class = "input-field">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password">
          </div>
        </div>
        <div class="btn-field">
          <button type = "submit"  >Log In</button>
          <input type="hidden" name="logsub" value="TRUE">
        </div>
        <a href="signup.php">Don't have an account?</a>
       </form>
    </div>
  </div>
</body>
</html>
