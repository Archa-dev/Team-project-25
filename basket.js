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
    buttonClicked.parentElement.parentElement.remove()
    updateBasketTotal()
}

function amountChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateBasketTotal()
}

function addToBasketClicked(event) {
    var button = event.target
    var testItem = button.parentElement.parentElement
    var title = testItem.getElementsByClassName('test-item-title')[0].innerText
    var price = testItem.getElementsByClassName('test-item-price')[0].innerText
    var imageSrc = testItem.getElementsByClassName('test-item-image')[0].src
    addItemToBasket(title, price, imageSrc)
    updateBasketTotal()
}

function addItemToBasket(title, price, imageSrc) {
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
        </div>
        <span class="basket-price basket-column">${price}</span>
        <div class="basket-amount basket-column">
            <input class="basket-amount-input" type="number" value="1">
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