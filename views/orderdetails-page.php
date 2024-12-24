<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Isolasi CSS untuk halaman order details */
        .order-details-section {
            padding: 3rem 1rem;
            background-color: var(--light-gray);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .order-details-container {
            max-width: 900px;
            width: 100%;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }

        .order-header {
            background: var(--secondary-color);
            color: var(--white);
            padding: 1.5rem;
            text-align: center;
        }

        .order-header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .order-card {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            padding: 2rem;
            align-items: center;
        }

        .order-image-wrapper {
            flex: 1;
            max-width: 300px;
        }

        .order-image {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .order-image:hover {
            transform: scale(1.05);
        }

        .order-info {
            flex: 2;
            color: var(--text-color);
        }

        .order-info p {
            margin-bottom: 1rem;
        }

        .order-info .status-label {
            font-weight: bold;
            color: var(--accent-color);
            text-transform: capitalize;
        }

        .back-button {
            display: inline-block;
            margin: 2rem auto 0;
            padding: 0.8rem 1.5rem;
            background: var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: 4px;
            font-size: 1rem;
            text-align: center;
            transition: background 0.3s ease;
        }

        .back-button:hover {
            background: #34495e;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<!-- Header -->
<header class="header">
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-shopping-bag"></i>
            Lokalaku
        </div>
        <div class="nav-links">
            <a href="index.html">Home</a>
            <a href="products.html">Products</a>
            <a href="cart.html"><i class="fas fa-shopping-cart"></i> Cart</a>
            <a href="profile.html">Profile</a>
        </div>
    </nav>
</header>

    <main>
        <section class="order-details-section">
            <div class="order-details-container">
                <div class="order-header">
                    <h1>Order Details</h1>
                </div>
                <div id="orderDetails" class="order-card"></div>
                <a href="orderstatus.html" class="back-button">Back to Order Status</a>
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

    <script>
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
    </script>
</body>
</html>
