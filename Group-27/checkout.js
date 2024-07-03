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

    // Get current date and time
    const currentDate = new Date();
    const date = currentDate.toLocaleDateString();
    const time = currentDate.toLocaleTimeString();

    // Create the invoice content
    let itemsList = '';
    cartItems.forEach(item => {
        itemsList += `
            <div class="invoice-item">
                <img src="${item.image}" alt="${item.name}" class="invoice-item-image">
                <p>${item.name} (x${item.quantity}) - RM${(item.price * item.quantity).toFixed(2)}</p>
            </div>
        `;
    });

    const invoiceContent = `
        <html>
            <head>
                <title>Invoice</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
                    .invoice-container { max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ccc; }
                    .invoice-header { text-align: center; margin-bottom: 20px; }
                    .invoice-header h1 { margin: 0; }
                    .invoice-details, .invoice-items { margin-top: 20px; }
                    .invoice-details p, .invoice-items p { margin: 5px 0; }
                    .invoice-details p strong { width: 150px; display: inline-block; }
                    .invoice-items .invoice-item { display: flex; align-items: center; margin-top: 10px; }
                    .invoice-item-image { width: 50px; height: 50px; margin-right: 10px; }
                    .invoice-total { text-align: right; margin-top: 20px; }
                </style>
            </head>
            <body>
                <div class="invoice-container">
                    <div class="invoice-header">
                        <h1>PEPE Sport Shop</h1>
                        <p>Date: ${date}</p>
                        <p>Time: ${time}</p>
                    </div>
                    <div class="invoice-details">
                        <p><strong>Full Name:</strong> ${fullName}</p>
                        <p><strong>Contact Number:</strong> ${contactNumber}</p>
                        <p><strong>Email:</strong> ${email}</p>
                        <p><strong>Address:</strong> ${address}</p>
                        <p><strong>Card Holder Name:</strong> ${cardHolder}</p>
                        <p><strong>Card Number:</strong> ${cardNumber.replace(/\d{12}(\d{4})/, "**** **** **** $1")}</p>
                        <p><strong>Expiry Date:</strong> ${expiryDate}</p>
                        <p><strong>CVV:</strong> ${cvv.replace(/\d/, "*")}</p>
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
    const invoiceWindow = window.open('', 'Print Invoice', 'height=800,width=800');
    invoiceWindow.document.write(invoiceContent);
    invoiceWindow.document.close();
    invoiceWindow.print();

    // Clear cart after placing the order
    localStorage.removeItem('cartItems');
    displayOrderSummary();
});

// Call displayOrderSummary() on page load
document.addEventListener('DOMContentLoaded', displayOrderSummary);
