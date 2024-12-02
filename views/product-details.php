<?php
include '../config/sessionInfo.php';
include '../private/product-detailsProcess.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokalaku - Product Detail</title>
    <link rel="stylesheet" href="../public/styles/style-detailproduct.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <a href="../views/home-page.php"><i class="fas fa-shopping-bag"></i> Lokalaku</a>
            </div>
            <div class="nav-links">
                <a href="../views/cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
                <a href="../views/profile-dashboard.php"><img src="./<?php echo htmlspecialchars($user['profile_img'] ?? 0) ?>" width="50px" height="50px" style="border-radius: 50% ; object-fit: cover"></a>            </div>
        </nav>
    </header>
    

    <main class="product-detail-container">
        <div class="product-detail-wrapper">
            <!-- Product Images Section -->
            <div class="product-images">
                <div class="main-image">
                    <img src="<?php echo htmlspecialchars($product['image'])?>" alt="<?php echo htmlspecialchars($product['name'])?>">
                </div>
                <div class="thumbnail-images">
                    <img src="<?php echo htmlspecialchars($product['image'])?>" alt="<?php echo htmlspecialchars($product['name'])?>">
                    <img src="<?php echo htmlspecialchars($product['image'])?>" alt="<?php echo htmlspecialchars($product['name'])?>">
                    <img src="<?php echo htmlspecialchars($product['image'])?>" alt="<?php echo htmlspecialchars($product['name'])?>">
                </div>
            </div>

            <!-- Product Info Section -->
            <div class="product-info">
                <h1 class="product-title"><?php echo htmlspecialchars($product['name']) ?></h1>
                <div class="product-meta">
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span>(150 ulasan)</span>
                    </div>
                    <div class="product-sold">Terjual 500+</div>
                    <div class="product-sold"><?php echo htmlspecialchars($product['category']) ?></div>
                </div>

                <div class="product-price">
                    <span class="price">Rp<?php echo number_format($product['price'], 2)?></span>
                </div>

                Product Options
                <div class="product-options">
                    <div class="option-group">
                        <h3>Pilih Varian</h3>
                        <div class="option-buttons">
                            <button class="option-btn">Hitam</button>
                            <button class="option-btn">Putih</button>
                            <button class="option-btn">Merah</button>
                        </div>
                    </div>

                    <div class="quantity-selector">
                        <h3>Jumlah</h3>
                        <div class="quantity-controls">
                            <span class="stock-info">Stok: <?php echo htmlspecialchars($product['stocks'])?></span>
                        </div>
                    </div>
                </div>

                <?php if (isset($_GET['added']) && $_GET['added'] == 'true'): ?>
                    <div class="add-message" id="div-message">
                        Product successfully added to the cart!
                    </div>
                    <script>
                        setTimeout(() => {
                            document.getElementById('div-message').style.display = 'none';
                        }, 2000);
                    </script>
                <?php endif; ?>

                <div class="product-actions">
                    <form action="../private/cartProcess.php" method="post" class="product-actions">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="action" value="add_to_cart">
                        <div class="qty-container">
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $product['stocks'] ?>">
                        </div>
                            <button type="submit" class="add-to-cart" name="add_to_cart">
                            <i class="fas fa-shopping-cart"></i>
                            Tambah Keranjang
                        </button>
                    </form>
                </div>
                <!-- Action Buttons 
                <div class="product-actions">
                    <button class="add-to-cart">
                        
                        Tambah ke Keranjang
                    </button>
                    <button class="buy-now">
                        Beli Sekarang
                    </button>
                </div> -->
            </div>
        </div>

        <!-- Product Description -->
        <div class="product-description">
            <h3>Deskripsi Produk</h3>
            <p><?php echo nl2br(htmlspecialchars($product['description'])) ?></p>
        </div>
    </main>

    <footer class="footer">
        <!-- Footer content here -->
    </footer>
</body>
</html>