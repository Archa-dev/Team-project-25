<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <title>Login</title>
  <h1>Login</h1>

</head>

<body>
    <script>
      const cyrb53a = function(str, seed = 0) {                   //hashing algorithm from https://github.com/bryc/code/blob/master/jshash/experimental/cyrb53.js
    let h1 = 0xdeadbeef ^ seed, h2 = 0x41c6ce57 ^ seed;
    for(let i = 0, ch; i < str.length; i++) {
      ch = str.charCodeAt(i);
      h1 = Math.imul(h1 ^ ch, 0x85ebca77);
      h2 = Math.imul(h2 ^ ch, 0xc2b2ae3d);
    }
    h1 ^= Math.imul(h1 ^ (h2 >>> 15), 0x735a2d97);
    h2 ^= Math.imul(h2 ^ (h1 >>> 15), 0xcaf649a9);
    h1 ^= h2 >>> 16; h2 ^= h1 >>> 16;
      return 2097152 * (h2 >>> 0) + (h1 >>> 11);
  };
    </script>
    <script>
      const savedPassword = [6629065793880233];
const savedEmail = ["test@test.com"];

function checkLogin(){
var email = document.getElementsByName("inputEmail")[0].value;                  //takes values from the html form
var password = document.getElementsByName("inputPassword")[0].value;

if (savedEmail.includes(email)){
    if (savedPassword.includes(cyrb53a(password))){  //needs to be changed to if password is equal to the password tied to the email from db
        alert("Login Successful");
        window.location.replace("https://google.com")  //temporary redirect to google as a placeholder until I know the path for mainpage
        return true;                                  //also needs to send the account details to the main page 

    }
    else{
        alert("Password Incorrect, Please Try Again");
        return false;
    }
}
else{
    alert("Email Incorrect, Please Try Again");
    return false;
}

}
    </script>
    <form onsubmit="return checkLogin()" class="login-form">
        <h2>Email:</h2>
        <input type="text" name="inputEmail">
        <h2>Password:</h2>
        <input type="text" name="inputPassword"><br>
        <input type="submit">
    </form>
</body>
</html>