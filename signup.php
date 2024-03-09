<?php
    if(isset($_POST['sub'])){
    require_once('connectdb.php');
    $email=$_POST['inputEmail'];
    $user=$_POST['Username'];
    $name=$_POST['Name'];
    $pass=$_POST['inputPassword'];
    $add=$_POST['Address'];
    $auth="customer";
    $pass=password_hash($pass,PASSWORD_DEFAULT);
    
    $check=$db->prepare("SELECT * FROM logindetails WHERE username=?");
    $check->bindParam(1,$user);
    $check->execute();

    if($check->rowCount()>0){
      echo ("Username already exists");
    }else{
    $rej=$db->prepare("INSERT INTO logindetails (username,password,email,authorization_level)value(?,?,?,?)");
    $rej->bindParam(1,$user);
    $rej->bindParam(2,$pass);
    $rej->bindParam(3,$email);
    $rej->bindParam(4,$auth);
    if($rej->execute()){
      $id=$db->lastInsertId();
      $cdetails=$db->prepare("INSERT INTO customerdetails(user_id,name,default_address) value (?,?,?)");
      $cdetails->bindParam(1,$id);
      $cdetails->bindParam(2,$name);
      $cdetails->bindParam(3,$add);
      $cdetails->execute();
      echo("Successful");
    }else{
      echo ("Unsuccessful");
    }
    }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Sign Up - SHADED</title>
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
  display: flex;
    flex-direction: row;
    margin-bottom: 20px;
    height: 100%;
    position: relative;
}


#logo {
   height: 11%;
    width: 50%; /* Adjust the width as needed */
    max-width: 420px; /* Set maximum width to match the form box */
    margin-top: 70px;
    display: block; /* Ensure it behaves as a block element */
    margin-bottom: 20px; /* Add some space between the logo and the form box */
    padding-left: 170px;
}
.signup-form{
  width: 85%;
  height: 70%;
  max-width: 400px;
  position: absolute;
  top: 47%;
  left: 11%; /* Adjusted to position in the middle of the left half */
  transform: translateY(-30%);
  padding: 2px 2px 6px;
  text-align: center;
  border-radius: 10px;
  box-shadow: 0px 0px 30px 5px #003b46;
}
.signup-form h1{
  font-size: 30px;
  margin-bottom: 20px;
  color: #003B46;
  position: relative;
}
.signup-form h1::after{
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
.signup-form a{
  color: #003B46;
}
.signup-form a:hover{
  color: #07575B;
}
.input-group{
  height : 350px;
}
.input-field{
  background: #eaeaea;
    max-width: 450px;
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
  
}

.btn-field button {
  width: 48%;
  background: #003B46;
  color: #fff;
  height: 40px;
  border-radius: 20px;
  font-size: 15px;
  border: 0;
  outline: 0;
  cursor: pointer;
  transition: background 1s;
  margin-bottom: 20px;
}

.btn-field button:hover {
  background-color: #07575B;
}

.btn-field button:not(:last-child) {
  margin-bottom: 10px; /* Add margin between buttons */
}

#slideshow {

    width: 50%;
    height: 100vh;
    overflow: hidden;
    position: absolute;
    right: 0px;
}

.slide {
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

 </style>
</head>
<body>

  <div class = "container">
  <div id="slideshow">
            <div class="slide">
                <img src="images/login 1.jpg 1" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="images/login 2.jpg" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="images/login 3.jpg" alt="Slide 3">
            </div>
            <div class="slide">
                <img src="images/login 4.jpg" alt="Slide 4">
            </div>
            <div class="slide">
                <img src="images/login 5.jpg" alt="Slide 5">
            </div>
  </div>

  <img id="logo" src="images/logo.png" alt="Logo">

  <div class = "signup-form">
              <h1>SIGN UP</h1>
            <form method="post" action="signup.php" onsubmit="return signupSuccess()" >
              <div class = "input-group">

                <div class = "input-field">
                  <i class="fa-solid fa-envelope"></i>
                  <input type="email" name="inputEmail" placeholder="Email" class="form-control" required>
                </div>
                <div class = "input-field">
                  <i class="fa-solid fa-user"></i>
                  <input type="text" name="Username" placeholder="Username" class="form-control" required>
                </div>
                <div class = "input-field">
                  <i class="fa-solid fa-user"></i>
                  <input type="text" name="Name" placeholder= "Name" class="form-control" required>
                </div>
                <div class = "input-field">
                <i class="fa-solid fa-house"></i>
                  <input type="text" name="Address" placeholder= "Address (optional)" class="form-control">
                </div>
                <div class = "input-field">
                   <i class="fa-solid fa-lock"></i>
                   <input type="password" name="inputPassword" placeholder= "Password (6+ characters)"class="form-control" required>
                </div>

              </div>
               <div class="btn-field">
               <button type="submit">SUBMIT</button>
               <input type="hidden" name="sub" value="Sign Up">
               </div>
              <a href="login.php">Already have an account?</a>
            </form> 

       
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
const savedEmails = [];
    const savedPasswords = [];

    function signupSuccess() {
        var email = document.getElementsByName("inputEmail")[0].value;
        var password = document.getElementsByName("inputPassword")[0].value;
        var user = document.getElementsByName("Username")[0].value;
        var name = document.getElementsByName("Name")[0].value;

        if (email.length > 0 && user.length > 0 && name.length > 0) {
            if (password.length >= 6) {
                savedEmails.push(email);
                savedPasswords.push(password);
                return true;
            } else {
                alert("Invalid password, please make sure password is 6+ characters");
                return false;
            }
        } else {
            alert("Invalid email/username/name");
            return false;
        }
    }
  </script>
</body>
</html>
