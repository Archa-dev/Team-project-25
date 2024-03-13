<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Reviews</h1>
        <div class="form-box">
            <div class="row">
                <label for="type">Select Type:</label>
                <select id="type" onchange="changeOptions()">
                    <option value="products">Products</option>
                    <option value="website">Website</option>
                </select>
            </div>
            <div class="row" id="optionsRow">
            </div>
            <div class="row">
                <label for="rating">Rating (1-5):</label>
                <input type="number" id="rating" min="1" max="5">
            </div>
            <div class="row">
                <label for="review">Write a Review:</label>
                <textarea id="review" rows="4"></textarea>
            </div>
            <div class="row">
                <button onclick="submitReview()">Submit</button>
            </div>
        </div>
    </div>



    <script>
        function changeOptions() {
            var type = document.getElementById("type").value;
            var optionsRow = document.getElementById("optionsRow");
            var options = "";
            
            if (type === "products") {
                options += '<label for="product">Select Product:</label>';
                options += '<select id="product">';
                options += '<option value="black1">Black Product 1</option>';
                options += '<option value="black2">Black Product 2</option>';
                options += '<option value="black3">Black Product 3</option>';
                options += '<option value="black4">Black Product 4</option>';
                options += '<option value="black5">Black Product 5</option>';
                options += '<option value="white">White Product 1</option>';
                options += '<option value="white">White Product 2</option>';
                options += '<option value="white">White Product 3</option>';
                options += '<option value="white">White Product 4</option>';
                options += '<option value="white">White Product 5</option>';
                options += '<option value="green1">Green Product 1</option>';
                options += '<option value="green2">Green Product 2</option>';
                options += '<option value="green3">Green Product 3</option>';
                options += '<option value="green4">Green Product 4</option>';
                options += '<option value="green5">Green Product 5</option>';
                options += '<option value="yellow1">Yellow Product 1</option>';
                options += '<option value="yellow2">Yellow Product 2</option>';
                options += '<option value="yellow3">Yellow Product 3</option>';
                options += '<option value="yellow4">Yellow Product 4</option>';
                options += '<option value="yellow5">Yellow Product 5</option>';
                options += '<option value="brown1">Brown Product 1</option>';
                options += '<option value="brown2">Brown Product 2</option>';
                options += '<option value="brown3">Brown Product 3</option>';
                options += '<option value="brown4">Brown Product 4</option>';
                options += '<option value="brown5">Brown Product 5</option>';

                options += '</select>';
            } else if (type === "website") {
                options += '<label for="aspect">Select Aspect:</label>';
                options += '<select id="aspect">';
                options += '<option value="design">Design</option>';
                options += '<option value="features">Features</option>';
                options += '<option value="selection">Selection</option>';
                options += '<option value="usability">Usability</option>';
                options += '<option value="other">Other</option>';
                options += '</select>';
            }
            
            optionsRow.innerHTML = options;
        }
  
</body>
</html>
