<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        
        header {
            background-color: #600060;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        /* Form Styles */
        .error {
            color: #ff0000;
            font-size: 0.8em;
            margin-top: 5px;
        }

        section {
            background-color: #f4f4f4;
            padding: 40px 0;
        }

        .profile-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        h2 {
            color: #000;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: rgb(87, 2, 87);
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #600060;
        }

        /* Footer Styles */
        footer {
            background-color: rgb(70, 0, 70);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 10px;
        }

        .social-links img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .divider {
            border-right: 1px solid #fff;
            height: 40px;
            margin: 10px;
        }

        .page-links {
            display: flex;
            flex-direction: column;
        }

        .page-row {
            display: flex;
            margin-bottom: 10px;
        }

        .page-links a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
            font-weight: 300;
        }
    </style>
    <?php
    require_once('connectdb.php');
    session_start();
    if($_SESSION['user_id']==null){
    $_SESSION["username"]="customer1";
    $_SESSION["user_id"]="2";
    $uid=$_SESSION["user_id"];
    }
    $fet=$db->prepare("SELECT * FROM logindetails WHERE user_id =?");
    $fet->bindParam(1,$_SESSION['user_id']);
    $fet->execute();
    $emaill=$fet->fetch();
    $email=$emaill['email'];

    $fetc=$db->prepare("SELECT * FROM customerdetails WHERE user_id =?");
    $fetc->bindParam(1,$_SESSION['user_id']);
    $fetc->execute();
    $profile=$fetc->fetch();

    $name=$profile['name'];
    $address=$profile['default_address'];


    ?>
    <title>Your Profile - Shaded</title>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header">
            <h1>Shaded</h1>
        </div>
    </header>

    <!-- Profile Section -->
    <section>
        <div class="profile-content">
            <h2>Your Profile</h2>

            <!-- Profile Form -->
            <form method="post" action="accountPage.php" id="profileForm" onsubmit="return accountValidation()">
                <div class="form-group">
                    <label for="accountName">Your Name:</label>
                    <input type="text" id="accountName" name="accountName" value="<?php echo($name); ?>" required>
                    <div class="error" id="accountNameError"></div>
                </div>

                <div class="form-group">
                    <label for="profilePicture">Profile Pic:</label>
                    <input type="file" id="profilePicture" name="profilePicture" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" value="<?php echo($address); ?>"></textarea>
                    <div class="error" id="addressError"></div>
                </div>

                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo($email); ?>" required>
                    <div class="error" id="emailError"></div>
                </div>

                <div class="form-group">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" placeholder="123-456-7890">
                    <div class="error" id="phoneError"></div>
                </div>

                <button type="submit">Save Changes</button>
                <input type="hidden" name="profsub">
            </form>
            <?php
                if(isset($_POST['profsub'])){
                
                $name=$_POST['accountName'];
                $address=$_POST['address'];
                $email=$_POST['email'];

                $ins=$db->prepare("UPDATE logindetails SET email =? WHERE user_id =?");
                $ins->bindParam(1,$email);
                $ins->bindParam(2,$_SESSION['user_id']);
                $ins->execute();

                $pins=$db->prepare("UPDATE customerdetails SET name =?, default_address=? WHERE user_id =?");
                $pins->bindParam(1,$name);
                $pins->bindParam(2,$address);
                $pins->bindParam(3,$_SESSION['user_id']);
                $pins->execute();





            }
            
            
            
            
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="social-links">
            <a href="https://www.instagram.com/" target="_blank">
                <img src="instagram-logo.png" alt="Instagram Logo">
            </a>
            <a href="https://twitter.com/?lang=en" target="_blank">
                <img src="twitter-logo.png" alt="Twitter Logo">
            </a>
        </div>
        <div class="divider"></div>
        <div class="page-links">
            <div class="page-row">
                <a href="#page1">Page 1</a>
                <a href="#page2">Page 2</a>
            </div>
            <div class="page-row">
                <a href="#page3">Page 3</a>
                <a href="#page4">Page 4</a>
            </div>
            <div class="page-row">
                <a href="#page5">Page 5</a>
                <a href="#page6">Page 6</a>
            </div>
        </div>
    </footer>

    <!-- Validation -->
    <script>
        function accountValidation() {
            var accountName = document.getElementById("accountName").value;
            var address = document.getElementById("address").value;
            var email = document.getElementById("email").value;
            var phoneNumber = document.getElementById("phoneNumber").value;

            if (accountName === "") {
                document.getElementById("accountNameError").innerText = "Enter Name";
                return false;
            } else {
                document.getElementById("accountNameError").innerText = "";
            }

            if (address === "") {
             //   document.getElementById("addressError").innerText = "Enter Address";
               // return false;
            } else {
               document.getElementById("addressError").innerText = "";
            }

            if (email === "") {
                document.getElementById("emailError").innerText = "Enter Email";
                return false;
            } else {
                document.getElementById("emailError").innerText = "";
            }

            if (phoneNumber === "") {
                //document.getElementById("phoneError").innerText = "Enter Phone Number";
                //return false;
            } else {
                document.getElementById("phoneError").innerText = "";
            }

            alert("Changes saved successfully!");
            window.location.href = "home/index.php";
            return true;
        }
    </script>
</body>
</html>
