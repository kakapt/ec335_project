<!DOCTYPE html>
<html lang="en">
  <head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Mainpage.css">
    <link rel="stylesheet" href="products.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BoygangX WheyWeb - Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .product-card {
            border: 1px solid #e2e8f0; /* Tailwind border-gray-200 */
            border-radius: 0.5rem; /* Tailwind rounded-md */
            padding: 1rem; /* Tailwind p-4 */
            margin: 1rem; /* Tailwind m-4 */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
        }
        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 0.25rem; /* Tailwind rounded-sm */
            margin-bottom: 0.5rem; /* Tailwind mb-2 */
        }
        /* Enhanced Style for the download button */
        .download-button {
            display: inline-block;
            background-color: #10b981; /* Tailwind emerald-500 - a more distinct green */
            color: white;
            padding: 0.75rem 1.5rem; /* Increased padding */
            border-radius: 0.5rem; /* More rounded corners */
            text-decoration: none; /* Remove underline from link */
            margin-top: 0.75rem; /* Increased top margin */
            transition: background-color 0.2s ease-in-out, transform 0.1s ease-in-out; /* Added transform transition */
            font-weight: bold; /* Make text bold */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add shadow to button */
        }
        .download-button:hover {
            background-color: #059669; /* Tailwind emerald-600 on hover */
            transform: translateY(-1px); /* Subtle lift effect on hover */
        }
         .download-button:active {
            background-color: #047857; /* Tailwind emerald-700 on active */
            transform: translateY(0); /* Remove lift effect when clicked */
        }
    </style>
  </head>
  <body>
    <header>
      <a href="MainPage.html" class="logo"> BoyGangX <span>Supplements</span></a>

      <div class='bx bx-menu' id="menu-icon"></div>

      <ul class="navbar">
          <li> <a href="MainPage.php">Home</a> </li>
          <li> <a href="#">About</a> </li>
          <li> <a href="products.php">Products</a> </li>
          <li> <a href="#">Review</a> </li>
      </ul>

      <div class="top-btn">
    <a href="#" class="nav-btn" id="cart-btn">
      <i class='bx bx-cart'></i> Cart <span id="cart-count">0</span>
    </a>
</div>
    </header>
    
    <!-- Products Section -->
    <section class="products-page" id="products-page">
      <h2 class="heading">Our <span>Products</span></h2>
      
      <div class="filter-container">
        <div class="search-box">
          <input type="text" id="search-input" placeholder="Search products...">
          <button id="search-btn"><i class='bx bx-search'></i></button>
        </div>
        <div class="filter-options">
          <select id="category-filter">
            <option value="all">All Categories</option>
            <option value="protein">Protein</option>
            <option value="pre-workout">Pre-Workout</option>
            <option value="bcaa">BCAA</option>
            <option value="creatine">Creatine</option>
          </select>
          <select id="sort-filter">
            <option value="default">Default Sorting</option>
            <option value="price-low">Price: Low to High</option>
            <option value="price-high">Price: High to Low</option>
            <option value="name-asc">Name: A to Z</option>
            <option value="name-desc">Name: Z to A</option>
          </select>
        </div>
      </div>
      
      <div class="products-container" id="products-container">
        <!-- Product items will be populated by JavaScript -->
        <?php require_once('connect.php') ?>
        <?php
            try {
                $query = "SELECT name, price, image, info FROM products";
                $results = $db->query($query);

                if ($results) {
                    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                        $product = $row;
                        ?>
                            <div class="product-card bg-white shadow-md">
                            <img src="<?php echo "img/" . htmlspecialchars($product['image']); ?>"
                                 alt="<?php echo htmlspecialchars($product['name']); ?>"
                                 class="product-image"
                                 onerror="this.onerror=null;this.src='https://placehold.co/200x200/E2E8F0/000000?text=No+Image';">

                            <h2 class="text-xl font-semibold mb-1 text-gray-800 text-center"><?php echo htmlspecialchars($product['name']); ?></h2>

                            <p class="text-gray-700 mb-2">VND<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></p>

                            <a href="download.php?info=<?php echo htmlspecialchars($product['info']); ?>" class="download-button">Download Info</a>

                            </div>
                        <?php
                    }
                    $results->finalize();
                } else {
                     if ($db->lastErrorCode() !== 0) {
                         echo "<p>An error occur" . "</p>";
                     } else {
                        echo "<p>No products found.</p>";
                     }
                }

            } catch (Exception $e) {
                // Handle database connection or other exceptions
                echo "<p class='col-span-full text-center text-red-500'>An error occurred: " . htmlspecialchars($e->getMessage()) . "</p>";
            } finally {
                // Close the database connection if it was opened
                if ($db) {
                    $db->close();
                }
            }
        ?>
      </div>
    </section>
    
    <!-- Cart Modal -->
    <div id="cart-modal" class="cart-modal">
      <div class="cart-content">
        <div class="cart-header">
          <h2>Your Cart</h2>
          <span class="close-cart">&times;</span>
        </div>
        <div class="cart-items" id="cart-items">
          <!-- Cart items will be populated by JavaScript -->
        </div>
        <div class="cart-footer">
          <div class="cart-total">
            <p>Total: <span id="cart-total-price">0 VND</span></p>
          </div>  
          <div class="cart-buttons">
     <button id="clear-cart" class="btn-secondary">Clear Cart</button>
     <a href="checkout.php" class="btn" id="checkout-btn">Checkout</a>
     </div>
        </div>
      </div>
    </div>

    <!--Footer-->
    <footer class="footer">
      <div class="social">
        <a href="#"> <i class="bx bxl-facebook"></i> </a>
        <a href="#"> <i class="bx bxl-instagram"></i> </a>
        <a href="#"> <i class="bx bxl-discord"></i> </a>
      </div>
      <p class="copyright">
        &copy; BoyGangX Supplements - All Rights Reserved
      </p>
    </footer>
    
    <script src="Mainpage.js"></script>
    <script src="products.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  </body>
</html>
