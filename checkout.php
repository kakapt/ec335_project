<?php
session_start();

// Đồng bộ dữ liệu từ localStorage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cartData'])) {
  $_SESSION['cart'] = json_decode($_POST['cartData'], true);
  exit;
}

$cartItems = $_SESSION['cart'] ?? [];
$subtotal = 0;
foreach ($cartItems as $item) {
  $subtotal += $item['price'] * $item['quantity'];
}

$shipping = 30000;
$tax = $subtotal * 0.1;
$total = $subtotal + $shipping + $tax;
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BoyGangX - Checkout</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Mainpage.css">
    <style>
      /* Checkout Page Styles */
body {
    background: var(--snd-bg-color);
    margin-top:150px;
}

.checkout-container {
    margin-top: 50%;
    min-height: 100vh;
    padding: 12rem 8% 6rem !important; 
    max-width: 1200px;
    margin: 0 auto;
    color: var(--text-color);
    box-sizing: border-box;
}

/* Cart/Order Summary Styles */
.cart-summary {
    background: var(--bg-color);
    border-radius: 2rem;
    padding: 2.5rem;
    border: 1px solid transparent;
    box-shadow: 0 0 5px var(--main-color);
    transition: all 0.3s ease;
    margin-bottom: 2rem;
}

.cart-summary:hover {
    border: 1px solid var(--main-color);
}

.cart-summary h2 {
    font-size: 2.4rem;
    color: var(--text-color);
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #333;
}


.cart-items {
    max-height: 40vh;
    overflow-y: auto;
    margin-bottom: 2rem;
}

.cart-item {
    display: flex;
    gap: 1.5rem;
    padding: 1.5rem 0;
    border-bottom: 1px solid #333;
    align-items: center;
}

.cart-item img {
    width: 8rem;
    height: 8rem;
    border-radius: 1rem;
    object-fit: cover;
}

.item-details {
    flex-grow: 1;
}

.item-details h3 {
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--text-color);
}

.item-price {
    font-size: 1.6rem;
    color: var(--main-color);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.item-quantity {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.qty-btn {
    background: #333;
    color: var(--text-color);
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.6rem;
}

.qty-btn:hover {
    background: var(--main-color);
}

.item-quantity input {
    width: 50px;
    text-align: center;
    background: #222;
    border: 1px solid #444;
    color: var(--text-color);
    padding: 0.5rem;
    border-radius: 0.5rem;
}

.update-btn, .remove-btn {
    background: #333;
    color: var(--text-color);
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.update-btn:hover, .remove-btn:hover {
    background: var(--main-color);
}

.item-total {
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--main-color);
}

.cart-totals {
    margin-top: 2rem;
    border-top: 1px solid #333;
    padding-top: 1.5rem;
}

.total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    font-size: 1.6rem;
    color: var(--text-color);
}

.total-row.grand-total {
    border-top: 1px solid #333;
    padding-top: 1.5rem;
    margin-top: 1.5rem;
    font-size: 2rem;
    font-weight: 700;
    color: var(--main-color);
}

.empty-cart {
    text-align: center;
    padding: 2rem;
}

.empty-cart p {
    font-size: 1.8rem;
    color: #888;
    margin-bottom: 1.5rem;
}

/* Checkout Form Styles */
.checkout-form {
    background: var(--bg-color);
    border-radius: 2rem;
    padding: 3rem;
    border: 1px solid transparent;
    box-shadow: 0 0 5px var(--main-color);
    transition: all 0.3s ease;
}

.checkout-form:hover {
    border: 1px solid var(--main-color);
}

.checkout-form h2 {
    font-size: 2.2rem;
    margin-bottom: 2rem;
    color: var(--text-color);
    position: relative;
    padding-bottom: 1rem;
}

.checkout-form h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 5rem;
    height: 0.3rem;
    background: var(--main-color);
    border-radius: 0.5rem;
}

.form-group {
    margin-bottom: 2rem;
}

.form-row {
    display: flex;
    gap: 2rem;
}

.form-row .form-group {
    flex: 1;
}

.form-group label {
    display: block;
    margin-bottom: 0.8rem;
    font-size: 1.6rem;
    color: var(--text-color);
}

.form-group input {
    width: 100%;
    padding: 1.2rem;
    background: #222;
    border: 1px solid #444;
    border-radius: 0.5rem;
    color: var(--text-color);
    font-size: 1.6rem;
    transition: all 0.3s ease;
}

.form-group input:focus {
    border-color: var(--main-color);
    box-shadow: 0 0 5px var(--main-color);
}

.payment-methods {
    margin-top: 2.5rem;
}

.payment-methods h3 {
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    color: var(--text-color);
}

