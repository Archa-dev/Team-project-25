<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Account - SHADED</title>

        <!--bootstrap css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
<style>
        
        html {
    font-size: 100%;
    scroll-behavior: smooth;

    > body {
        font-family: "Century Gothic", sans-serif;
        background-color: #ffffff;
        margin: 0;
        margin-bottom: 60px; /* Adjust this value to match the height of the footer */
        padding: 0;
        box-sizing: border-box;
        outline: none; border: none;
        text-decoration: none;
        text-transform: capitalize;
        transition: .2s linear;

        > header {
            background: #ffffff;
            position: fixed;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: space-between; /* Align logo to the left and nav to the right */
            align-items: center;
            top: 0; left: 0; right: 0;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.1);

            .navbar a {
                font-size: 15px;
                color: #000000;
                text-decoration: none;
            }

            /* Hide the dropdown arrow */
            .navbar-nav .nav-item.dropdown > .nav-link::after {
                display: none !important
            }
        }
    }
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
    margin-top: 11vh; /* Adjust margin-top to be equal to the height of the header */
}

.sticky-footer-padding {
    margin-bottom: 11vh;
    /* Adjust the margin bottom to match the height of the footer */
}

/* Welcome Section Styles */
.welcome-section {
    padding: 20px;
    background-color: #f8f9fa; /* Choose a background color for the welcome section */
}

.welcome-section h2 {
    font-size: 18px;
    color: #000;
}

/* Sidebar Styles */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 300px;
    height: 100%;
    padding-top: 110px;
    background-color: #f8f9fa; /* Choose a background color for the sidebar */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.sidebar ul {
    list-style: none;
    padding-left: 0;
}

.sidebar .nav-link {
    padding: 15px 20px;
    text-decoration: none;
    color: #000;
    font-size: 14px; /* Adjust font size as needed */
    font-weight: bold;
    transition: background-color 0.3s;
    display: block;
}

.sidebar .nav-link:hover {
    background-color: lightgrey; /* Set a background color for the hover effect */
    color: #000;
}

.main-content {
    margin-left: 350px; /* Adjust this value to match the width of the sidebar */
}

/* Additional Styling for Active Link */
.sidebar .nav-link.active {
    background-color: #f5f5f5; /* Set a background color for the active link */
    color: #000;
    position: relative;
}

.sidebar .nav-link.active::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 5px; /* Adjust the width of the vertical line as needed */
    background-color: #000; /* Set the color of the vertical line */
}

/* Form Styles */
.error {
    color: #ff0000;
    font-size: 0.8em;
    margin-top: 5px;
}

section {
    background-color: #ffffff;
    padding: 40px 0;
}

.profile-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 10px;
    max-width: 800px;
    margin: 50px;
}

.profile-details {
    max-width: 45%;
}

.profile-details label {
    font-weight: bold;
}

button {
    display: inline-block;
    padding: 0.375rem 0.75rem;
}

.edit-icon{
    cursor: pointer;
}

/* Profile Form Styles */
#editProfileForm {
    max-width: 800px;
    margin: 0 auto;
    text-align: left;
}

#editProfileForm label {
    display: block;
}

#editProfileForm textarea {
    resize: vertical;
}

#editProfileModal {
    display: none;
    position: fixed;
    top: 70px;
    left: 50%;
    transform: translate(-50%, 0%);
    z-index: 1000;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 80%;
    max-height: calc(100% - 70px);
    overflow-y: auto;
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}

.edit-modal {
    display: none;
    max-width: 50%;
    padding: 20px 40px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}


/*Footer Style */
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

    <!-- Header -->
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
                            <li><a class="dropdown-item" href="#">Men's Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Men's Green Sunglasses</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Women
                            </a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Women's Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Women's Green Sunglasses</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Unisex
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Unisex Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Unisex White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Unisex Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Unisex Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Unisex Green Sunglasses</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Prescription
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Prescription Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Prescription White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Prescription Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Prescription Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Prescription Green Sunglasses</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Blue Light
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Blue Light Black Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light White Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light Yellow Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light Brown Sunglasses</a></li>
                                <li><a class="dropdown-item" href="#">Blue Light Green Sunglasses</a></li>
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
                            <li><a class="dropdown-item" >View Wishlist</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="basket.php">View Shopping Cart</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <!-- Profile Section -->
    <main class="sticky-footer-padding main-content">
    <div class="container"> <!-- Wrap the profile content in a Bootstrap container -->

    <aside class="sidebar">
    <div class="welcome-section">
        <h2>Welcome to your personal area</h2>
        <!-- You can dynamically replace [Username] with the actual username -->
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="accountPage.php">
                My Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="order-history.php">
                My Orders
            </a>
            <li class="nav-item">
            <a class="nav-link" href="Contactus.php">Contact Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="homepage.php">
                Logout
            </a>
        </li>
    </ul>
</aside>

    <div class="profile-container">
    <div class="profile-details">
            <h2 class="border-bottom pb-2">Personal Details</h2>

<!-- Display Profile Details -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">First Name:</label>
                    <div id="firstNameDisplay">John</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="surname">Surname:</label>
                    <div id="surnameDisplay">Doe</div>
                </div>
            </div>

            <div class="mb-3">
                <label for="email">Your Email:</label>
                <div id="emailDisplay">john.doe@example.com</div>
            </div>

            <div class="mb-3">
    <label for="Password">Current Password:</label>
    <div id="currentPasswordDisplay">********</div>
