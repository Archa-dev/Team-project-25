<?php
    if(isset($_POST['sub'])){
    require_once('connectdb.php');
    $email=$_POST['inputEmail'];
    $user=$_POST['Username'];
    $pass=$_POST['inputPassword'];
    $pass=password_hash($pass,PASSWORD_DEFAULT);
    
    $check=$db->prepare("SELECT * FROM logindetails WHERE username=?");
    $check->bindParam(1,$user);
    $check->execute();

    $check2=$db->prepare("SELECT * FROM pending_admin_accounts WHERE username=?");
    $check2->bindParam(1,$user);
    $check2->execute();

    if($check->rowCount()>0 && $check2->rowCount()>0){
      echo ("Username already exists");
    }else{
    $rej=$db->prepare("INSERT INTO pending_admin_accounts (username,password,email)value(?,?,?)");
    $rej->bindParam(1,$user);
    $rej->bindParam(2,$pass);
    $rej->bindParam(3,$email);
    if($rej->execute()){
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Signup</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="images/Updatedfavicon.png" type="image/png">
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
  top: 16%;
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


.form-box h1 {
  font-size: 30px;
  margin-bottom: 30px;
  color: #003B46;
  font-weight: bold;
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
  font-weight: bold;
}

.form-box a:hover{
  color: #1c7a7f;
}

.input-field-group {
    display: flex;
    text-align: center;
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

<!--bootstrap js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous">
        </script>

<div class="container">
  <div class="left-half">

  <div class="logo">
  <img src="images/Logo 1.png" alt="Logo">
  </div>

            <div class = "form-box">
            <form method="post" action="Admin-signup.php" onsubmit="return signupSuccess()" >
              <h1>ADMIN SIGN UP</h1>
              <div class = "input-group">

                <div class = "input-field">
                  <i class="fa-solid fa-envelope"></i>
                  <input type="email" name="inputEmail" placeholder="Email">
                </div>

                <div class = "input-field">
                  <i class="fa-solid fa-user"></i>
                  <input type="text" name="Username" placeholder="Username">
                </div>

                <div class = "input-field">
                   <i class="fa-solid fa-lock"></i>
                   <input type="password" name="inputPassword" placeholder= "Password (6+ characters)">
                </div>
              </div>

               <div class="btn-field">
               <button type="submit">Submit</button>
               <input type="hidden" name="sub" value="Sign Up">
               </div>
              <a href="login.php">Already have an account?</a>
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

    <script>
    const savedEmails = [];
    const savedPasswords = [];

    function signupSuccess() {
        var email = document.getElementsByName("inputEmail")[0].value;
        var password = document.getElementsByName("inputPassword")[0].value;
        var user = document.getElementsByName("Username")[0].value;

        if (email.length > 0 && user.length > 0) {
            if (password.length >= 6) {
                savedEmails.push(email);
                savedPasswords.push(password);
                return true;
            } else {
                alert("Invalid password, please make sure password is 6+ characters");
                return false;
            }
        } else {
            alert("Invalid email/username");
            return false;
        }
    }
</script>
</body>
</html>
