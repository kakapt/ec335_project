<!DOCTYPE html>
<html lang="en">

<head>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BoygangX Supplements</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'primary': '#10b981',
            'primary-dark': '#059669',
            'primary-darker': '#047857',
            'bgdark': '#000000',
          }
        }
      }
    }
  </script>
  <style>
    body {
      background-color: black;
    }

    .product-card {
      background-color: black;
      border: 1px solid #333;
    }

    .green-text {
      color: #10b981;
    }
  </style>
</head>

<body class="bg-black text-white">
  <header class="bg-black shadow-lg sticky top-0 z-50 py-4">
    <div class="container mx-auto px-4 flex items-center justify-between">
      <a href="#" class="text-4xl font-bold">
        BoyGangX <span class="text-primary">Supplements</span>
      </a>

      <div class="block md:hidden">
        <button id="menu-icon" class="text-3xl">
          <i class='bx bx-menu'></i>
        </button>
      </div>

      <ul class="hidden md:flex space-x-8">
        <li><a href="index.php" class="text-primary font-medium">Home</a></li>
        <li><a href="about.php" class="hover:text-primary transition duration-300">About</a></li>
        <li><a href="products.php" class="hover:text-primary transition duration-300">Products</a></li>
        <li><a href="order_summary.php" class="hover:text-primary transition duration-300">Order Summary</a></li>
      </ul>

      <div class="hidden md:block">
        <button id="cart-btn" class="flex items-center border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 px-4 py-2 rounded-lg">
          <i class='bx bx-cart mr-2'></i> Cart <span id="cart-count" class="ml-2 bg-primary text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">0</span>
        </button>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="py-16 px-4 container mx-auto flex flex-col md:flex-row items-center justify-between">
    <div class="md:w-1/2 mb-10 md:mb-0">
      <h3 class="text-xl font-bold mb-2">Build Your</h3>
      <h1 class="text-5xl font-bold mb-4">Dream Physique</h1>
      <h3 class="text-2xl font-semibold mb-4">
        <span id="multiple-text" class="text-primary"></span>
      </h3>
      <p class="text-gray-300 mb-6">Premium supplements to help you achieve your fitness goals</p>
      <a href="products.php" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 inline-block">
        Shop Now
      </a>
    </div>

    <div class="md:w-1/2">
      <!-- Image Slider -->
      <div class="swiper heroSwiper rounded-lg overflow-hidden shadow-lg h-128">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="img/brand-whey.jpg" alt="Hero Image 2" class="w-full h-full object-cover">
          </div>
          <div class="swiper-slide">
            <img src="img/pr-4.webp" alt="Hero Image 3" class="w-full h-full object-cover">
          </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next text-primary"></div>
        <div class="swiper-button-prev text-primary"></div>
      </div>
    </div>
  </section>

  <!-- Featured Products Section -->
  <section class="py-16 px-4 bg-black">
    <div class="container mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">New <span class="text-primary">Products</span></h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php require_once('connect.php') ?>
        <?php
        try {
          $query = "SELECT name, image, info FROM products";
          $results = $db->query($query);

          if ($results) {
            while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
              $product = $row;
        ?>
              <div class="product-card border border-gray-800 rounded-xl overflow-hidden shadow-md transform transition duration-300 hover:shadow-lg hover:scale-105">
                <div class="relative h-48 overflow-hidden">
                  <img src="<?php echo "img/" . htmlspecialchars($product['image']); ?>"
                    alt="<?php echo htmlspecialchars($product['name']); ?>"
                    class="object-cover w-full h-full"
                    onerror="this.onerror=null;this.src='https://placehold.co/400x300/000000/ffffff?text=No+Image';">
                </div>
                <div class="p-4 text-center">
                  <h4 class="text-lg font-bold mb-2"><?php echo htmlspecialchars($product['name']); ?></h4>
                  <a href="products.php" class="text-primary hover:text-primary-dark font-medium">View Details</a>
                </div>
              </div>
        <?php
            }
            $results->finalize();
          } else {
            if ($db->lastErrorCode() !== 0) {
              echo "<p class='col-span-full text-center text-red-500 py-8'>An error occurred while retrieving products.</p>";
            } else {
              echo "<p class='col-span-full text-center text-gray-400 py-8'>No products found.</p>";
            }
          }
        } catch (Exception $e) {
          echo "<p class='col-span-full text-center text-red-500 py-8'>An error occurred: " . htmlspecialchars($e->getMessage()) . "</p>";
        } finally {
          if ($db) {
            $db->close();
          }
        }
        ?>
      </div>

      <div class="text-center mt-10">
        <a href="products.php" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 inline-block">
          View All Products
        </a>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section class="py-16 px-4 bg-black">
    <div class="container mx-auto flex flex-col md:flex-row items-center">
      <div class="md:w-1/2 mb-10 md:mb-0">
        <img src="img/pr-4.webp" alt="About Image" class="rounded-lg shadow-lg max-w-full h-auto">
      </div>

      <div class="md:w-1/2 md:pl-10">
        <h2 class="text-4xl font-bold mb-6">Why <span class="text-primary">Choose Us?</span></h2>
        <div class="space-y-4">
          <div class="flex items-start">
            <i class='bx bx-check-circle text-primary text-2xl mr-4'></i>
            <p class="text-gray-300">Tệp khách hàng đa dạng và tạo dựng niềm tin dựa trên sự hợp tác và chất lượng</p>
          </div>
          <div class="flex items-start">
            <i class='bx bx-check-circle text-primary text-2xl mr-4'></i>
            <p class="text-gray-300">Xây dựng từ những thành viên có đam mê lớn với ngành thể hình</p>
          </div>
          <div class="flex items-start">
            <i class='bx bx-check-circle text-primary text-2xl mr-4'></i>
            <p class="text-gray-300">Tạo dựng được nhiều niềm tin từ các bên cung cấp sản phẩm</p>
          </div>
        </div>
        <a href="#" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 inline-block mt-8">
          Theo dõi ngay
        </a>
      </div>
    </div>
  </section>

  <!-- Pricing Plans Section -->
  <section class="py-16 px-4 bg-black">
    <div class="container mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">Our <span class="text-primary">Plans</span></h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Basic Plan -->
        <div class="border border-gray-800 rounded-xl overflow-hidden shadow-md p-6">
          <h3 class="text-xl font-bold text-center mb-2">BASIC</h3>
          <h2 class="text-2xl font-bold text-center text-primary mb-6">600.000VND/Tháng</h2>
          <ul class="space-y-3 mb-8">
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Sử dụng sản phẩm miễn phí theo ngày (1 gói Whey lẻ và 1 gói Pre-workout lẻ nếu đến hệ thống)</span>
            </li>
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Đo Inbody và nhận tư vấn từ nhân viên</span>
            </li>
          </ul>
          <a href="#" class="flex items-center justify-center bg-transparent border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 px-4 py-2 rounded-lg font-medium">
            Tham gia ngay
            <i class='bx bx-right-arrow-alt ml-2'></i>
          </a>
        </div>

        <!-- Pro Plan -->
        <div class="border border-gray-800 rounded-xl overflow-hidden shadow-md p-6">
          <h3 class="text-xl font-bold text-center mb-2">PRO</h3>
          <h2 class="text-2xl font-bold text-center text-primary mb-6">1.200.000VND/Tháng</h2>
          <ul class="space-y-3 mb-8">
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Sử dụng sản phẩm miễn phí theo ngày (2 gói Whey lẻ và 1 gói Pre-workout lẻ và 1 gói BCAA và 1 viên Zinc nếu đến hệ thống)</span>
            </li>
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Đo Inbody và nhận tư vấn từ nhân viên</span>
            </li>
          </ul>
          <a href="#" class="flex items-center justify-center bg-transparent border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 px-4 py-2 rounded-lg font-medium">
            Tham gia ngay
            <i class='bx bx-right-arrow-alt ml-2'></i>
          </a>
        </div>

        <!-- Premium Plan -->
        <div class="border border-gray-800 rounded-xl overflow-hidden shadow-md p-6">
          <h3 class="text-xl font-bold text-center mb-2">PREMIUM</h3>
          <h2 class="text-2xl font-bold text-center text-primary mb-6">1.500.000VND/Tháng</h2>
          <ul class="space-y-3 mb-8">
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Có thể chọn 1 loại Whey trong các sản phẩm được chọn và được chọn 1 hộp Pre-Workout đi kèm và BCAA và Zinc có thể sử dụng như gói PRO</span>
            </li>
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Đo Inbody và nhận tư vấn từ nhân viên</span>
            </li>
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Hỗ trợ và soạn hành trình tập luyện dựa trên cơ thể của người mua</span>
            </li>
          </ul>
          <a href="#" class="flex items-center justify-center bg-transparent border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 px-4 py-2 rounded-lg font-medium">
            Tham gia ngay
            <i class='bx bx-right-arrow-alt ml-2'></i>
          </a>
        </div>

        <!-- Ultra Premium Plan -->
        <div class="border border-gray-800 rounded-xl overflow-hidden shadow-md p-6">
          <h3 class="text-xl font-bold text-center mb-2">ULTRA PREMIUM</h3>
          <h2 class="text-2xl font-bold text-center text-primary mb-6">2.000.000VND/Tháng</h2>
          <ul class="space-y-3 mb-8">
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Có thể chọn 1 loại Whey trong các sản phẩm được chọn và được chọn 1 hộp Pre-Workout 1 hộp BCAA và 1 hũ Zinc</span>
            </li>
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Đo Inbody và nhận tư vấn từ nhân viên</span>
            </li>
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Hỗ trợ và soạn hành trình tập luyện dựa trên cơ thể của người mua</span>
            </li>
            <li class="flex items-start">
              <i class='bx bx-check text-primary text-xl mr-2'></i>
              <span class="text-gray-300">Được Access sớm vào ứng dụng đo Calories bữa ăn và đo lượng Protein trong thức ăn</span>
            </li>
          </ul>
          <a href="#" class="flex items-center justify-center bg-transparent border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 px-4 py-2 rounded-lg font-medium">
            Tham gia ngay
            <i class='bx bx-right-arrow-alt ml-2'></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Cart Modal -->
  <div id="cart-modal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-80 flex items-center justify-center">
    <div class="bg-black rounded-xl border border-gray-800 shadow-2xl max-w-lg w-full mx-4 overflow-hidden transform transition-all">
      <div class="flex justify-between items-center border-b border-gray-800 p-4">
        <h2 class="text-xl font-bold">Your Cart</h2>
        <button class="close-cart text-2xl hover:text-primary transition duration-300">
          <i class='bx bx-x'></i>
        </button>
      </div>

      <div id="cart-items" class="p-4 max-h-96 overflow-y-auto">
        <!-- Cart items will be populated by JavaScript -->
        <p class="text-center text-gray-400 py-8">Your cart is empty.</p>
      </div>

      <div class="border-t border-gray-800 p-4">
        <div class="flex justify-between items-center mb-4">
          <p class="text-lg">Total:</p>
          <p id="cart-total-price" class="text-lg font-bold text-primary">0 VND</p>
        </div>

        <div class="flex space-x-4">
          <button id="clear-cart" class="flex-1 bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-lg transition duration-300 border border-gray-700">
            Clear Cart
          </button>
          <a href="checkout.php" id="checkout-btn" class="flex-1 bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded-lg transition duration-300 text-center">
            Checkout
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-black py-10 border-t border-gray-900 mt-16">
    <div class="container mx-auto px-4">
      <div class="flex justify-center space-x-6 mb-6">
        <a href="#" class="text-2xl hover:text-primary transition duration-300">
          <i class='bx bxl-facebook'></i>
        </a>
        <a href="#" class="text-2xl hover:text-primary transition duration-300">
          <i class='bx bxl-instagram'></i>
        </a>
        <a href="#" class="text-2xl hover:text-primary transition duration-300">
          <i class='bx bxl-discord'></i>
        </a>
      </div>
      <p class="text-center text-gray-400">
        &copy; BoyGangX Supplements - All Rights Reserved
      </p>
    </div>
  </footer>

  <script src="Mainpage.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

  <!-- Setup and start animation! -->
  <script>
    var typed = new Typed('#multiple-text', {
      strings: ['Whey Protein', 'Creatine', 'Pre-Workout', 'BCAA'],
      typeSpeed: 60,
      backSpeed: 60,
      backDelay: 1000,
      loop: true,
    });

    // Initialize Hero Swiper
    const heroSwiper = new Swiper('.heroSwiper', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
</body>
</html>
