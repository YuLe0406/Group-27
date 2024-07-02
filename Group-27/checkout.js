function getCartItems() {
    return JSON.parse(localStorage.getItem('cartItems')) || [];
}

function updateTotalPrice(cartItems) {
    let totalPrice = 0;
    cartItems.forEach(item => {
        totalPrice += item.price * item.quantity;
    });
    return totalPrice.toFixed(2);
}

function displayOrderSummary() {
    const cartItems = getCartItems();
    const orderSummary = document.getElementById('orderSummary');
    orderSummary.innerHTML = '';

    cartItems.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className = 'order-summary-item';
        itemElement.innerHTML = `
            <p>${item.name} (x${item.quantity}) - RM${(item.price * item.quantity).toFixed(2)}</p>
        `;
        orderSummary.appendChild(itemElement);
    });

    const totalElement = document.createElement('div');
    totalElement.className = 'order-summary-total';
    totalElement.innerHTML = `<p>Total Price: RM${updateTotalPrice(cartItems)}</p>`;
    orderSummary.appendChild(totalElement);
}

document.getElementById('checkoutForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Order placed successfully!');
    // Add your order processing code here
    // Example: send the order data to the server
    // window.location.href = 'order_confirmation.html';
});

// Call displayOrderSummary() on page load
document.addEventListener('DOMContentLoaded', displayOrderSummary);
