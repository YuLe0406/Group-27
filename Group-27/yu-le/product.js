document.addEventListener("DOMContentLoaded", function() {
    // Example product data
    const products = {
        "badminton": [
            { "name": "Yonex Nanoray", "price": 99.99, "image": "badminton1.jpg" },
            { "name": "Li-Ning Turbo", "price": 89.99, "image": "badminton2.jpg" },
            { "name": "Victor Brave Sword", "price": 129.99, "image": "badminton3.jpg" }
        ],
        "basketball": [
            { "name": "Spalding NBA", "price": 59.99, "image": "basketball1.jpg" },
            { "name": "Wilson Evolution", "price": 69.99, "image": "basketball2.jpg" },
            { "name": "Nike Elite", "price": 79.99, "image": "basketball3.jpg" }
        ],
        "shoes": [
            { "name": "Nike Air Max", "price": 149.99, "image": "shoes1.jpg" },
            { "name": "Adidas Ultraboost", "price": 179.99, "image": "shoes2.jpg" },
            { "name": "Puma RS-X", "price": 129.99, "image": "shoes3.jpg" }
        ],
        "jerseys": [
            { "name": "Team USA Jersey", "price": 89.99, "image": "jersey1.jpg" },
            { "name": "NBA Lakers Jersey", "price": 99.99, "image": "jersey2.jpg" },
            { "name": "Manchester United Jersey", "price": 79.99, "image": "jersey3.jpg" }
        ]
    };

    // Function to populate products
    function populateProducts(category) {
        const categoryElement = document.querySelector(`section.product-category h2:contains('${category}')`);
        const productGrid = categoryElement.nextElementSibling;
        
        products[category.toLowerCase()].forEach(product => {
            const productItem = document.createElement('div');
            productItem.classList.add('product-item');
            productItem.innerHTML = `
                <a href="product_detail.html">
                    <img src="${product.image}" alt="${product.name}">
                    <p>${product.name}</p>
                    <p>$${product.price.toFixed(2)}</p>
                </a>
            `;
            productGrid.appendChild(productItem);
        });
    }

    // Populate all categories
    Object.keys(products).forEach(category => {
        populateProducts(category);
    });
});
