<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    #checkout-container {
      width: 400px;
      text-align: center;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .dropdown {
      margin-bottom: 20px;
      text-align: left;
    }

    .dropdown-label {
      background-color: #eee;
      padding: 10px;
      cursor: pointer;
    }

    .dropdown-content {
      display: none;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-top: 5px;
    }

    .dropdown-content input {
      width: 100%;
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    .dropdown-content button {
      background-color: #4caf50;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .dropdown-content button:hover {
      background-color: #45a049;
    }

    .error-message {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<!-- Checkout Container -->
<div id="checkout-container">

  <!-- Checkout Heading -->
  <h1>Checkout</h1>

  <!-- Your Order Dropdown -->
  <div class="dropdown" id="order-dropdown">
    <div class="dropdown-label" onclick="toggleDropdown('order-dropdown')">Your Order</div>
    <div class="dropdown-content">
      <p>Your current product (placeholder)</p>
    </div>
  </div>

  <!-- Your Shipping Details Dropdown -->
  <div class="dropdown" id="shipping-dropdown">
    <div class="dropdown-label" onclick="toggleDropdown('shipping-dropdown')">Your Shipping Details</div>
    <div class="dropdown-content">
      <input type="text" placeholder="First Name" id="firstName">
      <input type="text" placeholder="Surname" id="surname">
      <input type="text" placeholder="Address Line" id="addressLine">
      <input type="text" placeholder="Postcode" id="postcode">
      <input type="text" placeholder="City" id="city">
      <button onclick="validateShipping()">Submit</button>
      <p class="error-message" id="shipping-error"></p>
    </div>
  </div>

  <!-- Your Payment Details Dropdown -->
  <div class="dropdown" id="payment-dropdown">
    <div class="dropdown-label" onclick="toggleDropdown('payment-dropdown')">Your Payment Details</div>
    <div class="dropdown-content">
      <input type="text" placeholder="16 Digit Card Number" id="cardNumber">
      <input type="text" placeholder="Expiry Date" id="expiryDate" onfocus="(this.type='date')">
      <input type="text" placeholder="Security Number" id="securityNumber">
      <button onclick="validatePayment()">Submit</button>
      <p class="error-message" id="payment-error"></p>
    </div>
  </div>

  <!-- Confirm Button -->
  <button onclick="confirmOrder()">Confirm</button>

  <!-- Confirmation Error Message -->
  <p class="error-message" id="confirmation-error"></p>
</div>

<!-- JavaScript Section -->
<script>
  function toggleDropdown(dropdownId) {
    var dropdownContent = document.getElementById(dropdownId).getElementsByClassName("dropdown-content")[0];
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  }

  function validateShipping() {
    var firstName = document.getElementById("firstName").value;
    var surname = document.getElementById("surname").value;
    var addressLine = document.getElementById("addressLine").value;
    var postcode = document.getElementById("postcode").value;
    var city = document.getElementById("city").value;

    if (firstName === '' || surname === '' || addressLine === '' || postcode === '' || city === '') {
      document.getElementById("shipping-error").innerText = "Incomplete Shipping Details";
    } else {
      document.getElementById("shipping-error").innerText = "";
    }
  }

  function validatePayment() {
    var cardNumber = document.getElementById("cardNumber").value;
    var expiryDate = document.getElementById("expiryDate").value;
    var securityNumber = document.getElementById("securityNumber").value;

    if (cardNumber.length !== 16 || isNaN(cardNumber)) {
      document.getElementById("payment-error").innerText = "Invalid Card Number";
    } else if (securityNumber.length !== 3 || isNaN(securityNumber)) {
      document.getElementById("payment-error").innerText = "Invalid Security Number";
    } else {
      document.getElementById("payment-error").innerText = "";
    }
  }

  function confirmOrder() {
    var shippingError = document.getElementById("shipping-error").innerText;
    var paymentError = document.getElementById("payment-error").innerText;

    if (shippingError === '' && paymentError === '') {
      alert("Thank you for your order!");
      // Redirect to a new page or perform other actions as needed
    } else {
      document.getElementById("confirmation-error").innerText = "Sections are not completed";
    }
  }
</script>

</body>
</html>
