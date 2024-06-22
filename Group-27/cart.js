// cart.js

// Function to add an item to the cart
function addToCart(productName, price, imageUrl, size) {
    // Get the existing cart items from localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Create a new cart item
    const newItem = {
        name: productName,
        price: price,
        image: imageUrl,
        size: size
    };

    // Add the new item to the cart
    cart.push(newItem);

    // Save the updated cart back to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

    // Optional: Display a message or redirect the user to the cart page
    alert(`${productName} with size ${size} has been added to your cart.`);
    // window.location.href = 'cart.html'; // Redirect to cart page (if desired)
}

// Function to get the cart items
function getCartItems() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

// Function to display the cart items on the cart page
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
                <p>Size: ${item.size}</p>
                <button onclick="removeCartItem(${index})">Remove</button>
            </div>
        `;
        cartContainer.appendChild(itemElement);
    });

    updateTotalPrice(cartItems);
}

// Function to remove a specific item from the cart
function removeCartItem(index) {
    let cart = getCartItems();
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCartItems();
}

// Function to clear all items from the cart
function clearCart() {
    localStorage.removeItem('cart');
    displayCartItems();
}

// Function to update the total price
function updateTotalPrice(cartItems) {
    let totalPrice = 0;
    cartItems.forEach(item => {
        totalPrice += item.price;
    });
    document.getElementById('total-price').innerText = `Total Price: RM${totalPrice.toFixed(2)}`;
}

// Function to handle checkout
function checkout() {
    alert('Proceeding to checkout!');
    // Add your checkout handling code here
    // Example: redirect to a checkout page
    // window.location.href = 'checkout.html';
}

// Call displayCartItems() on page load
document.addEventListener('DOMContentLoaded', displayCartItems);
