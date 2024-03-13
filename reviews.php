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


  
</body>
</html>
