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
  overflow: hidden;
}
body{
            margin: 0;
            padding: 0;
            position: relative;
              background-color: #fff;

        }

.container{
  /* width : 100%;
  height : 100%; */
  /* background-image:  url(images/8.jpeg); */
  /* linear-gradient(rgba(0, 59, 70, 0.8), rgba(0, 59, 70, 0.8)) */ /* If want to color the background image Green */
  /* background-position: centre;
  background-size: cover; */
  /* position: relative;
  z-index: 0; */
  display: flex;
    flex-direction: row;
    margin-bottom: 20px;
    height: 100%;
    position: relative;
}


#logo {
  height: 10%;
    width: 45%; /* Adjust the width as needed */
    max-width: 400px; /* Set maximum width to match the form box */
    margin-top: 70px;
    display: block; /* Ensure it behaves as a block element */
    margin-bottom: 20px; /* Add some space between the logo and the form box */
    padding-left: 170px;
}
.form-box{
  width: 50%;
  max-width: 400px;
  position: absolute;
  top: 50%;
  left: 11%; /* Adjusted to position in the middle of the left half */
  transform: translateY(-40%);
  padding: 4px 2px 6px;
  text-align: center;
  border-radius: 10px;
  box-shadow: 0px 0px 30px 5px #003b46;
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
  width: 100%;
  display: flex;
  justify-content: center;
  margin-bottom: 20px; /* Add margin to create space between buttons */
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
}

.btn-field button:hover {
  background-color: #07575B;
}

.btn-field button:not(:last-child) {
  margin-bottom: 10px; /* Add margin between buttons */
}

#slideshow {
    /* width: 100%;
    height: 1000px;
    overflow: hidden;
    position: relative;
    margin-top: 10%;
    right: 0px; */
    width: 50%;
    height: 100vh;
    overflow: hidden;
    position: absolute;
    right: 0px;
    /* overflow: hidden;
    position: relative; */
    /* margin-top: 50%;
    margin-bottom: 20%;
    margin-left: 20% ;
     */
}

.slide {
    /* width: 100%;
    height: 100%;
    position: absolute; */
    /* animation: slideShow 12s infinite;
    opacity: 0;
    width: 500px;
    height: 500px; */
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 1s ease-in-out;
    top: 0;
  left: 0;
  object-fit: contain;
  
    
}
.slide.active {
    opacity: 1;
}

@keyframes changeSlide {
    0% { opacity: 0; }
    20% { opacity: 1; }
    80% { opacity: 1; }
    100% { opacity: 0; }
}

/* .slide:nth-child(1) {
    animation-delay: 0s;
}

.slide:nth-child(2) {
    animation-delay: 4s;
}

.slide:nth-child(3) {
    animation-delay: 8s;
}

@keyframes slideShow {
    0% {opacity: 0;}
    8% {opacity: 1;}
    33% {opacity: 1;}
    41% {opacity: 0;}
    100% {opacity: 0;}
} */
 </style>
</head>
<body>

  <div class = "container">
  <!-- <img id = "logo" src="shaded logo.png" alt="logo" style="width:150px; height : 150px; top:0px;"> -->

  <div id="slideshow">
            <div class="slide">
                <img src="login 1.jpg" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="login 2.jpg" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="login 3.jpg" alt="Slide 3">
            </div>
            <div class="slide">
                <img src="login 4.jpg" alt="Slide 4">
            </div>
            <div class="slide">
                <img src="login 5.jpg" alt="Slide 5">
            </div>
  </div>

  <img id="logo" src="logo.png" alt="Logo">

    <div class = "form-box">
      <h1>LOGIN</h1>
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
          <button type = "submit"  >LOGIN</button>
          <input type="hidden" name="logsub" value="TRUE">
        </div>

        <div class="btn-field">
  <button type="submit">ADMIN LOGIN</button>
</div>
        <a href="signup.php">Don't have an account?</a>
       </form>
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