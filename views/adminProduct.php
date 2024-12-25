<?php
session_start();

include '../config/sessionInfo.php';
include '../private/categoryRegistry.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles/style-admin.css">
    <link rel="stylesheet" href="../public/styles/styleJa.css">
    <title>Admin - Add New Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- Navigation links -->
<header class="header">
    <nav class="navbar">
        <div class="logo">
            <a class="unset" href="../views/home-page.php">
                <i class="fas fa-shopping-bag"></i>
                Lokalaku
            </a>
        </div>
        <div class="nav-links">
            <a class="nav-link active" href="../views/adminProduct.php" >Add Product</a>
            <a class="nav-link" href="../views/editProduct.php">Edit Product</a>
            <a class="nav-link" href="../views/manageOrder-page.php">Manage Orders</a>
            <a href="../views/profile-dashboard.php"><img src="<?php echo $user['profile_img'] ?>" width="50px" height="50px" style="border-radius: 50% ; object-fit: cover"></a>
        </div>
    </nav>
</header>

<div class="container">
    <h1>Admin - Add New Product</h1>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p class="success-message">Product added successfully!</p>
    <?php endif; ?>

    <!-- Product registration form -->
    <form action="../private/adminProductProcess.php" method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price:</label>
        <div class="input-group">
            <span class="input-group-addon">Rp</span>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        
        <label for="image">Image (JPEG, PNG):</label>
        <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" required onchange="previewImage(event)">

        <!-- Image Preview -->
        <img id="imagePreview" src="" alt="Image Preview" style="display:none; max-width: 200px; margin-top: 10px;">

        <label for="category">Category:</label>
        <div class="input-group">
            <span class="input-group-addon resize"></span>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select Category</option>
                <?php foreach ($registered_categories as $category) :?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach;?>
            </select>
        </div>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required cols="60" rows="20"></textarea>

        <button type="submit" name="submit">Add Product</button>
    </form>
</div>

<script>
function previewImage(event) {
    const imageInput = event.target;
    const imagePreview = document.getElementById('imagePreview');

    if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };

        reader.readAsDataURL(imageInput.files[0]);
    } else {
        imagePreview.src = '';
        imagePreview.style.display = 'none';
    }
}

const variationCountInput = document.getElementById('variation_count');
const variationsContainer = document.getElementById('variations-container');

function updateVariations() {
        // Get the current variation count value
        const count = parseInt(variationCountInput.value, 10) || 1;

        // Clear existing variations
        variationsContainer.innerHTML = '';

        // Generate the required number of variations
        for (let i = 1; i <= count; i++) {
            // Create a variation item div
            const variationItem = document.createElement('div');
            variationItem.className = 'variation-item';

            // Create and append the variation name label and input
            const nameLabel = document.createElement('label');
            nameLabel.setAttribute('for', `variation_name-${i}`);
            nameLabel.textContent = `Variation Name-${i}:`;
            variationItem.appendChild(nameLabel);

            const nameInput = document.createElement('input');
            nameInput.type = 'text';
            nameInput.id = `variation_name-${i}`;
            nameInput.name = 'variation_name[]';
            nameInput.required = true;
            variationItem.appendChild(nameInput);

            // Create and append the stocks label and input
            const stocksLabel = document.createElement('label');
            stocksLabel.setAttribute('for', `variation_stock-${i}`);
            stocksLabel.textContent = `Stocks-${i}:`;
            variationItem.appendChild(stocksLabel);

            const stocksInput = document.createElement('input');
            stocksInput.type = 'number';
            stocksInput.id = `variation_stock-${i}`;
            stocksInput.name = 'variation_stock[]';
            stocksInput.step = '1';
            stocksInput.required = true;
            variationItem.appendChild(stocksInput);

            // Append the variation item to the container
            variationsContainer.appendChild(variationItem);
        }
    }

    // Add an event listener to track changes in the variation count input
    variationCountInput.addEventListener('input', updateVariations);

    // Initialize with default value
    updateVariations();
</script>

</body>
</html>
