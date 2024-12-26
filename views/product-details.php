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
                <a href="../views/home-page.php" style="color: unset; text-decoration: none;" ><i class="fas fa-shopping-bag"></i> Lokalaku</a>
            </div>
            <div class="nav-links">
                <a href="../views/cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
                <a href="../views/profile-dashboard.php"><img src="<?php echo htmlspecialchars($user['profile_img'] ?? 0) ?>" width="50px" height="50px" style="border-radius: 50% ; object-fit: cover"></a>            </div>
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
                    <?php
                        $rating_countAV = 0;
                        while ($rating_countAV < $review_stat['average_rating']) {
                            if ($review_stat['average_rating'] - $rating_countAV >= 1) {
                                echo '<i class="fas fa-star"></i>';
                            } else {
                                echo '<i class="fas fa-star-half-alt"></i>';
                            }
                            $rating_countAV += 1;
                        }
                    ?>
                        <span>(<?php echo htmlspecialchars($review_stat['review_count'])?> ulasan)</span>
                    </div>
                    <div class="product-sold">Terjual <?php echo htmlspecialchars($review_stat['sold_count'])?></div>
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
                        <?php foreach ($variation_list as $varian) :?>
                            <button class="option-btn"><?php echo $varian['variation_name'] ?> (<?php echo $varian['variation_stock'] ?>)</button>
                        <?php endforeach;?>
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
                <?php endif; ?>

                <div class="product-actions">
                    <form action="../private/cartProcess.php" method="post" class="product-actions">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <div class="qty-container">
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $product['stocks'] ?>">
                        </div>
                        <div class="qty-container">
                            <label for="varian">Varian:</label>
                            <select id="variation_id" name="variation_id" required>
                                <option value="" disabled selected>Select an option</option>
                            <?php foreach ($variation_list as $varian) :?>
                                <?php if ($varian['variation_stock'] >= 1) : ?>
                                <option value="<?php echo $varian['variation_id'] ?>" data-stock="<?php echo $varian['variation_stock']; ?>"><?php echo $varian['variation_name'] ?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                            </select>
                        </div>
                            <button type="submit" class="add-to-cart" name="add_to_cart">
                            <i class="fas fa-shopping-cart"></i>
                            Tambah Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Seller Bio -->
        <div class="product-description">
            <h3>Seller:</h3>
            <div class="seller-bio">
                <img src="<?php echo htmlspecialchars($product['seller_img'] ?? 0) ?>" width="50px" height="50px" style="border-radius: 50% ; object-fit: cover">
                <p><?php echo $product['seller_name']; ?></p>
            </div>
        </div>

        <!-- Product Description -->
        <div class="product-description">
            <h3>Deskripsi Produk</h3>
            <p>
                <?php echo $product['description']; ?>
            </p>
        </div>

        <!-- User Reviews Section -->
        <div class="user-reviews">
            <h3>Ulasan Pengguna</h3>
            <?php foreach($reviews as $review) :?>
            <div class="review">
                <div class="review-header">
                    <span class="user-name"><?php echo $review['reviewer_name']?></span>
                    <div class="user-rating">
                        <?php
                            $rating_count = 0;
                            while ($rating_count < $review['rating']) {
                                if ($review['rating'] - $rating_count >= 1) {
                                    echo '<i class="fas fa-star"></i>';
                                } else {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                }
                                $rating_count += 1;
                            }
                        ?>
                        <p class="review-comment"><?php echo $review['review_date']?></p>
                    </div>
                </div>
                <div class="review-body">
                    <img src="<?php echo $review['profile_img']?>" alt="Reviewer Profile Pict" class="review-image">
                    <p class="review-comment">"<?php echo $review['text']?>"</p>                </div>
                </div>
            <?php endforeach;?>
            
            <div class="load-more">
                <button>Load More Reviews</button>
            </div>
        </div>
    </main>

    <footer class="footer">
        <!-- Footer content here -->
    </footer>

    <script>
        setTimeout(() => {
            document.getElementById('div-message').style.display = 'none';
        }, 2000);
        document.addEventListener('DOMContentLoaded', () => {
            const variationSelect = document.getElementById('variation_id');
            const quantityInput = document.getElementById('quantity');

            variationSelect.addEventListener('change', () => {
                const selectedOption = variationSelect.options[variationSelect.selectedIndex];
                const maxStock = selectedOption.getAttribute('data-stock');

                // Set the max attribute of the quantity input
                if (maxStock) {
                    quantityInput.setAttribute('max', maxStock);
                    if (parseInt(quantityInput.value) > parseInt(maxStock)) {
                        quantityInput.value = maxStock; // Adjust value if it exceeds max
                    }
                }
            });
        });
</script>
</body>
</html>