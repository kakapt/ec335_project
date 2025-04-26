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
            <a href="MainPage.html" class="logo"> BoyGangX <span>Supplements</span></a>
            <div class='bx bx-menu' id="menu-icon"></div>
            <ul class="navbar">
                <li> <a href="MainPage.php">Home</a> </li>
                <li> <a href="#">About</a> </li>
                <li> <a href="products.php">Products</a> </li>
                <li> <a href="order_summary.php">Order Summary</a> </li>
            </ul>
            <div class="top-btn">
                <a href="#" class="nav-btn" id="cart-btn">
                    <i class='bx bx-cart'></i> Cart <span id="cart-count">0</span>
                </a>
            </div>
        </header>
        <section>
            <h1>Order Summary</h1>
            <?php
            if (isset($_GET['order_id'])) {
                $order_id = $_GET['order_id'];

                // Use escapeshellarg() to properly escape the user input.
                // This ensures that any metacharacters in $order_id are treated
                // as literal characters by the shell, not as commands or separators.
                $escaped_order_id = escapeshellarg($order_id);

                $command = './cmd/generate_order_summary.sh ' . $escaped_order_id;

                // Execute the command and capture the output
                $output = shell_exec($command);

                echo "<div>";
                if ($output === null) {
                    echo "<pre>An error occur.</pre>";
                } else {
                    echo "<pre style='font-size:20px'>" . htmlspecialchars($output) . "</pre>";
                }
                echo "</div>";

            } else {
                echo "<div>";
                echo "<p>Enter an Order ID to generate a summary.</p>";
                echo "</div>";
            }
            ?>
        </section>
    </body>
</html>
