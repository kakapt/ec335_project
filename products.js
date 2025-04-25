const productsContainer = document.getElementById('products-container');
const cartCountElement = document.getElementById('cart-count');
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Hàm cập nhật số lượng giỏ hàng
function updateCartCount(count) {
    cartCountElement.textContent = count;
    localStorage.setItem('cartCount', count);
}

// Xử lý thêm vào giỏ hàng
document.querySelectorAll('.cart-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('cart_action.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cập nhật localStorage và session
                localStorage.setItem('cart', JSON.stringify(data.cart));
                sessionStorage.setItem('cartSynced', 'false');
                
                // Cập nhật UI
                updateCartCount(data.cartCount);
                alert('Product added to cart!');
                
                // Làm mới modal giỏ hàng
                updateCartModal(data.cart);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            this.submit();
        });
    });
});

// Hàm cập nhật modal giỏ hàng
function updateCartModal(cartItems) {
    const cartItemsContainer = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('cart-total-price');
    
    cartItemsContainer.innerHTML = '';
    let total = 0;
    
    Object.values(cartItems).forEach(item => {
        total += item.price * item.quantity;
        cartItemsContainer.innerHTML += `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="item-details">
                    <h3>${item.name}</h3>
                    <p>${formatPrice(item.price)} x ${item.quantity}</p>
                </div>
            </div>
        `;
    });
    
    totalPriceElement.textContent = formatPrice(total);
}

// Xử lý checkout button
document.getElementById('checkout-btn').addEventListener('click', function(e) {
    if (Object.keys(cart).length === 0) {
        e.preventDefault();
        alert('Your cart is empty!');
    }
    // Tự động redirect đến checkout.php
});

// Format giá
function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN', { 
        style: 'currency', 
        currency: 'VND' 
    }).format(price);
}