.payment-option {
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.payment-option input[type="radio"] {
    accent-color: var(--main-color);
}

.payment-option label {
    font-size: 1.6rem;
    color: var(--text-color);
}

.payment-details {
    background: #222;
    border-radius: 1rem;
    padding: 2rem;
    margin-top: 1rem;
    margin-bottom: 2rem;
}

.payment-details p {
    font-size: 1.6rem;
    margin-bottom: 0.8rem;
    color: var(--text-color);
}

.hidden {
    display: none;
}

.form-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 3rem;
}

.btn {
    display: inline-block;
    padding: 1rem 2.8rem;
    background: var(--main-color);
    border-radius: 1rem;
    font-size: 1.6rem;
    color: var(--text-color);
    letter-spacing: 0.1rem;
    font-weight: 600;
    transition: 0.5s ease;
    cursor: pointer;
    border: none;
    text-decoration: none;
}

.btn:hover {
    background: var(--hover-color, #00a2ff);
    box-shadow: 0 0 10px var(--main-color);
}

.secondary-btn {
    background: #333;
}

.secondary-btn:hover {
    background: #444;
    box-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
}

/* Confirmation message */
.confirmation-message {
    text-align: center;
    padding: 3rem;
    background: var(--bg-color);
    border-radius: 2rem;
    border: 1px solid var(--main-color);
    box-shadow: 0 0 10px var(--main-color);
}

.confirmation-message p {
    font-size: 1.8rem;
    color: var(--text-color);
    margin-bottom: 2rem;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .checkout-content {
        flex-direction: column;
    }
}

@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
        gap: 0;
    }
    
    .payment-options {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    .checkout-container {
        padding: 10rem 5% 6rem;
    }
    
    .checkout-form {
        padding: 2rem;
    }
    
    .form-actions {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .form-actions .btn {
        width: 100%;
        margin-bottom: 1rem;
    }
}
/* CHECKOUT PAGE SPECIFIC STYLES */
.checkout-container {
    max-width: 1200px;
    margin: 12rem auto 6rem;
    padding: 0 2rem;
    color: var(--text-color);
}

.checkout-content {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 4rem;
    margin-top: 3rem;
}

.cart-summary, .checkout-form {
    background: var(--bg-color);
    padding: 3rem;
    border-radius: 2rem;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.cart-item {
    display: flex;
    gap: 2rem;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #333;
}

.cart-item img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 1rem;
}

.item-details {
    flex-grow: 1;
}

.form-group {
    margin-bottom: 2rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 1.6rem;
}

.form-group input {
    width: 100%;
    padding: 1rem;
    border: 1px solid #333;
    border-radius: 0.5rem;
    background: var(--snd-bg-color);
    color: var(--text-color);
}

.payment-details {
    margin-top: 2rem;
    padding: 2rem;
    background: var(--snd-bg-color);
    border-radius: 1rem;
}

.hidden {
    display: none;
}

/* Responsive */
@media (max-width: 768px) {
    .checkout-content {
        grid-template-columns: 1fr;
    }
    
    .cart-item {
        flex-direction: column;
    }
    
    .cart-item img {
        width: 100%;
        height: 200px;
    }
}

@media (max-width: 480px) {
    .checkout-container {
        padding: 0 1rem;
    }
    
    .cart-summary, .checkout-form {
        padding: 2rem;
    }
    
    .form-row {
        flex-direction: column;
        gap: 1rem;
    }
}


.products-page {
    min-height: 100vh;
    padding: 12rem 8% 6rem;
    background: var(--snd-bg-color);
}


@media (max-width: 768px) {
    .checkout-container {
        padding: 10rem 5% 6rem !important;
    }
    
    header {
        height: 8rem; /* Điều chỉnh cho mobile */
    }
}
    </style>
  </head>
  <body>
    <header>
      <a href="http://localhost/Whey/Mainpage/index.php" class="logo"> BoyGangX <span>Supplements</span></a>
      <div class='bx bx-menu' id="menu-icon"></div>
      <ul class="navbar">
          <li><a href="index.php">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="http://localhost/Whey/Products%20Page/products.php">Products</a></li>
          <li><a href="#">Review</a></li>
      </ul>
    </header>
      <?php if (isset($confirmationMessage)): ?>
        <div class="confirmation-message">
          <p><?php echo $confirmationMessage; ?></p>
          <a href="http://localhost/Whey/Products%20Page/products.php" class="btn">Continue Shopping</a>
        </div>
      <?php else: ?>

        <div class="checkout-content">
          <div class="cart-summary">
            <h2>Order Summary</h2>
            
            <?php if (empty($cartItems)): ?>
              <div class="empty-cart">
                <p>Your cart is empty</p>
                <a href="http://localhost/Whey/Products%20Page/products.php#" class="btn">Shop Now</a>
              </div>
            <?php else: ?>
              <div class="cart-items">
                <?php foreach ($cartItems as $item): ?>
                  <div class="cart-item">
                    <img src="../Products%20Page/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                    <div class="item-details">
                      <h3><?php echo $item['name']; ?></h3>
                      <p class="item-price"><?php echo number_format($item['price']); ?> VND</p>
                      <div class="item-quantity">
                        <form action="cart_action.php" method="POST" class="update-form">
                          <input type="hidden" name="action" value="update">
                          <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                          <button type="button" class="qty-btn minus">-</button>
                          <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" max="99">
                          <button type="button" class="qty-btn plus">+</button>
                          <button type="submit" class="update-btn">Update</button>
                        </form>
                        <form action="cart_action.php" method="POST" class="remove-form">
                          <input type="hidden" name="action" value="remove">
                          <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                          <button type="submit" class="remove-btn"><i class='bx bx-trash'></i></button>
                        </form>
                      </div>
                    </div>
                    <div class="item-total">
                      <?php echo number_format($item['price'] * $item['quantity']); ?> VND
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              
              <div class="cart-totals">
                <div class="total-row">
                  <span>Subtotal:</span>
                  <span><?php echo number_format($subtotal); ?> VND</span>
                </div>
                <div class="total-row">
                  <span>Shipping:</span>
                  <span><?php echo number_format($shipping); ?> VND</span>
                </div>
                <div class="total-row">
                  <span>Tax (10%):</span>
                  <span><?php echo number_format($tax); ?> VND</span>
                </div>
                <div class="total-row grand-total">
                  <span>Total:</span>
                  <span><?php echo number_format($total); ?> VND</span>
                </div>
              </div>
            <?php endif; ?>
          </div>
          
          <?php if (!empty($cartItems)): ?>
            <div class="checkout-form">
              <h2>Shipping Information</h2>
              <form action="checkout.php" method="POST" id="checkout-form">
                <div class="form-group">
                  <label for="fullname">Full Name</label>
                  <input type="text" id="fullname" name="fullname" required>
                </div>
                
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="tel" id="phone" name="phone" required>
                </div>
                
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" id="address" name="address" required>
                </div>
                
                <div class="form-row">
                  <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" id="postal_code" name="postal_code" required>
                  </div>
                </div>
                
                <div class="payment-methods">
                  <h3>Payment Method</h3>
                  
                  <div class="payment-option">
                    <input type="radio" id="bank-transfer" name="payment-method" value="bank-transfer" checked>
                    <label for="bank-transfer">Bank Transfer</label>
                  </div>
                  
                  <div class="payment-option">
                    <input type="radio" id="credit-card" name="payment-method" value="credit-card">
                    <label for="credit-card">Credit Card</label>
                  </div>
                  
                  <div class="payment-option">
                    <input type="radio" id="paypal" name="payment-method" value="paypal">
                    <label for="paypal">PayPal</label>
                  </div>
                  
                  <!-- Chi tiết thanh toán -->
                  <div id="bank-transfer-details" class="payment-details">
                    <p>Please transfer the total amount to:</p>
                    <p><strong>Bank:</strong> Vietcombank</p>
                    <p><strong>Account:</strong> 1234567890</p>
                    <p><strong>Account Name:</strong> BoyGangX Supplements</p>
                    <p><strong>Reference:</strong> Your order number will be shown after checkout</p>
                  </div>
                  
                  <div id="credit-card-details" class="payment-details hidden">
                    <div class="form-group">
                      <label for="card-number">Card Number</label>
                      <input type="text" id="card-number" placeholder="1234 5678 9012 3456">
                    </div>
                    <div class="form-row">
                      <div class="form-group">
                        <label for="expiry-date">Expiry Date</label>
                        <input type="text" id="expiry-date" placeholder="MM/YY">
                      </div>
                      <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" placeholder="123">
                      </div>
                    </div>
                  </div>
                  
                  <div id="paypal-details" class="payment-details hidden">
                    <p>You will be redirected to PayPal to complete your payment after placing your order.</p>
                  </div>
                </div>
                
                <div class="form-actions">
                  <a href="../Mainpage/products.php" class="btn secondary-btn" id="back-to-cart">Back to Shopping</a>
                  <button type="submit" class="btn checkout-btn" id="place-order-btn">Place Order</button>
                </div>
              </form>
            </div>
          <?php endif; ?>
        </div>
        
      <?php endif; ?>
    </div>

    <!--Footer-->
    <footer class="footer">
      <div class="social">
        <a href="#"><i class="bx bxl-facebook"></i></a>
        <a href="#"><i class="bx bxl-instagram"></i></a>
        <a href="#"><i class="bx bxl-discord"></i></a>
      </div>
      <p class="copyright">
        &copy; BoyGangX Supplements - All Rights Reserved
      </p>
    </footer>

    <script src="checkout.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  </body>
  <script>
// Đồng bộ localStorage với server
window.addEventListener('DOMContentLoaded', () => {
    const cartData = localStorage.getItem('cart');
    
    if (cartData) {
        fetch('checkout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'cartData=' + encodeURIComponent(cartData)
        });
    }
});
</script>
</html>