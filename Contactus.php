<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   

    <!--bootstrap css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <title>Contact Us-SHADED</title>
</head>
<body>

    <style>
        body {
    font-family: "Century Gothic", sans-serif;
    background-color: #fff;
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
    background: #fff;
    position: fixed;
    width: 100%;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    top: 0;
    left: 0;
    right: 0;
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, 0.1);
}

/* Logo Styles */
.logo img {
    max-width: 100%;
    max-height: 50px;
    margin-left: auto;
}

/* Icon Styles */
.fas {
    font-size: 15px;
}

/* contact us page Styles */
.container {
    max-width: 960px;
   margin: 50px auto;
   padding: 20px;
   background-color: #fff;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
 }
 .contact-section {
   margin-top: 20px;
   padding: 20px;
   border-top: 1px solid #ccc;
   border-bottom: 1px solid #ccc;
 }
 .contact-section h2 {
   font-size: 24px;
 }
 .contact-section p {
   font-size: 16px;
 }
 .contact-section .service-hours {
   margin-bottom: 20px;
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

                <a href="#" class="navbar-brand logo">
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-user"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-heart"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Item 1</a></li>
                                <li><a class="dropdown-item" href="#">Item 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Product 1</a></li>
                                <li><a class="dropdown-item" href="#">Product 2</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        
        <div class="container">
            <div class="contact-section">
              <h2>Contact us</h2>
              <p>Use one of the following methods to contact us</p>
            </div>
          
            <div class="contact-section">
              <h3>Call our Client Service</h3>
              <p class="service-hours">To contact our Client Service you can call 800 800 7732 from Monday to Saturday 9:00 am - 8:00 pm, or Sunday 9:00 am - 6:00 pm.</p>
            </div>
            <div class = "contact-section">
              <h3>Send us a message</h3>
              <form action="/submit-message" method="post">
                  <label for="name">Name:</label>
                  <input type="text" id="name" name="name" required><br><br>
                  <label for="email">Email:</label>
                  <input type="email" id="email" name="email" required><br><br>
                  <label for="message">Message:</label>
                  <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
                  <input type="submit" value="Submit">
              </form>
            
            </div>
            
          </div>
           

           
        


    </main>

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
