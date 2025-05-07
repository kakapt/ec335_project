<!DOCTYPE html>
<html lang="en">
<head>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BoygangX WheyWeb - Products</title>
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
        <li><a href="index.php" class="hover:text-primary transition duration-300">Home</a></li>
        <li><a href="about.php" class="hover:text-primary transition duration-300">About</a></li>
        <li><a href="products.php" class="text-primary font-medium">Products</a></li>
        <li><a href="order_summary.php" class="hover:text-primary transition duration-300">Order Summary</a></li>
      </ul>

      <div class="hidden md:block">
        <button id="cart-btn" class="flex items-center border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 px-4 py-2 rounded-lg">
          <i class='bx bx-cart mr-2'></i> Cart <span id="cart-count" class="ml-2 bg-primary text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">0</span>
        </button>
      </div>
    </div>
  </header>

  <!-- Products Section -->
  <section class="py-16 px-4">
    <div class="container mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">Our <span class="text-primary">Products</span></h2>

      <!-- Search and Filter Bar -->
      <div class="mb-10 flex flex-col md:flex-row gap-4 justify-between">
        <div class="relative flex-grow max-w-md">
          <input type="text" id="search-input" placeholder="Search products..."
            class="w-full px-4 py-3 pl-10 bg-black border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
          <i class='bx bx-search absolute left-3 top-3.5 text-gray-400'></i>
        </div>

        <div class="flex flex-col sm:flex-row gap-4">
          <select id="category-filter" class="px-4 py-3 bg-black border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary appearance-none">
            <option value="all">All Categories</option>
            <option value="protein">Protein</option>
            <option value="pre-workout">Pre-Workout</option>
            <option value="bcaa">BCAA</option>
            <option value="creatine">Creatine</option>
          </select>

          <select id="sort-filter" class="px-4 py-3 bg-black border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary appearance-none">
            <option value="default">Default Sorting</option>
            <option value="price-low">Price: Low to High</option>
            <option value="price-high">Price: High to Low</option>
            <option value="name-asc">Name: A to Z</option>
            <option value="name-desc">Name: Z to A</option>
          </select>
        </div>
      </div>

      <!-- Products Grid -->
      <div id="products-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php require_once('connect.php') ?>
        <?php
        try {
          $query = "SELECT name, price, image, info FROM products";
          $results = $db->query($query);

          if ($results) {
            while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
              $product = $row;
        ?>
              <div class="product-card border border-gray-800 rounded-xl overflow-hidden shadow-md transform transition duration-300 hover:shadow-lg">
                <div class="relative h-48 overflow-hidden">
                  <img src="<?php echo "img/" . htmlspecialchars($product['image']); ?>"
                    alt="<?php echo htmlspecialchars($product['name']); ?>"
                    class="object-cover w-full h-full"
                    onerror="this.onerror=null;this.src='https://placehold.co/400x300/000000/ffffff?text=No+Image';">
                </div>

                <div class="p-4">
                  <h3 class="text-xl font-bold mb-2 text-center text-white"><?php echo htmlspecialchars($product['name']); ?></h3>

                  <p class="text-primary font-bold text-lg text-center mb-4"><?php echo htmlspecialchars(number_format($product['price'], 0)); ?> VND</p>

                  <div class="flex justify-center">
                    <a href="download.php?info=<?php echo htmlspecialchars($product['info']); ?>"
                      class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-6 rounded-lg transition duration-300 text-center">
                      Download Info
                    </a>
                  </div>
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
  <script src="products.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>
