<?php 
include '../private/manageOrderProcess.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Order - Lokalaku</title>
    <link rel="stylesheet" href="../public/styles/styleJa2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="logo">
            <a href="../views/home-page.php" style="color: unset; text-decoration: none">
                <i class="fas fa-shopping-bag"></i>
                Lokalaku
            </a>
            </div>
            <div class="nav-links">
                <a class="nav-link" href="../views/adminProduct.php">Add Product</a>
                <a class="nav-link" href="../views/editProduct.php" >Edit Product</a>
                <a class="nav-link active" href="../views/manageOrder-page.php">Manage Orders</a>
                <a href="../views/profile-dashboard.php"><img src="./<?php echo $user['profile_img'] ?? 0 ?>" width="50px" height="50px" style="border-radius: 50% ; object-fit: cover"></a>
            </div>
        </nav>
    </header>

    <!-- Order Status Section -->
    <main>
        <section class="order-status-section">
            <div class="order-status-container">
                <h1>Manage Order Status</h1>
                <?php foreach($status_products as $product): ?>
                    <div class="order-card">
                        <div class="order-info">
                            <img src="<?php echo $product['image']?>" alt="product picture" class="order-image">
                            <p><strong>Order ID:</strong> #<?php echo $product['id'] ?></p>
                            <p><strong>Product:</strong> <?php echo $product['product_name'] ?></p>
                            <p><strong>Ordered on:</strong> <?php echo $product['date'] ?></p>
                            <p><strong>Ordered by:</strong> <?php echo $product['customer_name'] ?></p>
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

                        <form action="../private/editOrderProcess.php" method="post" style="display:inline; margin-left: 30px;">
                            <input type="hidden" name="order_id" value="<?php echo $product['id']?>">
                            <label for="status">Update Status:</label>
                            <select id="status" name="status" required>
                                <option value="0" <?php echo ($product['status'] == 0) ? "selected" : ""?> >Order Received</option>
                                <option value="1" <?php echo ($product['status'] == 1) ? "selected" : ""?> >Processing</option>
                                <option value="2"<?php echo ($product['status'] == 2) ? "selected" : ""?> >Shipped (On Delivery)</option>
                                <option value="3"<?php echo ($product['status'] == 3) ? "selected" : ""?> >Delivered</option>
                            </select>
                            <button type="submit" name="update" class="nav-link active">Update</button>
                        </form>
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
