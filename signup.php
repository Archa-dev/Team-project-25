<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<title>Sign Up - SHADED</title>
<script src="https://kit.fontawesome.com/58e0ebdcbf.js" crossorigin="anonymous"></script>
<style>
html, body {         
margin: 0;
padding: 0;
font-family: "Century Gothic", sans-serif;
box-sizing: border-box;
height: 100%
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
img{
width:300px; 
height:300px;
transform: translate(48%,-35%);
}
.signup-form {
width: 85%;
max-width: 400px;
position:absolute;
top: 47%;
left: 0;
transform: translate(20%,-40%);
/* background: #fff; */
/*to change the color of login box make */
padding: 2px 2px 6px;
text-align: center;
border-radius: 10px;
box-shadow: 0px 0px 30px 5px ; 
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
  display: flex;
  flex-direction: column;
  align-items: center;
}
.input-field{
  background: #eaeaea ;
  width: 100%;
  max-width: 450px;
  margin: 5px 0;
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
  margin-bottom: 20px;
}
.btn-field button:hover{
  background-color: #07575B;
}

</style>
</head>
<body>

<!--bootstrap js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous">
        </script>



    <main class="sticky-footer-padding">

 <div class="container">
 <img id = "logo" src="shaded logo.png" alt="logo">
            <div class = "signup-form">
              <h1>Sign Up</h1>
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
               <button type="submit">Submit</button>
               <input type="hidden" name="sub" value="Sign Up">
               </div>
              <a href="login.php">Already have an account?</a>
            </form> 
</div>
      
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
      </br>
      
    </main>
    
    <script>
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
