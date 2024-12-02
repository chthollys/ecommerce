<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="../public/styles/styleJa.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <a href="../views/home-page.php" class="unset">
                    <i class="fas fa-shopping-bag"></i>
                    Lokalaku
                </a>
            </div>
            <div class="nav-links">
                <a href="#featured-products">Products</a>
                <a href="../views/cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
                <a href="../views/profile-dashboard.php">Profile</a>
                <a href="../private/logoutProcess.php">Log Out</a>

                <!-- Display Admin link only if the user is an admin -->
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                    <a href="../views/adminProduct.php" class="active">Admin</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main class="thank-you-container">
        <section class="thank-you">
            <h2>Thank You for Your Order!</h2>
            <p>We appreciate your business and hope you enjoy your purchase.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Lokalaku. All rights reserved.</p>
    </footer>
</body>
</html>