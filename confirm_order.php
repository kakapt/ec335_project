<?php
session_start();

// Lấy giỏ hàng từ session (nếu có)
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Tính toán đơn hàng
$subtotal = 0;
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shipping = ($subtotal > 1000000) ? 0 : 50000;
$tax = round($subtotal * 0.1);
$total = $subtotal + $shipping + $tax;

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin người dùng từ form
    $fullname    = $_POST['fullname']    ?? '';
    $email       = $_POST['email']       ?? '';
    $phone       = $_POST['phone']       ?? '';
    $address     = $_POST['address']     ?? '';
    $city        = $_POST['city']        ?? '';
    $postal_code = $_POST['postal_code'] ?? '';

    // (Tại đây bạn có thể lưu đơn hàng vào CSDL nếu cần)

    // Tạo mã đơn hàng ngẫu nhiên (ví dụ đơn giản)
    $orderReference = "BG-" . rand(10000, 99999);

    // Sau khi xử lý đơn hàng thành công, xóa giỏ hàng
    unset($_SESSION['cart']);

    // Hiển thị thông báo xác nhận đơn hàng
    $confirmationMessage = "Your order has been confirmed! Order reference: $orderReference";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Confirm Order</title>
    <link rel="stylesheet" href="checkout.css">
    <style>
      body { font-family: Arial, sans-serif; padding: 20px; }
      .order-summary, .order-form { margin-bottom: 30px; }
      label { display: block; margin-top: 10px; }
      input { padding: 5px; width: 100%; max-width: 300px; }
      button { margin-top: 15px; padding: 10px 20px; }
      .confirmation { padding: 15px; background: #e0ffe0; border: 1px solid #00aa00; margin-bottom: 20px; }
    </style>
  </head>
  <body>
    <h1>Confirm Your Order</h1>

    <?php if (isset($confirmationMessage)): ?>
      <div class="confirmation">
        <p><?php echo $confirmationMessage; ?></p>
      </div>
      <p><a href="products.php">Back to Products</a></p>
    <?php else: ?>
      <div class="order-summary">
        <h2>Order Summary</h2>
        <?php if (empty($cartItems)): ?>
          <p>Your cart is empty.</p>
        <?php else: ?>
          <ul>
            <?php foreach ($cartItems as $item): ?>
              <li>
                <?php echo $item['name']; ?> (x<?php echo $item['quantity']; ?>) - 
                <?php echo number_format($item['price'] * $item['quantity']); ?> VND
              </li>
            <?php endforeach; ?>
          </ul>
          <p><strong>Subtotal:</strong> <?php echo number_format($subtotal); ?> VND</p>
          <p><strong>Shipping:</strong> <?php echo number_format($shipping); ?> VND</p>
          <p><strong>Tax:</strong> <?php echo number_format($tax); ?> VND</p>
          <p><strong>Total:</strong> <?php echo number_format($total); ?> VND</p>
        <?php endif; ?>
      </div>
      
      <?php if (!empty($cartItems)): ?>
      <div class="order-form">
        <h2>Shipping Information</h2>
        <form action="" method="POST">
          <label for="fullname">Full Name</label>
          <input type="text" id="fullname" name="fullname" required>
          
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
          
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" required>
          
          <label for="address">Address</label>
          <input type="text" id="address" name="address" required>
          
          <label for="city">City</label>
          <input type="text" id="city" name="city" required>
          
          <label for="postal_code">Postal Code</label>
          <input type="text" id="postal_code" name="postal_code" required>
          
          <button type="submit">Confirm Order</button>
        </form>
      </div>
      <?php else: ?>
        <p><a href="products.php">Back to Products</a></p>
      <?php endif; ?>
    <?php endif; ?>
  </body>
</html>
