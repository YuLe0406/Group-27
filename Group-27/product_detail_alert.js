function handleAddToCart(name, price, image, size, store) {
    if (store == 0) {
        alert('Out of Stock');
    } else {
        addToCart(name, price, image, size);
        alert(name + ' has been added to your shopping cart.');
    }
}
