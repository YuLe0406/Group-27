function checkStock(store) {
    if (store == 0) {
        alert('Out of Stock');
        document.getElementById('add-to-cart-btn').disabled = true;
    }
}

function addToCart(name, price, image, size) {
    // Add product to cart (you can expand this functionality as needed)
    console.log("Product added to cart: ", name, price, image, size);

    // Show alert that product has been added to cart
    alert(name + ' has been added to your shopping cart.');
}
