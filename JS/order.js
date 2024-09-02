let order = JSON.parse(localStorage.getItem('order')) || { items: [] };

function addToOrder(foodId, foodName, foodPrice, foodimg) {
    let item = order.items.find(i => i.id === foodId);
    if (item) {
        item.quantity += 1; // Increase quantity if item already exists
    } else {
        order.items.push({ id: foodId, name: foodName, price:foodPrice, img:foodimg,  quantity: 1 });
    }
    localStorage.setItem('order', JSON.stringify(order)); // Save to localStorage
    alert('Item added to your order!');
}

function orderNow(foodId, foodName, foodPrice, foodimg) {
    addToOrder(foodId, foodName, foodPrice, foodimg);
    // Redirect to order page or perform additional actions
    window.location.href = 'order-box.php';
}

function removeOrder() {
        localStorage.removeItem('order');
        
        document.getElementById('order-form').reset(); 
        
        window.location.reload();
}

// Function to render the order items from JSON
function renderOrderItems() {
    const orderItemsContainer = document.getElementById('order-items');
    orderItemsContainer.innerHTML = ''; // Clear existing items

    // Retrieve order from localStorage
    let order = JSON.parse(localStorage.getItem('order')) || { items: [] };

    // Render each item in the order
    order.items.forEach(item => {
        const itemCard = document.createElement('div');
        itemCard.className = 'order-item';
        itemCard.innerHTML = `
            <div class="image-container">
                <img src="images/food/${item.img}" alt="">
            </div>
            <div class="details">
                <h3>${item.name}</h3>
                <h4>$ ${item.price}</h4>
                <div class="price-div">
                    <input type="number" id="quantity-${item.id}" value="${item.quantity}" min="1" class="quantity-input">
                    <button class="delete-item" data-id="${item.id}">Delete</button>
                </div>
            </div>
        `;
        orderItemsContainer.appendChild(itemCard);
    });

    // Add event listeners for quantity change and delete actions
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', updateQuantity);
    });

    document.querySelectorAll('.delete-item').forEach(button => {
        button.addEventListener('click', deleteItem);
    });
}

function calculatePrice() {
    let totalPriceElement = document.getElementById("total-price");
    let totalPrice = 0;
    let order = JSON.parse(localStorage.getItem('order')) || { items: [] };
    order.items.forEach(item => {
        totalPrice += item.price * item.quantity;
    });
    totalPriceElement.innerHTML = "total price: $" + totalPrice;
}


// Function to update item quantity
function updateQuantity(event) {
    const input = event.target;
    const itemId = input.id.split('-')[1]; // Extract the item ID from the input ID
    let order = JSON.parse(localStorage.getItem('order')) || { items: [] };

    const item = order.items.find(i => i.id === itemId);
    if (item) {
        item.quantity = parseInt(input.value); // Update the quantity
        localStorage.setItem('order', JSON.stringify(order)); // Save updated order
    }
    calculatePrice();
}

// Function to delete an item
function deleteItem(event) {
    const itemId = event.target.getAttribute('data-id');
    let order = JSON.parse(localStorage.getItem('order')) || { items: [] };

    order.items = order.items.filter(item => item.id !== itemId); // Remove the item
    localStorage.setItem('order', JSON.stringify(order)); // Save updated order

    renderOrderItems(); // Re-render the updated list
}

// Call renderOrderItems on page load
document.addEventListener('DOMContentLoaded', renderOrderItems);
document.addEventListener('DOMContentLoaded', calculatePrice);
// document.getElementById('delete-order').addEventListener('click', renderOrderItems)

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-to-order').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const foodId = this.getAttribute('data-id'); // Get the ID from data-id attribute
            const foodName = this.getAttribute('data-title'); // Get the ID from data-id attribute
            const foodPrice = this.getAttribute('data-price'); // Get the ID from data-id attribute
            const foodImg = this.getAttribute('data-img'); // Get the ID from data-id attribute
            addToOrder(foodId, foodName, foodPrice, foodImg);
        });
    });

    document.querySelectorAll('.order-now').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const foodId = this.getAttribute('data-id'); // Get the ID from data-id attribute
            const foodName = this.getAttribute('data-title'); // Get the ID from data-id attribute
            const foodPrice = this.getAttribute('data-price'); // Get the ID from data-id attribute
            const foodImg = this.getAttribute('data-img'); // Get the ID from data-id attribute
            orderNow(foodId, foodName, foodPrice, foodImg);
        });
    });
});

