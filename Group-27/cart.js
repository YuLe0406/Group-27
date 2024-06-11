// cart.js

// Function to add an item to the cart
function addToCart(productName, productPrice, productImage) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const existingProductIndex = cart.findIndex(product => product.name === productName);

    if (existingProductIndex !== -1) {
        cart[existingProductIndex].quantity += 1;
    } else {
        const product = { name: productName, price: productPrice, image: productImage, quantity: 1 };
        cart.push(product);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    alert(`${productName} has been added to your cart.`);
}

// Function to load and display the cart items
function loadCart() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartList = document.getElementById('cart-list');
    const totalPriceElem = document.getElementById('total-price');
    cartList.innerHTML = '';
    let totalPrice = 0;

    cart.forEach((item, index) => {
        const li = document.createElement('li');
        li.classList.add('cart-item');
        
        const img = document.createElement('img');
        img.src = item.image;
        img.alt = item.name;
        img.classList.add('cart-item-image');

        const name = document.createElement('span');
        name.textContent = item.name;
        name.classList.add('cart-item-name');

        const price = document.createElement('span');
        price.textContent = `RM${(item.price * item.quantity).toFixed(2)}`;
        price.classList.add('cart-item-price');

        const quantity = document.createElement('div');
        quantity.classList.add('cart-item-quantity');
        
        const minusButton = document.createElement('button');
        minusButton.textContent = '-';
        minusButton.classList.add('quantity-btn');
        minusButton.onclick = () => updateQuantity(index, -1);

        const quantityDisplay = document.createElement('span');
        quantityDisplay.textContent = item.quantity;
        quantityDisplay.classList.add('quantity-display');

        const plusButton = document.createElement('button');
        plusButton.textContent = '+';
        plusButton.classList.add('quantity-btn');
        plusButton.onclick = () => updateQuantity(index, 1);

        quantity.appendChild(minusButton);
        quantity.appendChild(quantityDisplay);
        quantity.appendChild(plusButton);

        li.appendChild(img);
        li.appendChild(name);
        li.appendChild(price);
        li.appendChild(quantity);

        cartList.appendChild(li);
        totalPrice += item.price * item.quantity;
    });

    totalPriceElem.textContent = `Total: RM${totalPrice.toFixed(2)}`;
}

// Function to update the quantity of a product in the cart
function updateQuantity(index, delta) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    if (cart[index].quantity + delta > 0) {
        cart[index].quantity += delta;
    } else {
        cart.splice(index, 1);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
}

// Function to clear the cart
function clearCart() {
    localStorage.removeItem('cart');
    loadCart();
}

// Load cart when the document is fully loaded
document.addEventListener('DOMContentLoaded', loadCart);
