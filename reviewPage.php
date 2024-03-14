<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Add Review</title>
    <?php
    session_start();
    require_once('connectdb.php');
    $customerid = $_SESSION['customer_id'];
    ?>
</head>
<style>
    #reviewTextBox{
        width: 99%;
        height: 150px;
        resize: none;
    }
</style>
<body>
    <form>
    <label for="product">Select Product:</label>
    <br>
    <?php
    $fromProduct = $_GET['fromProduct'];
    $selectOptionsDB = $db->prepare('SELECT product_name,product_id FROM productdetails');                            // select box containing every product as an option
    $selectOptionsDB->execute();
    $selectOptions = $selectOptionsDB->fetchAll(PDO::FETCH_ASSOC);
    echo "<select name='productSelected'>";
    foreach($selectOptions as $option){
        if ($option['product_name'] == $fromProduct){
            echo "<option value='".$option['product_id']."' selected>".$option['product_name']."</option>";
        }
        else{
        echo "<option value='".$option['product_id']."'>".$option['product_name']."</option>";}
    }
    echo "</select>";
    ?>
    <br>
    <br>
    <label for="rating">Select Rating:</label>
    <br>
    <input type="radio" name="rating" value="1"><span class="fa fa-star checked"></span>
    <input type="radio" name="rating" value="2"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
    <input type="radio" name="rating" value="3"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
    <input type="radio" name="rating" value="4"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
    <input type="radio" name="rating" value="5"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
    <br>
    <br>
    <label for="review">Add a Written Review:</label>
    <br>
    <textarea name="review" placeholder="Tell us what you thought" id="reviewTextBox"></textarea>
    <br>
    <br>
    <input type="submit" value="Submit Review">
    </form>

    <script>                                                                                                // check if required fields are filled in
        document.querySelector('form').addEventListener('submit', function(event){
            event.preventDefault();
            let productSelected = document.querySelector('select').value;
            let rating = document.querySelector('input[name="rating"]:checked');
            let review = document.querySelector('textarea').value;
            if(productSelected == "" || rating == null){
                alert('Please fill in all required fields');
            }
            else{                                                                                           // adds review to db
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'addReviewScript.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                        alert('Review Submitted');
                        window.location.href = 'shopping.php';
                    }
                }
                xhr.send('productSelected='+productSelected+'&rating='+rating.value+'&review='+review);
                
            }
        });

    </script>
    
</body>
</html>