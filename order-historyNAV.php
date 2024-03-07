 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
    font-size: 15px;/* icon */
}

main {
    margin-top: 11vh; /* Adjust margin-top to be equal to the height of the header */
}
    
/* Welcome Section Styles */
.welcome-section {
    padding: 20px;
    background-color: #003B46; /*  background color */
}

.welcome-section h2 {
    font-size: 18px;
    color: #fff;
}

/* Sidebar Styles */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 300px;
    height: 100%;
    padding-top: 110px;
    background-color: #f8f9fa; /* background color  */
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
    font-size: 14px; /* Adjust font size */
    font-weight: bold;
    transition: background-color 0.3s;
    display: block;
}

.sidebar .nav-link:hover {
    background-color: #07575B; /* background color for the hover effect */
    color: #000;
}

.main-content {
    margin-left: 350px; /* Adjust this value to match the width of the sidebar */
}

/* Additional Styling for Active Link */
.sidebar .nav-link.active {
    background-color: #07575B ; /*  background color for the active link */
    color: #000;
    opacity: 0.8;
    position: relative;
}

.sidebar .nav-link.active::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 5px; /* Adjust the width of the vertical line */
    background-color: #000; /* color of the vertical line */
}

    /* order history page Styles */
    .order-history {
        justify-content: space-between;
        align-items: center;
        max-width: 87%;
        padding: 10px;
        margin: 50px;
    }
    
    .order {
        border-bottom: 1px solid #ccc;
        padding: 15px 0;
        color: #003B46;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .order-details {
        flex-grow: 1;
    }
    h2{
        color: #003B46;
    }
    
    /* View Details Button Styles */
    .view-details-btn {
        background-color: #003B46;
        color: #fff;
        padding: 8px 15px;
        border: none;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s, text-decoration 0.3s;
    }
    
    .view-details-btn:hover {
        text-decoration: underline;
        background-color: #07575B;
        color: #fff;
    }


    .sticky-footer-padding {
    margin-bottom: 8vh;
    /* Adjust the margin bottom to match the height of the footer */
}

/* Updated Footer Styles */
.footer {
            background-color: #003B46;
            color: #fff;
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
            color: #fff;
            font-size: 14px;
        }
.social-icons a:hover {
        color : #07575B;
        }

.terms-links a {
    margin-left: 5px;
    color: #fff; 
    text-decoration: none;
}

.terms-links a:hover {
    text-decoration: underline; /*  underlining on hover */
    color: #07575B; /*  hover color */
}

</style>
