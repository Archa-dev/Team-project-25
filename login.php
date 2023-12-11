<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 <style>
html {
  font-size: 80%;
  scroll-behavior: smooth;
}




body {
  font-family: "Century Gothic", sans-serif;
  background-color: #ffffff;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  outline: none;
  border: none;
  text-decoration: none;
  text-transform: capitalize;
  transition: .2s linear;
  height: 100vh;
}

.login-form {
  width: 100%;
  max-width: 600px;
  padding: 20px;
  margin: auto;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
  text-align: center;
  margin-top: 12.5%;
}


.login-form h1 {
  font-size: 210%; 
  margin-bottom: 20px;
}

.login-form h2 {
  font-size: 125%; 
  text-align: left; 
}

.login-form label {
  
  margin-top: 10px;
  text-align: left; 
}

.login-form input[type="text"],
.login-form input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid grey;
  border-radius: 8px;
  font-size: 100%;
  opacity: 0.7;
}

.login-form input[type="submit"] {
  background-color: darkgrey;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  padding: 10px 20px;
  margin-top: 10px;
}

.login-form input[type="submit"]:hover {
  background-color: grey;
}


.login-form input[type="submit"]:hover {
  background-color: grey;
}

.footer {
            background-color: #fff;
            color: grey;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            font-size: 14px;
            box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.1);
        }

.social-icons a {
            margin: 0 20px;
            color: grey;
            font-size: 14px;
        }

.terms-links a {
    margin-left: 5px;
    color: #6c757d; 
    text-decoration: none;
}

.terms-links a:hover {
    text-decoration: underline; /* underlining on hover  */
    color: #000; /*hover color  */
}
 </style>
</head>
<body>
  <form method="post" action="login.php" class="login-form">
    <h1>Login</h1>
    <h2>Username:</h2>
    <input type="text" name="username">
    <h2>Password:</h2>
    <input type="password" name="password"><br>
    <input type="submit" name="submit">
    <input type="hidden" name="logsub" value="TRUE">
    <br><br>
    <a href="signup.php">Don't have an account?</a>
  </form>
  
  <div class="container-fluid">
        <footer class="footer">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-text">
                        <p>&copy;Shaded-2023 | All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="social-icons">
                        
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="terms-links">
                        <a href="#">Terms of Use</a>
                        <a href="#">Cookies Policy</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <?php
    require_once('connectdb.php');
    session_start(); 
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
          //session_start();          
          $sessionid=$db->prepare('SELECT * FROM logindetails WHERE username=?');
          $sessionid->bindParam(1,$user);
          
          $sessionid->execute();
          $Asessionid=$sessionid->fetch();
        

          $_SESSION["username"]=$user;
          $_SESSION["user_id"]=$Asessionid['user_id'];
          $_SESSION["authorization_level"]=$Asessionid['authorization_level'];
        
          echo(var_dump($_SESSION));
          

          if(  $_SESSION["authorization_level"]=="admin"){
            header("Location:admin-homepage.php");
            exit(); 
          }
          else if(  $_SESSION["authorization_level"]=="customer"){
          $Csessionid=$db->prepare('SELECT customer_id FROM customerdetails WHERE user_id=?');
          $Csessionid->bindParam(1,$_SESSION['user_id']);
          $Csessionid->execute();
          $cid=$Csessionid->fetchColumn();
          
          $_SESSION['customer_id']=$cid;
          header("Location:homepage.php");
          exit();
        
        }
        else{
          echo('incorrect password');
        }


      }else{
        echo('incorrect user');
      }

    }
  }



  }
    ?>

</body>
</html>
