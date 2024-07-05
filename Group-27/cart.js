function getCartItems() {
    return JSON.parse(localStorage.getItem('cartItems')) || [];
}

function setCartItems(cartItems) {
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
}


function addToCart(name, price, image) {
    const cartItems = getCartItems();
    const existingItemIndex = cartItems.findIndex(item => item.name === name);
    
    if (existingItemIndex >= 0) {
        cartItems[existingItemIndex].quantity += 1;
    } else {
        cartItems.push({ name, price, image, quantity: 1 });
    }
    
    setCartItems(cartItems);
    alert(name + ' has been added to your shopping cart.');
    displayCartItems();
}

function removeCartItem(index) {
    const cartItems = getCartItems();
    cartItems.splice(index, 1);
    setCartItems(cartItems);
    displayCartItems();
}

function updateQuantity(index, increment) {
    const cartItems = getCartItems();
    if (increment) {
        cartItems[index].quantity += 1;
    } else {
        cartItems[index].quantity -= 1;
        if (cartItems[index].quantity === 0) {
            removeCartItem(index);
            return;
        }
    }
    setCartItems(cartItems);
    displayCartItems();
}

function updateTotalPrice(cartItems) {
    let totalPrice = 0;
    cartItems.forEach(item => {
        totalPrice += item.price * item.quantity;
    });
    document.getElementById('total-price').innerText = `Total Price: RM${totalPrice.toFixed(2)}`;
}

function displayCartItems() {
    const cartItems = getCartItems();
    const cartContainer = document.getElementById('cart-items');
    cartContainer.innerHTML = '';

    cartItems.forEach((item, index) => {
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <div class="cart-item-info">
                <p>${item.name}</p>
                <p>Price: RM${item.price}</p>
                <div class="cart-item-quantity">
                    <button class="quantity-btn" onclick="updateQuantity(${index}, false)">-</button>
                    <span class="quantity-display">${item.quantity}</span>
                    <button class="quantity-btn" onclick="updateQuantity(${index}, true)">+</button>
                </div>
            </div>
            <button onclick="removeCartItem(${index})">Remove</button>
        `;
        cartContainer.appendChild(itemElement);
    });

    updateTotalPrice(cartItems);
}

function checkout() {
    alert('Proceeding to checkout!');
    window.location.href = 'checkout.html'
}

function clearCart() {
    localStorage.removeItem('cartItems');
    displayCartItems();
}

// Call displayCartItems() on page load
document.addEventListener('DOMContentLoaded', displayCartItems);