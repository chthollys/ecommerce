<?php 
    session_start();
    include 'homeProcess.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokalaku - Home</title>
    <link rel="stylesheet" href="./styles-images/styleJa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navigation in home-page.php -->
<header class="header">
    <nav class="navbar">
        <div class="logo">
            <a href="home-page.php" class="unset">
                <i class="fas fa-shopping-bag"></i>
                Lokalaku
            </a>
        </div>
        <div class="nav-links">
            <a href="#featured-products">Products</a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
            <a href="profile-dashboard.php">Profile</a>
            <a href="logoutProcess.php">Log Out</a>

            <!-- Display Admin link only if the user is an admin -->
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <a href="adminProduct.php" class="active">Admin</a>
            <?php endif; ?>
        </div>
    </nav>
</header>


    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Welcome to Lokalaku</h1>
                <p>Discover luxury and style in every purchase</p>
                <a href="products.html" class="cta-button">Shop Now</a>
            </div>
        </section>
        <section class="featured-products" id="featured-products">
            <h2>Our Products</h2>
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="price">Rp<?php echo number_format($product['price'], 2); ?></p>
                        <a href="./product-details.php?id=<?php echo $product['id']; ?>" class="shop-now-btn">Shop Now</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


        <section class="about-us">
            <h2>About Lokalaku</h2>
            <p>Lokalaku is your premier destination for luxury fashion and accessories. We curate the finest products from around the world to bring you unparalleled style and quality.</p>
        </section>
    </main>

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
</body>
</html>