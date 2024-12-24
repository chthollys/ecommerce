<?php 
include '../private/orderStatusProcess.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status - Lokalaku</title>
    <link rel="stylesheet" href="../public/styles/styleJa2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <a href="../views/home-page.php">
                    <i class="fas fa-shopping-bag"></i>
                    Lokalaku
                </a>
            </div>
            <div class="nav-links">
                <a href="../views/home-page.php#featured-products">Products</a>
                <a href="../views/cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
            </div>
        </nav>
    </header>

    <!-- Order Status Section -->
    <main>
        <section class="order-status-section">
            <div class="order-status-container">
                <h1>Order Status</h1>
                <?php foreach($ordered_products as $product): ?>
                    <div class="order-card">
                        <div class="order-info">
                            <img src="<?php echo $product['image']?>" alt="product picture" class="order-image">
                            <p><strong>Order ID:</strong> #<?php echo $product['id'] ?></p>
                            <p><strong>Product:</strong> <?php echo $product['product_name'] ?></p>
                            <p><strong>Ordered on:</strong> <?php echo $product['date'] ?></p>
                        </div>

                        <!-- Order Status Progress -->
                        <div class="order-progress">
                            <div class="status">
                                <div class="status-circle active"></div>
                                <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                                <p>Order Received</p>
                            </div>
                            <div class="status">
                                <div class="status-circle <?php echo ($product['status'] >= 1) ? "active" : "" ?>"></div>
                                <div class="status-icon"><i class="fas <?php echo ($product['status'] >= 1) ? "fa-check-circle" : "fa-cogs" ?>"></i></div>
                                <p>Processing</p>
                            </div>
                            <div class="status">
                                <div class="status-circle <?php echo ($product['status'] >= 2) ? "active" : "" ?>"></div>
                                <div class="status-icon"><i class="fas <?php echo ($product['status'] >= 2) ? "fa-check-circle" : "fa-truck" ?>"></i></div>
                                <p>Shipped</p>
                            </div>
                            <div class="status">
                                <div class="status-circle <?php echo ($product['status'] >= 3) ? "active" : "" ?>"></div>
                                <div class="status-icon"><i class="fas <?php echo ($product['status'] >= 3) ? "fa-check-circle" : "fa-box" ?>"></i></div>
                                <p>Delivered</p>
                            </div>
                        </div>

                        <a><button class="view-order-btn">View Order Details</button></a>
                    </div>
                <?php endforeach;?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Lokalaku is your premier destination for luxury shopping.</p>
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
            <p>&copy; 2024 Lokalaku. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="script1.js"></script>
</body>
</html>
