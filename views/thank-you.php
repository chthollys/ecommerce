<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="../public/styles/styleJa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                <a href="../views/home-page.php#featured-products" style="color: unset; text-decoration: none" >Products</a>
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