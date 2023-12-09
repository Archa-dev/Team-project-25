<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Sign Up - SHADED</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
      html {
    font-size: 100%;
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

        header {
          background: #ffffff;
            position: fixed;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: space-between; /* Align logo to the left and nav to the right */
            align-items: center;
            top: 0; left: 0; right: 0;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .navbar a {
                font-size: 15px;
                color: #000000;
                text-decoration: none;
            }

            /* Hide the dropdown arrow */
            .navbar-nav .nav-item.dropdown > .nav-link::after {
                display: none !important
            }

.logo img {
    max-width: 100%; /* Ensure the logo scales proportionally */
    max-height: 50px; /* Set the maximum height as needed */
    margin-left: auto; /* Center the logo horizontally */
}

.fas {
    font-size: 15px;
}

main {
            margin-top: 8vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100%;
        }

        .sticky-footer-padding {
    margin-bottom: 10vh;
    /* Adjust the margin bottom to match the height of the footer */
}

/*Sign Up Styles by Maryam*/
.signup-form {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

.signup-form input,
        .signup-form button {
            margin-bottom: 5px;
            font-size: 14px; /* Adjust the font size as needed */
        }

        .signup-form h2 {
            font-size: 16px; /* Adjust the font size for all h2 elements */
        }

        .signup-form p {
            font-size: 14px; /* Adjust the font size for the password message */
        }

        .signup-form a {
            display: block;
            text-align: center;
            font-size: 14px; /* Adjust the font size for the "Already have an account?" link */
        }

        .sticky-footer-padding {
            margin-bottom: 8vh;
            height: 100%; /* Take full height */
        }
        
/* Updated Footer Styles */
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
    color: #6c757d; /* Change the color as needed */
    text-decoration: none;
}

.terms-links a:hover {
    text-decoration: underline; /* Add underlining on hover if desired */
    color: #000; /* Change the hover color as needed */
}

</style>
</head>
<body>

<!--bootstrap js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous">
        </script>

<header>
        <!-- added bootstrap navbar utility classes -->
        <nav class="navbar navbar-expand-sm w-100">

            <!-- using container-fluid for responsiveness -->
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenuItems" aria-controls="navbarMenuItems" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="homepage.php" class="navbar-brand logo">
                    <img src="shaded logo.png" alt="Shaded Logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarMenuItems">

                    <!-- navbar to the left of the search box -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Men
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Men Category 1</a></li>
                                <li><a class="dropdown-item" href="#">Men Category 2</a></li>
                                <li><a class="dropdown-item" href="#">Men Category 3</a></li>
                                <li><a class="dropdown-item" href="#">Men Category 4</a></li>
                                <li><a class="dropdown-item" href="#">Men Category 5</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Women
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Women Category 1</a></li>
                                <li><a class="dropdown-item" href="#">Women Category 2</a></li>
                                <li><a class="dropdown-item" href="#">Women Category 3</a></li>
                                <li><a class="dropdown-item" href="#">Women Category 4</a></li>
                                <li><a class="dropdown-item" href="#">Women Category 5</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Unisex
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Unisex Category 1</a></li>
                                <li><a class="dropdown-item" href="#">Unisex Category 2</a></li>
                                <li><a class="dropdown-item" href="#">Unisex Category 3</a></li>
                                <li><a class="dropdown-item" href="#">Unisex Category 4</a></li>
                                <li><a class="dropdown-item" href="#">Unisex Category 5</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Prescription
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Prescription Category 1</a></li>
                                <li><a class="dropdown-item" href="#">Prescription Category 2</a></li>
                                <li><a class="dropdown-item" href="#">Prescription Category 3</a></li>
                                <li><a class="dropdown-item" href="#">Prescription Category 4</a></li>
                                <li><a class="dropdown-item" href="#">Prescription Category 5</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Blue Light
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Blue Light Category 1</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light Category 2</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light Category 3</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light Category 4</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light Category 5</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutUs.php">About Us</a>
                        </li>
                    </ul>

                    <!-- search box -->
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="mySearchInput">
                        <button class="btn btn-outline-bg" type="submit">
                            <a href="#">
                                <i class="fas fa-search"></i>
                            </a>
                        </button>
                    </form>

                    <!-- navbar to the right of the search box -->
                    <ul class="navbar-nav mw-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> <!-- Assuming a user icon for admin/user -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="accountPage.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="order-history.php">My Orders</a></li>
                                <li><a class="dropdown-item" href="homepage.php">Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-lock"></i> <!-- Assuming a lock icon for log in/sign up -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="login.php">Log In</a></li>
                                <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-heart"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" >Your wish list is empty</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" >Your shopping cart is empty</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <main class="sticky-footer-padding">

    <div class="container mt-5">
      <div class="row justify-content-center">
         <div class="col-md-6">
            <form method="post" action="signup.php" onsubmit="return signupSuccess()" class="signup-form">
            <h1>Sign Up</h1>
            <h2>Email:</h2>
              <input type="email" name="inputEmail" class="form-control" required>

              <h2>Username:</h2>
              <input type="text" name="Username" class="form-control" required>

              <h2>Name:</h2>
              <input type="text" name="Name" class="form-control" required>

              <h2>Address (optional):</h2>
              <input type="text" name="Address" class="form-control">

              <h2>Password:</h2>
              <p>Please make sure the password is 6+ characters</p>
              <input type="password" name="inputPassword" class="form-control" required>

              <input type="submit" value="Sign Up" class="btn btn-primary mt-3">
              <input type="hidden" name="sub"> <!--Added the required attribute to the email and password fields for basic client-side validation. - Maryam--->
            </form>
    <p class="mt-3"><a href="login.php">Already have an account?</a></p>
          </div>
        </div>
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

<!-- Bootstrap Container for Footer -->
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
                        <!-- Add your social media icons  -->
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <!-- Add more social media icons as needed -->
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

</body>
</html>


