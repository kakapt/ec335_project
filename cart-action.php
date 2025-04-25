<?php
session_start();

$action = $_POST['action'] ?? '';
$product_id = (int)($_POST['product_id'] ?? 0);
$quantity = (int)($_POST['quantity'] ?? 1);

// Khởi tạo giỏ hàng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$response = [
    'success' => false,
    'cartCount' => 0,
    'cart' => []
];

try {
    switch ($action) {
        case 'add':
            // Giả sử có hàm getProductDetails từ database
            $product = getProductDetails($product_id);
            
            if ($product) {
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
                } else {
                    $_SESSION['cart'][$product_id] = [
                        'id' => $product_id,
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'image' => $product['image'],
                        'quantity' => $quantity
                    ];
                }
                $response['success'] = true;
            }
            break;
            
        case 'update':
            // Xử lý cập nhật số lượng
            break;
            
        case 'remove':
            // Xử lý xóa sản phẩm
            break;
    }

    // Tính toán lại tổng số lượng
    $response['cartCount'] = array_sum(array_column($_SESSION['cart'], 'quantity'));
    $response['cart'] = $_SESSION['cart'];

} catch (Exception $e) {
    http_response_code(500);
    $response['error'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);

// Hàm giả lập lấy thông tin sản phẩm
function getProductDetails($product_id) {
    $products = [
        1 => ['name' => 'Whey Protein', 'price' => 1000000, 'image' => 'images/whey.jpg'],
        2 => ['name' => 'Pre-Workout', 'price' => 800000, 'image' => 'images/preworkout.jpg'],
        // Thêm các sản phẩm khác
    ];
    
    return $products[$product_id] ?? null;
}