<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <title>Signup</title>
  <h1>Signup</h1>

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