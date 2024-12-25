<?php
include '../private/orderDetailProcess.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="../public/styles/style-orderDetail.css">
    <link rel="stylesheet" href="../public/styles/stylingDetailPage.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>
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
            <a href="../views/home-page.php">Home</a>
            <a href="../views/cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
            <a href="../views/profile-dashboard.php"><img src="./<?php echo $user['profile_img'] ?>" width="50px" height="50px" style="border-radius: 50% ; object-fit: cover"></a>
        </div>
    </nav>
</header>

    <main>
        <section class="order-details-section">
            <div class="order-details-container">
                <div class="order-header">
                    <h1>Order Details</h1>
                </div>
                <div id="orderDetails" class="order-card">
                    <div class="order-image-wrapper">
                        <a href="../views/product-details.php?id=<?php echo $order['product_id']; ?>"><img src="<?php echo $order['image'];?>" alt="<?php echo $order['product_name'];?>" class="order-image"></a>
                    </div>
                    <div class="order-info">
                        <p><strong>Order ID:</strong> #<?php echo $order['id'];?></p>
                        <p><strong>Product:</strong> <?php echo $order['product_name'];?></p>
                        <p><strong>Product Category:</strong> <?php echo $order['category'];?></p>
                        <p><strong>Ordered on:</strong> <?php echo $order['date'];?></p>
                        <p><strong>Status:</strong> <span class="status-label">
                        <?php 
                            if($order['status'] == 0) echo "Order Received";
                            if($order['status'] == 1) echo "Processing Order";
                            if($order['status'] == 2) echo "On Delivery";
                            if($order['status'] == 3) echo "Order Delivered";
                        ?>
                        </span></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($order['description']);?></p>
                    <?php if ($order['status'] == 3) :?>
                        <p><strong>Review:</strong></p>
                        <form action="../private/reviewProcess.php" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $_GET['order_id'] ?? -1 ?>">
                            <select name="rating" style="margin-bottom: 20px;">
                            <?php for($i = 0; $i <= 5; $i+= 0.5) :?>
                                <option value="<?php echo $i ?>" <?php if ($order['review_rating'] == $i) echo "selected" ?>>
                                    <?php echo $i ?> &#11088
                                </option>
                            <?php endfor;?>
                            </select>    
                            <textarea id="review" name="review" cols="60" rows="20"><?php echo $order['review_text']; ?></textarea>
                            <button class="back-button" type="submit" name="submit">Upload Review</button>
                        </form>
                    <?php endif;?>
                    </div>
                </div>
                <a href="../views/orderstatus-page.php" class="back-button">Back to Order Status</a>
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

    <!-- <script>
        // Ambil parameter dari URL
        const params = new URLSearchParams(window.location.search);
        const orderId = params.get("orderId");

        // Data dummy untuk demo (bisa dihubungkan dengan API)
        const orders = {
            "123456": {
                id: "123456",
                product: "Parfum",
                date: "1st December 2024",
                status: "Delivered",
                image: "image/pd3.png",
                description: "A luxurious fragrance with a long-lasting scent. Perfect for all occasions."
            }
        };

        // Tampilkan detail order
        const order = orders[orderId];
        const orderDetailsContainer = document.getElementById("orderDetails");

        if (order) {
            orderDetailsContainer.innerHTML = `
                <div class="order-image-wrapper">
                    <img src="${order.image}" alt="${order.product}" class="order-image">
                </div>
                <div class="order-info">
                    <p><strong>Order ID:</strong> ${order.id}</p>
                    <p><strong>Product:</strong> ${order.product}</p>
                    <p><strong>Ordered on:</strong> ${order.date}</p>
                    <p><strong>Status:</strong> <span class="status-label">${order.status}</span></p>
                    <p><strong>Description:</strong> ${order.description}</p>
                </div>
            `;
        } else {
            orderDetailsContainer.innerHTML = "<p>Order not found. Please check the order ID.</p>";
        }
    </script> -->
</body>
</html>
