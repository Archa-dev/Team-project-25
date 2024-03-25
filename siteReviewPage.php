<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="updatedFavicon.png" type="image/png">
    
    
    <title>Leave A Review</title>
    <?php
    session_start();
    require_once('connectdb.php');
    $customerid = $_SESSION['customer_id'];
    ?>
</head>
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
        outline: none; border: none;
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
            justify-content: space-between; 
            align-items: center;
            top: 0; left: 0; right: 0;
            box-shadow: 0 0 12px #1c7a7f;

        }

        main {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    
    
    
}

  

    .review-title {
        text-align: center;
    margin-bottom: 20px;
}

.review-title h2 {
    font-size: 40px;
    color: #003b46;
    font-weight: bold;
    margin-bottom: 45px;
    margin-right: 10px;
}

.reviewform-container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 80px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 12px #1c7a7f;
        text-align: left;
       
    }

    .reviewform-container label {
    margin-bottom: 28px;
    color: #003b46;
    font-weight: bold;
    font-size: 24px;
}

.reviewform-container select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    background-color: #f8f9fa;
    font-size: 16px;
    appearance: none; 
    margin-top: 10px;
    margin-bottom: 20px;
}

.reviewform-container input[type="radio"] {
    margin-top: 20px;
    margin-right: 15px;
    
    
}

.reviewform-container textarea {
    width: 100%;
    height: 100px;
    margin-top: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border-color:#ced4da;
}

.reviewform-container input[type="submit"] {
    background-color: #003b46;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    padding: 10px 20px;
    width: 100%;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.reviewform-container input[type="submit"]:hover {
    background-color: #07575B;
}

@media screen and (max-width: 768px) {
    .reviewform-container {
        width: 100%;
    }

    .reviewform-container label {
        font-size: 16px;
    }

    .reviewform-container select {
        font-size: 16px;
    }
}

.checked {
    font-size: 30px;
    margin-bottom: 10px;
      color: gold;
}

/* footer styles */
.footer {
    background-color: #003B46;
    color: #fff;
    padding: 20px 0; /* Adds padding to the top and bottom */
    bottom: 0; /* Sticks the footer to the bottom */
    width: 100%;
    position: relative;
}


.footer-col {
    width: 25%; /* width of each column */
    padding: 0 15px; /* horizontal padding */
    padding-left: 80px;/* left padding */
}

.footer-col h4 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 20px;
}

.footer-col ul {
    list-style-type: none;
    padding: 0;
}

.footer-col ul li {
    margin-bottom: 5px;
    font-size: 14px;
}

.footer-col ul li a {
    color: #fff;
    text-decoration: none;
}

.social-links a {
    display: inline-block;
    margin-right: 10px;
    color: #fff;
    font-size:16px;
}

.social-links a:hover {
    color: #ccc;
}


</style>
<body>
<main>
<div class="review-title">
        <h2>LEAVE A REVIEW OF THE SITE</h2>
</div>

<section class="reviewform-container">

    <form>
    <br>
    <label for="rating">SELECT A RATING:</label>
    <br>
    <label for="rating1">
    <input type="radio" name="rating" id="rating1" value="1"><span class="fa fa-star checked"></span>
    </label>
    <label for="rating2">
    <input type="radio" name="rating" id="rating2" value="2"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
    </label>
    <label for="rating3">
    <input type="radio" name="rating" id="rating3" value="3"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
    </label>
    <label for="rating4">
    <input type="radio" name="rating" id="rating4" value="4"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
    </label>
    <label for="rating5">
    <input type="radio" name="rating" id="rating5" value="5"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
    </label>
    <br>
    <br>
    <label for="review">ADD A WRITTEN REVIEW:</label>
    <br>
    <textarea name="review" placeholder="Please share your thoughts on our products or website" id="reviewTextBox"></textarea>
    <br>
    <br>
    <input type="submit" value="SUBMIT REVIEW">
    </form>
</section>
</main>



    <script>                                                                                                // check if required fields are filled in
        document.querySelector('form').addEventListener('submit', function(event){
            event.preventDefault();
            let rating = document.querySelector('input[name="rating"]:checked');
            let review = document.querySelector('textarea').value;
            if(rating == null){
                alert('Please fill in all required fields');
            }
            else{                                                                                           // adds review to db
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'addSiteReviewScript.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('&rating='+rating.value+'&review='+review);
                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                        console.log(xhr.responseText)
                        alert('Review Submitted');
                        window.location.href = 'aboutUs.php';
                    }
                }

                
            }
        });

    </script>

    
</body>
</html>
