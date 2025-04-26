<!DOCTYPE html>
<html lang="en">
    <head>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="Mainpage.css">
        <link rel="stylesheet" href="products.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BoygangX WheyWeb - Order Summary</title>
    </head>
    <body>
        <header>
            <a href="MainPage.php" class="logo"> BoyGangX <span>Supplements</span></a>
            <div class='bx bx-menu' id="menu-icon"></div>
            <ul class="navbar">
                <li> <a href="MainPage.php">Home</a> </li>
                <li> <a href="about.php">About</a> </li>
                <li> <a href="products.php">Products</a> </li>
                <li> <a href="order_summary.php">Order Summary</a> </li>
            </ul>
            <div class="top-btn">
                <a href="#" class="nav-btn" id="cart-btn">
                    <i class='bx bx-cart'></i> Cart <span id="cart-count">0</span>
                </a>
            </div>
        </header>
        <section style='font-size:20px'>
            <h1>Generate Order Summary</h1>
            <form action="order.php" method="GET">
                <label for="order_id">Enter Order ID:</label>
                <input type="text" id="order_id" name="order_id" placeholder="e.g., 12345">
                <button type="submit">Generate Summary</button>
            </form>
        </section>
    </body>
</html>
