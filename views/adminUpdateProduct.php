<?php

include '../config/sessionInfo.php';
include '../private/product-detailsProcess.php';
include '../private/categoryRegistry.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles/style-admin.css">
    <link rel="stylesheet" href="../public/styles/styleJa.css">
    <title>Admin - Update Product</title>
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
            <a class="nav-link" href="../views/adminProduct.php" >Add Product</a>
            <a class="nav-link active" href="../views/editProduct.php">Edit Product</a>
            <a href="../views/profile-dashboard.php"><img src="<?php echo $user['profile_img'] ?>" width="50px" height="50px" style="border-radius: 50% ; object-fit: cover"></a>
        </div>
    </nav>
</header>

<div class="container">
    <h1>Admin - Update Product</h1>

    <!-- Product registration form -->
    <form action="../private/adminProductUpdateProcess.php" method="POST" enctype="multipart/form-data">
        <!-- Hidden field to store the product ID -->
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <!-- Other product inputs -->
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <?php foreach ($registered_categories as $category): ?>
                <option value="<?php echo $category['id']; ?>" 
                    <?php if ($product['category'] == $category['name']) echo "selected"; ?>>
                    <?php echo $category['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label for="variation_count">Variation Count:</label>
        <input id="variation_count" value="1" min="1" name="variation_count" type="number" required> 
        
        <div id="variations-container">
            <label for="name">Variation Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="price">Stocks:</label>
            <div class="input-group">
                <span class="input-group-addon"></span>
                <input type="number" id="stocks" name="stocks" step="1" required>
            </div>
        </div>

        <label for="image">Current Image:</label>
        <!-- Show current image -->
        <img id="currentImagePreview" src="<?php echo htmlspecialchars($product['image']); ?>" alt="Current Product Image" style="max-width: 200px; margin-top: 10px;">
        <!-- Hidden input to retain the current image path -->
        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($product['image']); ?>">

        <label for="image">Replace Image:</label>
        <!-- File input for replacing the image -->
        <input type="file" id="replaceImage" name="image" accept=".jpg, .jpeg, .png" onchange="previewReplaceImage(event)">
        <!-- Preview for the new image -->
        <img id="replaceImagePreview" alt="New Image Preview" style="display:none; max-width: 200px; margin-top: 10px;">

        <label for="description">Description:</label>
        <textarea id="description" name="description" cols="60" rows="20" required><?php echo $product['description']; ?></textarea>

        <button type="submit" name="submit">Update Product</button>
    </form>

</div>

<script>
function previewImage(event) {
    const imageInput = event.target;
    const imagePreview = document.getElementById('imagePreview');

    if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            imagePreview.src = e.target.result; // Update preview with selected image
        };

        reader.readAsDataURL(imageInput.files[0]);
    }
}

function previewReplaceImage(event) {
    const fileInput = event.target; // The file input element
    const preview = document.getElementById('replaceImagePreview'); // The new image preview element

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader(); // Create a FileReader instance

        reader.onload = function(e) {
            preview.src = e.target.result; // Set the preview image's src to the file's data URL
            preview.style.display = 'block'; // Show the preview image
        };

        reader.readAsDataURL(fileInput.files[0]); // Read the file as a Data URL
    } else {
        preview.style.display = 'none'; // Hide the preview image if no file is selected
        preview.src = ''; // Clear the preview image's src
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
            nameInput.value = 'Normal';
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
            stocksInput.min = 1;
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