</div>

            <div class="mb-3">
                <label for="phoneNumber">Phone Number:</label>
                <div id="phoneDisplay">123-456-7890</div>
            </div>

            <div class="mb-3">
    <label for="shippingAddress">Shipping Address:</label>
    <div id="shippingAddressDisplay">
        123 Shipping St, Cityville, State, 12345
    </div>
</div>

<div class="mb-3">
    <label for="billingAddress">Billing Address:</label>
    <div id="billingAddressDisplay">
        456 Billing St, Cityville, State, 67890
    </div>
</div>

<div class="mb-3">
    <label for="paymentMethod">Payment Method:</label>
    <div id="paymentMethodDisplay">Credit Card</div>
</div>

            <!-- Edit Profile Button -->
            <div class="edit-icon" onclick="openEditProfileModal()">
                <i class="fas fa-pencil-alt"></i> Edit Profile
            </div>
        </div>
    </div>
    </div>
</main>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="edit-modal">
    <span class="modal-close" onclick="closeEditProfileModal()">&times;</span>
    <h2>Edit Profile</h2>
    <form id="editProfileForm" onsubmit="return saveChanges()">
    <div class="row">
            <div class="col-md-6 mb-3">
                <label for="editFirstName">First Name:</label>
                <input type="text" id="editFirstName" name="editFirstName" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="editSurname">Surname:</label>
                <input type="text" id="editSurname" name="editSurname" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="editEmail">Your Email:</label>
            <input type="email" id="editEmail" name="editEmail" class="form-control" required>
        </div>

        <div class="row">
<div class="col-md-6 mb-3">
    <label for="newPassword">New Password:</label>
    <input type="password" id="newPassword" name="newPassword" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
    <label for="confirmNewPassword">Confirm New Password:</label>
    <input type="password" id="confirmNewPassword" name="confirmNewPassword" class="form-control" required>
</div>
        </div>

        <div class="mb-3">
            <label for="editPhoneNumber">Phone Number:</label>
            <input type="tel" id="editPhoneNumber" name="editPhoneNumber" class="form-control" placeholder="123-456-7890" required>
        </div>

        <!-- Additional Fields for Shipping, Billing Address, and Payment Methods -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="editShippingAddress">Shipping Address:</label>
                <textarea class="form-control" id="editShippingAddress" name="editShippingAddress" required></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="editBillingAddress">Billing Address:</label>
                <textarea class="form-control" id="editBillingAddress" name="editBillingAddress" required></textarea>
            </div>
        </div>

        <div class="mb-3">
            <label for="editPaymentMethod">Payment Method:</label>
            <select class="form-control" id="editPaymentMethod" name="editPaymentMethod" required>
                <option value="creditCard">Credit Card</option>
                <option value="paypal">PayPal</option>
                <!-- Add more payment methods as needed -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

    <!-- Footer -->
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

    <!-- Validation -->
    <script>
    function openEditProfileModal() {
        document.getElementById("editProfileModal").style.display = "block";
    }

    function closeEditProfileModal() {
        document.getElementById("editProfileModal").style.display = "none";
    }

    function saveChanges() {
        var firstNameInput = document.getElementById("editFirstName").value;
        var surnameInput = document.getElementById("editSurname").value;
        var emailInput = document.getElementById("editEmail").value;
        var currentPasswordInput = document.getElementById("currentPasswordDisplay").innerText;
        var newPasswordInput = document.getElementById("newPassword").value;
        var confirmNewPasswordInput = document.getElementById("confirmNewPassword").value;
        var phoneInput = document.getElementById("editPhoneNumber").value;
        var shippingAddressInput = document.getElementById("editShippingAddress").value;
        var billingAddressInput = document.getElementById("editBillingAddress").value;
        var paymentMethodInput = document.getElementById("editPaymentMethod").value;

 // Update the displayed details with the edited values
    document.getElementById("firstNameDisplay").innerText = firstNameInput;
    document.getElementById("surnameDisplay").innerText = surnameInput;
    document.getElementById("emailDisplay").innerText = emailInput;
    document.getElementById("currentPasswordDisplay").innerText = newPasswordInput !== "" ? "*".repeat(newPasswordInput.length) : currentPasswordInput;
    document.getElementById("phoneDisplay").innerText = phoneInput;
    document.getElementById("shippingAddressDisplay").innerText = shippingAddressInput;
    document.getElementById("billingAddressDisplay").innerText = billingAddressInput;
    document.getElementById("paymentMethodDisplay").innerText = paymentMethodInput;

        var changesMessage = "Changes saved successfully!\n\nNew Details:\nFirst Name: " + firstNameInput + "\nSurname: " + surnameInput +
        "\nEmail: " + emailInput + "\nPhone Number: " + phoneInput + "\nShipping Address: " + shippingAddressInput +
        "\nBilling Address: " + billingAddressInput + "\nPayment Method: " + paymentMethodInput;

/// Check if new password is provided and confirmed
if (newPasswordInput !== "" && newPasswordInput === confirmNewPasswordInput) {
        changesMessage += "\n\nPassword Changed!";
    }

    alert(changesMessage);

        // Close the modal after saving changes
        closeEditProfileModal();

        // Prevent the form from submitting (to avoid page reload)
        return false;
    }
</script>
</body>
</html>

