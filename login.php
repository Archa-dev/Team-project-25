<?php
    require_once('connectdb.php');
    session_start(); 
    if(isset($_POST['logsub'])){
      $user=$_POST['username'];
      $pass=$_POST['password'];


    if($user==null || $pass==null){
      echo("<script>alert('Please enter username and password');</script>");
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
            header("Location:admin.php");
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
          echo("<script>alert('Incorrect username or password');</script>");
        }
      } else {
        echo("<script>alert('Incorrect username or password');</script>");
      }

    }
  }



  }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://kit.fontawesome.com/58e0ebdcbf.js" crossorigin="anonymous"></script>
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
}

@media screen and (max-width: 768px) {
  .container {
    flex-direction: column; /* Switch to column layout for smaller screens */
    align-items: center; /* Center align items */
  }

  .left-half {
    order: 2; /* Move left-half container below the right-half container */
    width: 100%; /* Full width */
  }

.logo{
  text-align: center;
}

  .logo img {
    width: 100%; /* Adjust logo width for smaller screens */
  }

  .form-box {
    width: 90%; /* Adjust form width for smaller screens */
    max-width: 300px; /* Set maximum width for form */
    margin-top: 20px; /* Add margin to separate logo and form */
    text-align: center;
  }
}

  
.container {
  display: flex;
  height: 100vh;
}

.logo {
  text-align: center;
  position: absolute;
  top: 20%;
  left: 12%;
  transform: translateY(-50%);
  margin-bottom: 15px;

}

.logo img {
  width: 400px; /* Adjust width as needed */
  height: auto; /* Maintain aspect ratio */
}

.left-half,
.right-half {
  flex: 1;
  padding: 0;
}

/* Style for the right half slideshow of images */
.right-half {
  position: relative; /* Ensure the slideshow is positioned relative to the right-half div */
  display: flex;
  align-items: right;
  top: 0;
  right: 0;
  justify-content: flex-end;
  background-color: #003B46;
  overflow: hidden;
}

.left-half{
  left: 0;
}

.right-half{
  box-shadow: 0 0 12px #1c7a7f;
  right: 0;
}

.slideshow {
  position: absolute; /* Position the slideshow absolutely within the right-half div */
  top: 0;
  left: 0;
  height: auto; /* Fill the entire height of the right-half div */
  width: 100%; /* Fill the entire width of the right-half div */
  animation: slide-up 55s linear infinite;
}

.slideshow image {
  position: absolute;
  opacity: 0;
  width: 100%;
  height: auto;
  transition: opacity 0s ease-in-out;
  top: 0;
  left: 0;
  object-fit: contain;
}

@keyframes slide-up {
  0% {
    transform: translateY(0);
  }
  100% {
    transform: translateY(-100%);
  }
  100.1% {
    transform: translateY(0);
  }
}

.slideshow img.active {
  opacity: 1;
}

.form-box {
  width: 100%;
  max-width: 400px;
  padding: 20px;
  margin: auto;
  border-radius: 10px;
  box-shadow: 0 0 12px #1c7a7f;
  text-align: center;
  position: absolute;
  top: 60%;
  left: 12%;
  transform: translateY(-50%);
}


.login-form h1 {
  font-size: 30px;
  margin-bottom: 30px;
  color: #003B46;
  font-weight: bold;
  position: relative;
}

.login-form h1::after{
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

.login-form a{
  color: #003B46;
  font-weight: bold;
}

.login-form a:hover{
  color: #1c7a7f;
}

.input-field {
  width: 100%;
  background: #eaeaea;
  margin: 5px 0;
  border-radius: 3px;
  align-items: center;
  display: flex;
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
  width: 100%;
  display: flex;
  justify-content: center;
  margin-top: 20px;
  margin-bottom: 10px; /* Add margin to create space between buttons */
}

.btn-field button {
  width: 70%;
  background: #003B46;
  color: #fff;
  height: 40px;
  border-radius: 5px;
  font-size: 15px;
  border: 0;
  outline: 0;
  cursor: pointer;
  transition: background 1s;
  margin-bottom: 10px;
  font-weight: bold;
}

.btn-field button:hover {
  background-color: #07575B;
}

.btn-field button:not(:last-child) {
  margin-bottom: 10px; /* Add margin between buttons */
}
 </style>

</head>
<body>

<div class="container">
  <div class="left-half">

  <div class="logo">
  <img src="images/Logo 1.png" alt="Logo">
  </div>

<div class="form-box">
    <form method="post" action="login.php" class="login-form">
        <h1>LOGIN</h1>
        <div class="input-group">
            <div class="input-field">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" placeholder="Username">
            </div>
        </div>

        <div class="input-group">
            <div class="input-field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password">
            </div>
        </div>

        <div class="btn-field">
            <button type="submit">LOGIN</button>
            <input type="hidden" name="logsub" value="TRUE">
        </div>

        <a href="signup.php">Don't have an account?</a>
        <br>
        <a href="Admin-signup.php">Want to create an admin account?</a>
    </form>
</div>
  </div>

<div class="right-half">
<div class="slideshow">
<img class="active" src="images/login 1.jpg" alt="Image 1">
        <img src="images/login 2.jpg" alt="Image 2">
        <img src="images/login 3.jpg" alt="Image 3">
        <img src="images/login 4.jpg" alt="Image 4">
        <img src="images/login 5.jpg" alt="Image 5">
            </div>
</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    var slides = document.querySelectorAll(".slide");
    var currentSlide = 0;

    function nextSlide() {
        slides[currentSlide].classList.remove("active");
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add("active");
    }

    setInterval(nextSlide, 4000); // Change slide every 4 seconds
});
  </script>

</body>
</html>
