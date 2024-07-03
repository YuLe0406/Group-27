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

    // Capture form data
    const fullName = document.getElementById('fullName').value;
    const contactNumber = document.getElementById('contactNumber').value;
    const email = document.getElementById('email').value;
    const address = document.getElementById('address').value;
    const cardHolder = document.getElementById('cardHolder').value;
    const cardNumber = document.getElementById('cardNumber').value;
    const expiryDate = document.getElementById('expiryDate').value;
    const cvv = document.getElementById('cvv').value;
    
    // Get cart items and total price
    const cartItems = getCartItems();
    const totalPrice = updateTotalPrice(cartItems);
    
    // Create the invoice content
    let itemsList = '';
    cartItems.forEach(item => {
        itemsList += `<p>${item.name} (x${item.quantity}) - RM${(item.price * item.quantity).toFixed(2)}</p>`;
    });
    
    const invoiceContent = `
        <html>
            <head>
                <title>Invoice</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .invoice-container { margin: 20px; }
                    .invoice-header { text-align: center; }
                    .invoice-details, .invoice-items { margin-top: 20px; }
                    .invoice-details p, .invoice-items p { margin: 5px 0; }
                </style>
            </head>
            <body>
                <div class="invoice-container">
                    <h1 class="invoice-header">Invoice</h1>
                    <div class="invoice-details">
                        <p><strong>Full Name:</strong> ${fullName}</p>
                        <p><strong>Contact Number:</strong> ${contactNumber}</p>
                        <p><strong>Email:</strong> ${email}</p>
                        <p><strong>Address:</strong> ${address}</p>
                    </div>
                    <div class="invoice-items">
                        ${itemsList}
                    </div>
                    <div class="invoice-total">
                        <p><strong>Total Price:</strong> RM${totalPrice}</p>
                    </div>
                </div>
            </body>
        </html>
    `;

    // Open a new window and write the invoice content
    const invoiceWindow = window.open('', 'Print Invoice', 'height=600,width=800');
    invoiceWindow.document.write(invoiceContent);
    invoiceWindow.document.close();
    invoiceWindow.print();

    // Clear cart after placing the order
    localStorage.removeItem('cartItems');
    displayOrderSummary();
});

// Call displayOrderSummary() on page load
document.addEventListener('DOMContentLoaded', displayOrderSummary);
