document.addEventListener('DOMContentLoaded', function() {
    console.log("Checkout.js loaded successfully");
    
    // Tham chiếu các phần tử
    const minusBtns = document.querySelectorAll('.qty-btn.minus');
    const plusBtns = document.querySelectorAll('.qty-btn.plus');
    const updateForms = document.querySelectorAll('.update-form');
    const removeForms = document.querySelectorAll('.remove-form');
    const cartCountElement = document.getElementById('cart-count');
    const checkoutForm = document.getElementById('checkout-form');
    
    // Payment method selection
    const paymentMethods = document.querySelectorAll('input[name="payment-method"]');
    const creditCardDetails = document.getElementById('credit-card-details');
    const paypalDetails = document.getElementById('paypal-details');
    const bankTransferDetails = document.getElementById('bank-transfer-details');
    
    // Xử lý nút tăng/giảm số lượng
    minusBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.nextElementSibling;
            const value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        });
    });
    
    plusBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const value = parseInt(input.value);
            input.value = value + 1;
        });
    });
    
    // Xử lý form update bằng AJAX
    updateForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('../Mainpage/cart_action.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật số lượng giỏ hàng
                    if (cartCountElement) {
                        cartCountElement.textContent = data.cartCount;
                    }
                    
                    // Làm mới trang sau khi cập nhật
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
    
    // Xử lý form remove bằng AJAX
    removeForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('../Mainpage/cart_action.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật số lượng giỏ hàng
                    if (cartCountElement) {
                        cartCountElement.textContent = data.cartCount;
                    }
                    
                    // Làm mới trang sau khi xóa
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
    
    // Ẩn/hiện chi tiết thanh toán
    if (paymentMethods.length > 0) {
        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                if (creditCardDetails) creditCardDetails.classList.add('hidden');
                if (paypalDetails) paypalDetails.classList.add('hidden');
                if (bankTransferDetails) bankTransferDetails.classList.add('hidden');
                
                if (this.value === 'credit-card' && creditCardDetails) {
                    creditCardDetails.classList.remove('hidden');
                } else if (this.value === 'paypal' && paypalDetails) {
                    paypalDetails.classList.remove('hidden');
                } else if (this.value === 'bank-transfer' && bankTransferDetails) {
                    bankTransferDetails.classList.remove('hidden');
                }
            });
        });
    }
    
    // Submit checkout form
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            // Không ngăn chặn submit mặc định để form có thể submit tới server
            console.log("Checkout form submitted");
            
            // Hiển thị thông báo khi cần
            // alert("Đơn hàng của bạn đang được xử lý...");
        });
    }
});