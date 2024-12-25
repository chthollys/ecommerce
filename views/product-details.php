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
                        for ($i = 0; $i < $review_stat['average_rating']; $i++) {
                            if ($review_stat['average_rating'] - $i == 0.5) {
                                echo '<i class="fas fa-star-half-alt"></i>';
                            } else if ($review_stat['average_rating'] - $i > 0.5) {
                                echo '<i class="fas fa-star"></i>';
                            } else {
                                echo '';
                            }
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
                            for ($i = 0.5; $i < $review['rating']; $i++) {
                                echo '<i class="fas fa-star"></i>';
                            }
                            if ($review['rating'] % 1 != 0.5) echo '<i class="fas fa-star-half-alt"></i>';
                        ?>
                    </div>
                </div>
                <div class="review-body">
                    <img src="<?php echo $review['profile_img']?>" alt="Reviewer Profile Pict" class="review-image">
                    <p class="review-comment">"<?php echo $review['text']?>"</p>
                </div>
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

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            const reviews = [
                {
                    name: "Eka",
                    rating: 4.5,
                    comment: "Produk bagus, pengiriman cepat, dan kualitas memuaskan!",
                    image: "image/pd3.png",
                },
                {
                    name: "Baoy",
                    rating: 5,
                    comment: "Saya suka aroma parfumnya. Sangat menyegarkan.",
                    image: "image/pd3.png",
                },
                {
                    name: "Hendra",
                    rating: 4,
                    comment: "Harganya terjangkau dengan kualitas yang sangat baik!",
                    image: "image/pd3.png",
                },
            ];
        
            const reviewContainer = document.querySelector(".user-reviews");
            const loadMoreBtn = reviewContainer.querySelector(".load-more button");
        
            let displayedReviews = 3;
        
            function renderReviews() {
                const reviewsHtml = reviews
                    .slice(0, displayedReviews)
                    .map(
                        (review) => `
                        <div class="review">
                            <div class="review-header">
                                <span class="user-name">${review.name}</span>
                                <div class="user-rating">
                                    ${Array(Math.floor(review.rating))
                                        .fill("<i class='fas fa-star'></i>")
                                        .join("")}
                                    ${review.rating % 1 > 0 ? "<i class='fas fa-star-half-alt'></i>" : ""}
                                </div>
                            </div>
                            <div class="review-body">
                                <img src="${review.image}" alt="Reviewed Product" class="review-image">
                                <p class="review-comment">"${review.comment}"</p>
                            </div>
                        </div>`
                    )
                    .join("");
        
                reviewContainer.insertAdjacentHTML("beforeend", reviewsHtml);
            }
        
            function loadMoreReviews() {
                displayedReviews += 3;
                if (displayedReviews >= reviews.length) {
                    loadMoreBtn.style.display = "none";
                }
                renderReviews();
            }
        
            loadMoreBtn.addEventListener("click", loadMoreReviews);
        
            renderReviews();
        });

        // JavaScript Enhancements

        document.addEventListener("DOMContentLoaded", function () {
        // Highlight selected variant
        const optionButtons = document.querySelectorAll(".option-btn");
        optionButtons.forEach((btn) => {
            btn.addEventListener("click", function () {
                optionButtons.forEach((b) => b.classList.remove("selected"));
                btn.classList.add("selected");
            });
        });

        // Quantity controls
        const quantityInput = document.querySelector(".quantity-controls input");
        const qtyBtns = document.querySelectorAll(".qty-btn");
        qtyBtns.forEach((btn) => {
            btn.addEventListener("click", function () {
                const currentQty = parseInt(quantityInput.value);
                if (btn.textContent === "-" && currentQty > 1) {
                    quantityInput.value = currentQty - 1;
                } else if (btn.textContent === "+") {
                    const maxStock = parseInt(quantityInput.getAttribute("max"));
                    if (currentQty < maxStock) {
                        quantityInput.value = currentQty + 1;
                    }
                }
            });
        });

        // Thumbnail image slider
        const thumbnails = document.querySelectorAll(".thumbnail-images img");
        const mainImage = document.querySelector(".main-image img");
        thumbnails.forEach((thumb) => {
            thumb.addEventListener("click", function () {
                mainImage.src = thumb.src;
            });
        });

        // Button animations
        const buttons = document.querySelectorAll("button");
        buttons.forEach((button) => {
            button.addEventListener("mouseover", () => {
                button.style.transform = "scale(1.05)";
                button.style.transition = "transform 0.3s";
            });

            button.addEventListener("mouseout", () => {
                button.style.transform = "scale(1)";
            });

            button.addEventListener("mousedown", () => {
                button.style.transform = "scale(0.95)";
            });

            button.addEventListener("mouseup", () => {
                button.style.transform = "scale(1)";
            });
        });

        // Sticky navbar on scroll
        const navbar = document.querySelector(".navbar");
        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                navbar.classList.add("sticky");
            } else {
                navbar.classList.remove("sticky");
            }
        });

        // Discount badge animation
        const discountBadge = document.querySelector(".discount-badge");
        if (discountBadge) {
            setInterval(() => {
                discountBadge.style.transform = "scale(1.2)";
                discountBadge.style.transition = "transform 0.3s";
                setTimeout(() => {
                    discountBadge.style.transform = "scale(1)";
                }, 300);
            }, 1000);
        }

        // Lazy loading reviews
        const reviews = [
            // Additional reviews as in the original script
        ];

        const reviewContainer = document.querySelector(".user-reviews");
        const loadMoreBtn = reviewContainer.querySelector(".load-more button");

        let displayedReviews = 3;

        function renderReviews() {
            const reviewsHtml = reviews
                .slice(0, displayedReviews)
                .map(
                    (review) => `
                    <div class="review">
                        <div class="review-header">
                            <span class="user-name">${review.name}</span>
                            <div class="user-rating">
                                ${Array(Math.floor(review.rating))
                                    .fill("<i class='fas fa-star'></i>")
                                    .join("")}
                                ${review.rating % 1 > 0 ? "<i class='fas fa-star-half-alt'></i>" : ""}
                            </div>
                        </div>
                        <div class="review-body">
                            <img src="${review.image}" alt="Reviewed Product" class="review-image">
                            <p class="review-comment">"${review.comment}"</p>
                        </div>
                    </div>`
                )
                .join("");

            reviewContainer.insertAdjacentHTML("beforeend", reviewsHtml);
        }

        function loadMoreReviews() {
            displayedReviews += 3;
            if (displayedReviews >= reviews.length) {
                loadMoreBtn.style.display = "none";
            }
            renderReviews();
        }

        loadMoreBtn.addEventListener("click", loadMoreReviews);

        renderReviews();
        });

        document.addEventListener("DOMContentLoaded", function () {
        const reviews = [
            {
                name: "Eka",
                rating: 4.5,
                comment: "Produk bagus, pengiriman cepat, dan kualitas memuaskan!",
                image: "image/pd3.png",
            },
            {
                name: "Baoy",
                rating: 5,
                comment: "Saya suka aroma parfumnya. Sangat menyegarkan.",
                image: "image/pd3.png",
            },
            {
                name: "Hendra",
                rating: 4,
                comment: "Harganya terjangkau dengan kualitas yang sangat baik!",
                image: "image/pd3.png",
            },
            {
                name: "Rina",
                rating: 5,
                comment: "Parfum ini luar biasa. Saya pasti akan membeli lagi!",
                image: "image/pd3.png",
            },
            {
                name: "Tommy",
                rating: 4,
                comment: "Baunya enak, tapi pengemasan kurang aman.",
                image: "image/pd3.png",
            },
        ];

        const reviewContainer = document.querySelector(".user-reviews");
        const loadMoreBtn = reviewContainer.querySelector(".load-more button");

        let displayedReviews = 3; // Awal jumlah ulasan yang ditampilkan

        // Fungsi untuk merender ulasan
        function renderReviews() {
            const reviewsHtml = reviews
                .slice(0, displayedReviews)
                .map(
                    (review) => `
                        <div class="review">
                            <div class="review-header">
                                <span class="user-name">${review.name}</span>
                                <div class="user-rating">
                                    ${Array(Math.floor(review.rating))
                                        .fill('<i class="fas fa-star"></i>')
                                        .join("")}
                                    ${review.rating % 1 > 0 ? '<i class="fas fa-star-half-alt"></i>' : ""}
                                </div>
                            </div>
                            <div class="review-body">
                                <img src="${review.image}" alt="Reviewed Product" class="review-image">
                                <p class="review-comment">"${review.comment}"</p>
                            </div>
                        </div>`
                )
                .join("");

            reviewContainer.querySelectorAll(".review").forEach((r) => r.remove()); // Bersihkan ulasan lama
            reviewContainer.insertAdjacentHTML("afterbegin", reviewsHtml);
        }

        // Fungsi untuk memuat lebih banyak ulasan
        function loadMoreReviews() {
            displayedReviews += 3; // Tambahkan jumlah ulasan yang ditampilkan
            if (displayedReviews >= reviews.length) {
                displayedReviews = reviews.length; // Maksimal jumlah ulasan
                loadMoreBtn.style.display = "none"; // Sembunyikan tombol jika semua ulasan dimuat
            }
            renderReviews();
        }

        loadMoreBtn.addEventListener("click", loadMoreReviews);

        renderReviews(); // Render ulasan awal
        });

    </script> -->
</body>
</html>