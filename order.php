<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoygangX WheyWeb - Order Summary (Vulnerable Demo)</title> <script src="https://cdn.tailwindcss.com"></script>
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
        .order-output-pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>

<body class="bg-black text-white">
    <header class="bg-black shadow-lg sticky top-0 z-50 py-4">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <a href="MainPage.php" class="text-4xl font-bold">
                BoyGangX <span class="text-primary">Supplements</span>
            </a>

            <div class="block md:hidden">
                <button id="menu-icon" class="text-3xl">
                    <i class='bx bx-menu'></i>
                </button>
            </div>

            <ul class="hidden md:flex space-x-8">
                <li><a href="MainPage.php" class="hover:text-primary transition duration-300">Home</a></li>
                <li><a href="about.php" class="hover:text-primary transition duration-300">About</a></li>
                <li><a href="products.php" class="hover:text-primary transition duration-300">Products</a></li>
                <li><a href="order_summary.php" class="text-primary font-medium">Order Summary</a></li> </ul>

            <div class="hidden md:block">
                <button id="cart-btn" class="flex items-center border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 px-4 py-2 rounded-lg">
                    <i class='bx bx-cart mr-2'></i> Cart <span id="cart-count" class="ml-2 bg-primary text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">0</span>
                </button>
            </div>
        </div>
    </header>

    <section class="py-16 px-4">
        <div class="container mx-auto max-w-2xl"> <h1 class="text-4xl font-bold text-center mb-8">Order <span class="text-primary">Summary</span></h1>

            <?php
            if (isset($_GET['order_id'])) {
                $order_id = $_GET['order_id'];

                $command = './cmd/generate_order_summary.sh ' . $order_id;

                $output = shell_exec($command);

                echo "<div class='bg-black border border-gray-800 p-8 rounded-lg shadow-lg text-left'>";
                if ($output === null) {
                    echo "<pre class='text-red-500 order-output-pre'>An error occurred while generating the summary.</pre>";
                } else {
                    echo "<pre class='text-gray-300 order-output-pre'>" . htmlspecialchars($output) . "</pre>";
                }
                echo "</div>";

            } else {
                echo "<div class='bg-black border border-gray-800 p-8 rounded-lg shadow-lg text-center'>";
                echo "<p class='text-gray-400'>Enter an Order ID to generate a summary.</p>";
                echo "</div>";
            }
            ?>

        </div>
    </section>

    <div id="cart-modal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-80 flex items-center justify-center">
        <div class="bg-black rounded-xl border border-gray-800 shadow-2xl max-w-lg w-full mx-4 overflow-hidden transform transition-all">
            <div class="flex justify-between items-center border-b border-gray-800 p-4">
                <h2 class="text-xl font-bold">Your Cart</h2>
                <button class="close-cart text-2xl hover:text-primary transition duration-300">
                    <i class='bx bx-x'></i>
                </button>
            </div>

            <div id="cart-items" class="p-4 max-h-96 overflow-y-auto">
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
</body>
</html>
