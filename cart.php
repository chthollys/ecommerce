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
            <?php $total_price += $product['total_price']?>
                <div class="cart-items">
                    <div class="cart-item">
                    <!-- Parsing product checkout qty by price total (status => uncleared)-->
                        <input class="checkbox-product" type="checkbox" data-price="<?php echo $product['total_price'] ?>" checked> 
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($product['product_name']);?></h3>
                            <p class="price">Rp <?php echo number_format($product['price'], 2);?></p>
                            <div class="quantity">
                                <label for="quantity">Quantity:</label>
                                <input readonly type="number" id="quantity" value="<?php echo htmlspecialchars($product['quantity'])?>">
                                <p class="price" style="margin-left: 10px; margin-bottom: 0;"> = Rp <?php echo number_format($product['total_price'], 2);?></p>
                            </div>
                        </div>
                        <form method="post" action="cartRemoval.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']?>">
                            <input name="qty_remove" style="width: 50px;" type="number" id="quantity" min="1" max="<?php echo htmlspecialchars($product['quantity'])?>">
                            <button name="submit" class="remove-item" type="submit"><i class="fas fa-trash"></i> Remove</button>
                        </form>
                    </div>
                    <!-- You can add more cart items here -->
                </div>
            <?php endforeach; ?>
            <div class="cart-summary">
                <h3>Order Summary</h3>
                <div class="summary-item">
                    <span>Subtotal:</span>
                    <span class="total-price">Rp <?php echo number_format($total_price) ?></span>
                </div>
                <!-- <div class="summary-item">
                    <span>Shipping:</span>
                    <span>$10.00</span>
                </div> -->
                <div class="summary-item total">
                    <span>Total:</span>
                    <span class="total-price">Rp <?php echo number_format($total_price) ?></span>
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

<script>
    // JavaScript for real-time price update
    document.addEventListener("DOMContentLoaded", function () {
        const quantityInput = document.getElementById('quantity');
        const priceElement = document.getElementById('total-price');
        const unitPrice = <?php echo $product['price']; ?>;

        // Update the price whenever the input value changes
        quantityInput.addEventListener('input', function () {
            const quantity = parseInt(quantityInput.value) || 1; // Ensure valid number
            const totalPrice = quantity * unitPrice;
            priceElement.textContent = totalPrice.toLocaleString(); // Format number
        });
    });

    // function calculateTotal() {
    //     // Get all checkboxes
    //     const checkboxes = document.querySelectorAll('.checkbox-product');

    //     let total = 0;

    //     // Loop through checkboxes and add the price of checked products
    //     checkboxes.forEach((checkbox) => {
    //         if (checkbox.checked) {
    //             total += parseFloat(checkbox.dataset.price);
    //         }
    //     });

    //     // Update the total price in the DOM
    //     document.querySelectorAll('.total-price').textContent = `Rp ${total.toFixed(2)}`;
    // }

    // // Attach event listeners to all product checkboxes
    // document.querySelectorAll('.checkbox-product').forEach((checkbox) => {
    //     checkbox.addEventListener('change', calculateTotal);
    // });

    // // Initial calculation to set the total price on page load
    // calculateTotal();

</script>

</html>