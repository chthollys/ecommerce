<?php
    session_start();
    include 'cartRegistry.php';
    $total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokalaku - Cart</title>
    <link rel="stylesheet" href="./styles-images/styleJa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <i class="fas fa-shopping-bag"></i>
                Lokalaku
            </div>
            <div class="nav-links">
                <a href="home-page.php">Home</a>
                <a href="home-page.php#featured-products">Products</a>
                <a href="cart.php" class="active"><i class="fas fa-shopping-cart"></i> Cart</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="cart">
            <h2>Shopping Cart</h2>
            <?php foreach($carted_products as $product) : ?>
            <?php $total_price += $product['price']?>
                <div class="cart-items">
                    <div class="cart-item">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($product['product_name']);?></h3>
                            <p class="price">Rp <?php echo htmlspecialchars($product['price']);?></p>
                            <div class="quantity">
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
                            </div>
                        </div>
                        <button class="remove-item"><i class="fas fa-trash"></i> Remove</button>
                    </div>
                    <!-- You can add more cart items here -->
                </div>
            <?php endforeach; ?>
            <div class="cart-summary">
                <h3>Order Summary</h3>
                <div class="summary-item">
                    <span>Subtotal:</span>
                    <span>Rp <?php echo $total_price ?></span>
                </div>
                <!-- <div class="summary-item">
                    <span>Shipping:</span>
                    <span>$10.00</span>
                </div> -->
                <div class="summary-item total">
                    <span>Total:</span>
                    <span>Rp <?php echo $total_price ?></span>
                </div>
            </div>

            <div class="checkout-form">
                <h3>Checkout Details</h3>
                <form action="thank-you.php" method="GET">
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Shipping Address:</label>
                        <textarea id="address" name="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="payment">Payment Method:</label>
                        <select id="payment" name="payment" required>
                            <option value="">Select payment method</option>
                            <option value="credit">Credit Card</option>
                            <option value="debit">Debit Card</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>
                    <button type="submit" class="checkout-btn">Place Order</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>ElegantShop is your premier destination for luxury shopping.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 ElegantShop. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>