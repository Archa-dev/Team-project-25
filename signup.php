<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <title>Signup</title>
  <h1>Signup</h1>

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
<script>
  const savedEmails = [];
  const savedPasswords = [];


function signupSuccess(){
      var email = document.getElementsByName("inputEmail")[0].value;                  //takes values from the html form
      var password = document.getElementsByName("inputPassword")[0].value;
      var user=document.getElementsByName("Username")[0].value;
      var name=document.getElementsByName("Name")[0].value;

      if (email.length > 0 && user.length > 0 && name.length > 0 && user.length > 0) {
          if (password.length > 5){                    // currently trusts the user to input a valid email, probably should be changed
              savedEmails.push(email);
              savedPasswords.push(password);           // to be replaced with appending saved details to the accounts database
              return true;
          }
          else{
              alert("Invalid password, please make sure password is 6+ characters");
              return false;
          }
      }
      else{
          alert("Invalid email/username/name");
          return false;
      }

  }
    </script>
    <form method="post" action="signup.php" onsubmit="return signupSuccess()" class="signup-form">
        <h2>Email:</h2>
        <input type="email" name="inputEmail">
        <h2>Username:</h2>
        <input type="text" name="Username">
        <h2>Name:</h2>
        <input type="text" name="Name">
        <h2>Address (optional):</h2>
        <input type="text" name="Address">
        <h2>Password:</h2>
        <p>Please make sure password is 6+ characters</p>
        <input type="password" name="inputPassword"><br>
        <input type="submit">
        <input type="hidden" name="sub">
    </form>
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
</body>
</html>
