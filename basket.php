<!DOCTYPE html>
<html>
    <head>
        <title>Basket</title>
        <link rel="stylesheet" href="" />
        <?php
        require_once('connectdb.php');
        ?>
        <script>
var customerid = "1";                                                                // needs to be changed to relevant customer ID

if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {
    var removeBasketItemButtons = document.getElementsByClassName('button-remove')
    for (var i = 0; i < removeBasketItemButtons.length; i++) {
        var button = removeBasketItemButtons[i]
        button.addEventListener('click', removeBasketItem)
    }

    var amountInputs = document.getElementsByClassName('basket-amount-input')
    for (var i = 0; i < amountInputs.length; i++) {
        var input = amountInputs[i]
        input.addEventListener('change', amountChanged)
    }

    var addToBasketButtons = document.getElementsByClassName('test-item-button')
    for (var i = 0; i < addToBasketButtons.length; i++) {
        var button = addToBasketButtons[i]
        button.addEventListener('click', addToBasketClicked)
    }

    document.getElementsByClassName('checkout-button')[0].addEventListener('click', checkoutClicked)
}

function checkoutClicked() {
    alert('Thank you for your purchase')
    var BasketItems = document.getElementsByClassName('basket-items')[0]
    while (BasketItems.hasChildNodes()) {
        BasketItems.removeChild(BasketItems.firstChild)
    }
    updateBasketTotal()
}

function removeBasketItem(event) {
    var buttonClicked = event.target
    var productid = buttonClicked.parentElement.parentElement.getElementsByClassName('basket-item-productid')[0].innerText
    buttonClicked.parentElement.parentElement.remove()
    <?php
    $removeItem = $db->prepare('DELETE FROM basket WHERE product_id = ? AND customer_id = ?');
    $removeItem->bindParam(1, $productid);
    $removeItem->bindParam(2, $customerid);
    $removeItem->execute();
    ?>
    updateBasketTotal()
}

function amountChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateBasketTotal()
}


<?php
$itemIDs=$db->prepare('SELECT product_id FROM basket WHERE customer_id = ?');
$itemIDs->bindParam(1, $customerid);
$itemIDs->execute();
$itemTitle=$db->prepare('SELECT product_name FROM productdetails WHERE product_id = ?');
$itemPrice=$db->prepare('SELECT price FROM productdetails WHERE product_id = ?');
$itemImage=$db->prepare('SELECT product_image FROM productdetails WHERE product_id = ?');
$itemAmount=$db->prepare('SELECT COUNT(*) FROM basket WHERE product_id = ?');


$itemsCount = $db->prepare('SELECT COUNT(*) FROM basket WHERE customer_id = ?');
$itemsCount->bindParam(1, $customerid);
$itemsCount->execute();
$itemsCount = $itemsCount->fetchColumn();
?>

function addItemToBasket(title, price, imageSrc, amount, productid) {
    var BasketRow = document.createElement('div')
    BasketRow.classList.add('basket-row')
    var BasketItems = document.getElementsByClassName('basket-items')[0]
    var BasketItemNames = BasketItems.getElementsByClassName('basket-item-title')
    for (var i = 0; i < BasketItemNames.length; i++) {
        if (BasketItemNames[i].innerText == title) {
            alert('This item is already added to the basket')
            return
        }
    }
    var BasketRowContents = `
        <div class="basket-item basket-column">
            <img class="basket-item-image" src="${imageSrc}" width="100" height="100">
            <span class="basket-item-title">${title}</span>
            <span class="basket-item-productid">${productid}</span>
        </div>
        <span class="basket-price basket-column">${price}</span>
        <div class="basket-amount basket-column">
            <input class="basket-amount-input" type="number" value="${amount}">
            <button class="button button-remove" type="button">REMOVE</button>
        </div>`
    BasketRow.innerHTML = BasketRowContents
    BasketItems.append(BasketRow)
    BasketRow.getElementsByClassName('button-remove')[0].addEventListener('click', removeBasketItem)
    BasketRow.getElementsByClassName('basket-amount-input')[0].addEventListener('change', amountChanged)
}

function updateBasketTotal() {
    var BasketItemContainer = document.getElementsByClassName('basket-items')[0]
    var BasketRows = BasketItemContainer.getElementsByClassName('basket-row')
    var total = 0
    for (var i = 0; i < BasketRows.length; i++) {
        var BasketRow = BasketRows[i]
        var priceElement = BasketRow.getElementsByClassName('basket-price')[0]
        var amountElement = BasketRow.getElementsByClassName('basket-amount-input')[0]
        var price = parseFloat(priceElement.innerText.replace('£', ''))
        var amount = amountElement.value
        total = total + (price * amount)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('basket-total-price')[0].innerText = '£' + total
}

for (var i = 0; i < $itemsCount; i++) {
var productid = <?php echo $itemIDs->fetchColumn();?>
<?php 
$itemTitle->bindParam(1, $productid);
$itemTitle->execute();
$itemPrice->bindParam(1, $productid);
$itemPrice->execute();
$itemImage->bindParam(1, $productid);
$itemImage->execute();
$itemAmount->bindParam(1, $productid);
$itemAmount->execute(); 
?>
var title = <?php echo $itemTitle->fetchColumn();?>
var price = <?php echo $itemPrice->fetchColumn();?>
var imageSrc = <?php echo $itemImage->fetchColumn();?>
var amount = <?php echo $itemAmount->fetchColumn();?>
addItemToBasket(title, price, imageSrc, amount, productid)
updateBasketTotal()
}

</script>
</head>
<body>
<h2>Basket</h2>
<div class="basket-row">
    <span class="basket-item basket-header basket-column">Item</span>
    <span class="basket-price basket-header basket-column">Price</span>
    <span class="basket-amount basket-header basket-column">Amount</span>
</div>
<div class="basket-items">
 </div>
<div class="basket-total">
<strong class="basket-total-title">Total</strong>
<span class="basket-total-price">£0</span>
 </div>
<button class="button checkout-button" type="button">CHECKOUT</button>