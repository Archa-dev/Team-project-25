<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <title>Signup</title>
  <h1>Signup</h1>

</head>

<body>
    <script src="hash.js"></script>
    <script src="signup.js"></script>
    <form onsubmit="return signupSuccess()" class="signup-form">
        <h2>Email:</h2>
        <input type="text" name="inputEmail">
        <h2>Password:</h2>
        <p>Please make sure password is 6+ characters</p>
        <input type="text" name="inputPassword"><br>
        <input type="submit">
    </form>
</body>
</html>