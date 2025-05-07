<!DOCTYPE html>
<html lang="en">

<head>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BoygangX WheyWeb - About Us</title>
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

    .timeline-item::before {
      content: '';
      position: absolute;
      left: 18px;
      top: 0;
      height: 100%;
      width: 2px;
      background-color: #10b981;
      z-index: 0;
    }

    .timeline-item:last-child::before {
      height: 50%;
    }

    .timeline-item:first-child::before {
      top: 50%;
      height: 50%;
    }

    .year::before {
      content: '';
      position: absolute;
      left: -30px;
      top: 50%;
      transform: translateY(-50%);
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background-color: #10b981;
      z-index: 1;
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
        <li><a href="index.php" class="hover:text-primary transition duration-300">Home</a></li>
        <li><a href="about.php" class="text-primary font-medium">About</a></li>
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
  <section class="relative py-32 px-4 bg-center bg-cover" style="background-image: url('img/curl.webp');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative z-10 container mx-auto text-center">
      <h1 class="text-5xl font-bold mb-4 text-white">OUR <span class="text-primary">STORY</span></h1>
      <p class="text-xl text-gray-300">Từ những sinh viên đam mê thể hình đến đế chế Gym Supplements</p>
    </div>
  </section>


  <!-- Our Mission Section -->
  <section class="py-16 px-4 bg-black">
    <div class="container mx-auto">
      <div class="flex flex-col md:flex-row items-center gap-10">
        <div class="md:w-1/2">
          <h2 class="text-4xl font-bold mb-6">SỨ <span class="text-primary">MỆNH</span></h2>
          <p class="text-gray-300 mb-4">Tại BoyGangX Supplements, chúng tôi cam kết cung cấp các thực phẩm bổ sung chất lượng cao nhằm giúp những người đam mê thể hình đạt được mục tiêu của mình. Được xây dựng trên nền tảng đam mê thể hình, chúng tôi đã tạo ra những sản phẩm mà chính chúng tôi tin tưởng và sử dụng.</p>
          <p class="text-gray-300">Sứ mệnh của chúng tôi rất đơn giản: mang đến các sản phẩm bổ sung chất lượng cao, được chứng minh bằng khoa học, đồng thời xây dựng mối quan hệ chân thành với cộng đồng của mình.</p>
        </div>
        <div class="md:w-1/2">
          <img src="img/gyming.jpg" alt="Mission Image" class="rounded-lg shadow-lg w-full">
        </div>
      </div>

      <div class="flex flex-col-reverse md:flex-row items-center gap-10 mt-20">
        <div class="md:w-1/2">
          <img src="img/gymin2.png" alt="Team Image" class="rounded-lg shadow-lg w-full">
        </div>
        <div class="md:w-1/2">
          <h2 class="text-4xl font-bold mb-6">ĐỘI NGŨ <span class="text-primary">THÂN THIỆN</span></h2>
          <p class="text-gray-300 mb-4">Chúng tôi tự hào sở hữu một đội ngũ tận tâm, thân thiện và luôn sẵn sàng đồng hành cùng bạn trên hành trình chinh phục thể hình.</p>
          <p class="text-gray-300">Dù bạn mới bắt đầu hay đã có kinh nghiệm, đội ngũ của BoyGangX luôn lắng nghe, hỗ trợ và mang đến lời khuyên chuyên môn để bạn cảm thấy tự tin và có động lực hơn mỗi ngày.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Journey Timeline -->
  <section class="py-16 px-4 bg-black">
    <div class="container mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">OUR <span class="text-primary">JOURNEY</span></h2>

      <div class="max-w-3xl mx-auto">
        <div class="timeline space-y-8">
          <div class="timeline-item relative pl-12">
            <div class="year relative ml-4 text-xl font-bold mb-2 text-primary">2024</div>
            <div class="bg-gray-900 rounded-lg p-6 border border-gray-800">
              <h3 class="text-xl font-bold mb-2">INCEPTION</h3>
              <p class="text-gray-300">BoyGangX Supplements được tạo từ những sinh viên UIT có đam mê với thể hình</p>
            </div>
          </div>

          <div class="timeline-item relative pl-12">
            <div class="year relative ml-4 text-xl font-bold mb-2 text-primary">2025</div>
            <div class="bg-gray-900 rounded-lg p-6 border border-gray-800">
              <h3 class="text-xl font-bold mb-2">SẢN PHẨM ĐẦU TIÊN</h3>
              <p class="text-gray-300">Ra mắt dòng sản phẩm whey protein đầu tiên, được phát triển với sự góp mặt của các huấn luyện viên chuyên nghiệp.</p>
            </div>
          </div>

          <div class="timeline-item relative pl-12">
            <div class="year relative ml-4 text-xl font-bold mb-2 text-primary">2026</div>
            <div class="bg-gray-900 rounded-lg p-6 border border-gray-800">
              <h3 class="text-xl font-bold mb-2">MỞ RỘNG</h3>
              <p class="text-gray-300">Mở rộng dòng sản phẩm của chúng tôi để bao gồm các công thức pre-workout, thực phẩm bổ sung BCAA và nhiều sản phẩm chuyên biệt hơn.</p>
            </div>
          </div>

          <div class="timeline-item relative pl-12">
            <div class="year relative ml-4 text-xl font-bold mb-2 text-primary">2027</div>
            <div class="bg-gray-900 rounded-lg p-6 border border-gray-800">
              <h3 class="text-xl font-bold mb-2">PHÁT TRIỂN CỘNG ĐỒNG</h3>
              <p class="text-gray-300">Xây dựng các gói đăng ký và phát triển một cộng đồng sôi nổi của những người đam mê thể hình.</p>
            </div>
          </div>

          <div class="timeline-item relative pl-12">
            <div class="year relative ml-4 text-xl font-bold mb-2 text-primary">2028</div>
            <div class="bg-gray-900 rounded-lg p-6 border border-gray-800">
              <h3 class="text-xl font-bold mb-2">TIẾN BỘ</h3>
              <p class="text-gray-300">Phát triển ứng dụng di động của chúng tôi để theo dõi dinh dưỡng, lượng protein nạp vào và cá nhân hóa hành trình thể hình.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section class="py-16 px-4 bg-black">
    <div class="container mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">OUR <span class="text-primary">TEAM</span></h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-black border border-gray-800 rounded-xl overflow-hidden shadow-md transform transition duration-300 hover:shadow-lg">
          <div class="h-64 overflow-hidden">
            <img src="img/2.jpg" alt="Team Member" class="w-full h-full object-cover">
          </div>
          <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-1">Đinh Gia Thịnh</h3>
            <p class="text-primary mb-4">Founder & CEO</p>
            <div class="flex justify-center space-x-4">
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-facebook text-xl'></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-instagram text-xl'></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-linkedin text-xl'></i>
              </a>
            </div>
          </div>
        </div>

        <div class="bg-black border border-gray-800 rounded-xl overflow-hidden shadow-md transform transition duration-300 hover:shadow-lg">
          <div class="h-64 overflow-hidden">
            <img src="img/2.jpg" alt="Team Member" class="w-full h-full object-cover">
          </div>
          <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-1">Vũ Phước Thịnh</h3>
            <p class="text-primary mb-4">Founder & CEO</p>
            <div class="flex justify-center space-x-4">
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-facebook text-xl'></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-instagram text-xl'></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-linkedin text-xl'></i>
              </a>
            </div>
          </div>
        </div>

        <div class="bg-black border border-gray-800 rounded-xl overflow-hidden shadow-md transform transition duration-300 hover:shadow-lg">
          <div class="h-64 overflow-hidden">
            <img src="img/2.jpg" alt="Team Member" class="w-full h-full object-cover">
          </div>
          <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-1">Phạm Hoàng Đức Nguyên</h3>
            <p class="text-primary mb-4">Founder & CEO</p>
            <div class="flex justify-center space-x-4">
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-facebook text-xl'></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-instagram text-xl'></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-linkedin text-xl'></i>
              </a>
            </div>
          </div>
        </div>

        <div class="bg-black border border-gray-800 rounded-xl overflow-hidden shadow-md transform transition duration-300 hover:shadow-lg">
          <div class="h-64 overflow-hidden">
            <img src="img/2.jpg" alt="Team Member" class="w-full h-full object-cover">
          </div>
          <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-1">Nguyễn Công Thành</h3>
            <p class="text-primary mb-4">Founder & CEO</p>
            <div class="flex justify-center space-x-4">
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-facebook text-xl'></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-instagram text-xl'></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-primary transition duration-300">
                <i class='bx bxl-linkedin text-xl'></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Values Section -->
  <section class="py-16 px-4 bg-black">
    <div class="container mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">GIÁ TRỊ <span class="text-primary">CỐT LÕI</span></h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 shadow-md transform transition duration-300 hover:shadow-lg">
          <div class="text-primary text-4xl mb-4 flex justify-center">
            <i class='bx bx-check-shield'></i>
          </div>
          <h3 class="text-xl font-bold text-center mb-3">CHẤT LƯỢNG</h3>
          <p class="text-gray-300 text-center">Nguyên liệu cao cấp được chọn lọc từ các nhà cung cấp đáng tin cậy để đảm bảo hiệu quả tối đa.</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 shadow-md transform transition duration-300 hover:shadow-lg">
          <div class="text-primary text-4xl mb-4 flex justify-center">
            <i class='bx bx-bulb'></i>
          </div>
          <h3 class="text-xl font-bold text-center mb-3">ĐỔI MỚI</h3>
          <p class="text-gray-300 text-center">Liên tục nghiên cứu và phát triển các công thức mới để luôn dẫn đầu xu hướng.</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 shadow-md transform transition duration-300 hover:shadow-lg">
          <div class="text-primary text-4xl mb-4 flex justify-center">
            <i class='bx bx-heart'></i>
          </div>
          <h3 class="text-xl font-bold text-center mb-3">ĐAM MÊ</h3>
          <p class="text-gray-300 text-center">Được xây dựng bởi những người đam mê thể hình, những người thực sự hiểu nhu cầu của cộng đồng.</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 shadow-md transform transition duration-300 hover:shadow-lg">
          <div class="text-primary text-4xl mb-4 flex justify-center">
            <i class='bx bx-group'></i>
          </div>
          <h3 class="text-xl font-bold text-center mb-3">CỘNG ĐỒNG</h3>
          <p class="text-gray-300 text-center">Tạo ra một mạng lưới hỗ trợ gồm những cá nhân cùng chí hướng theo đuổi mục tiêu thể hình.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-16 px-4 bg-gray-900">
    <div class="container mx-auto text-center max-w-3xl">
      <h2 class="text-4xl font-bold mb-6">CÙNG BẮT ĐẦU VỚI <span class="text-primary">BOYGANGX</span></h2>
      <p class="text-gray-300 mb-8">Bắt đầu hành trình thể hình của bạn với các sản phẩm bổ sung cao cấp được hỗ trợ bởi khoa học và đam mê.</p>
      <a href="#" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 inline-block">
        Tham gia ngay
      </a>
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
  <footer class="bg-black py-10 border-t border-gray-900">
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
</body>

</html>
