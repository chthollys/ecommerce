<?php
    session_start();
    include 'productRegistry.php';
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
                <a href="adminProduct.php">Add Product</a>
                <a href="cart.php" class="active">Delete Product</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="cart">
            <h2>Products</h2>
            <?php foreach($registered_products as $product) : ?>
                <div class="cart-items">
                    <div class="cart-item">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($product['name']);?></h3>
                            <p class="price">Rp <?php echo htmlspecialchars($product['price']);?></p>
                        </div>
                        <!-- Remove button form -->
                        <form action="deleteProductProcess.php" method="post" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <button type="submit" class="remove-item"><i class="fas fa-trash"></i> Remove</button>
                        </form>
                    </div>
                    <!-- You can add more cart items here -->
                </div>
            <?php endforeach; ?>
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
