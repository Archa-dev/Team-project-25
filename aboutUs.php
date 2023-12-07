<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>About Us - Shaded</title>

    <!-- CSS styles -->
    <style>
        body {
            font-family: 'Georgia', 'Times New Roman', Times, serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: rgb(87, 2, 87);
            color: #f5f4f4;
            padding: 1em 0;
            text-align: center;
        }

        .header {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            font-size: 2em;
            margin: 0;
        }

        section {
            background-color: #f4f4f4;
            padding: 40px 0;
        }

        .about-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        h2 {
            color: #000;
        }

        p {
            color: #333;
            font-size: 1.1em;
            line-height: 1.8;
        }

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
</head>
<body>

    <header>
        <div class="header">
            <h1>Shaded</h1>
        </div>
    </header>

    <!-- Page content. Using placeholder text for now-->
    <section>
        <div class="about-content">
            <h2>About Us</h2>
            <p>Welcome to Shaded – Where Style Meets UV Protection!

Discover the perfect pair of sunglasses at Shaded, your go-to destination for fashion-forward eyewear. Our curated collection blends style with quality, offering trendy and classic designs with top-notch UV protection.

Why Shaded?

Diverse Selection: From classic aviators to trendy cat-eye frames, find the perfect shades for your style.

Affordable Luxury: Elevate your look without breaking the bank with our stylish and affordable sunglasses.

Customer Satisfaction: Our dedicated support team ensures a seamless shopping experience. Embrace the allure of well-chosen shades – shop at Shaded today!</p>
        </div>
    </section>

 
    <footer>
        <div class="social-links">
            <!-- Link to social medias -->
            <a href="https://www.instagram.com/" target="_blank">
                <img src="instagram-logo.png" alt="Instagram Logo">
            </a>
            <!-- Twitter Link -->
            <a href="https://twitter.com/?lang=en" target="_blank">
                <img src="twitter-logo.png" alt="Twitter Logo">
            </a>
        </div>
        <div class="divider"></div>
        <div class="page-links">
            <!-- Links to other pages (Temporary names at the moment) -->
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
</body>
</html>
