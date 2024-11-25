<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'e-commerce_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$profile_image = isset($_SESSION['profile_img']) ? $_SESSION['profile_img'] : 0;

// Fetching profile pict
$stmt2 = mysqli_prepare($conn, "SELECT profile_img from user WHERE id = ? ");
mysqli_stmt_bind_param($stmt2, 'i', $user_id);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$profile_img = mysqli_fetch_assoc($result2);

if (!$profile_img) {
    echo "Profile picture not found.";
    exit();
}
mysqli_stmt_close($stmt2);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles-images/style-admin.css">
    <link rel="stylesheet" href="./styles-images/styleJa.css">
    <title>Admin - Add New Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- Navigation links -->
<header class="header">
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-shopping-bag"></i>
            Lokalaku
        </div>
        <div class="nav-links">
            <a class="nav-link" href="home-page.php" >Home</a>
            <a class="nav-link active" href="adminProduct.php" >Add Product</a>
            <a class="nav-link" href="deleteProduct.php">Delete Product</a>
            <a href="profile-dashboard.php"><img src="./<?php echo $profile_image ?>" width="50px" height="50px" style="border-radius: 50% ; object-fit: cover"></a>
        </div>
    </nav>
</header>

<div class="container">
    <h1>Admin - Add New Product</h1>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p class="success-message">Product added successfully!</p>
    <?php endif; ?>

    <!-- Product registration form -->
    <form action="adminProductProcess.php" method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price:</label>
        <div class="input-group">
            <span class="input-group-addon">Rp</span>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>

        <label for="image">Image (JPEG, PNG):</label>
        <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" required>

        <label for="category">Category:</label>
        <div class="input-group">
            <span class="input-group-addon"></span>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select Category</option>
                <option value="Fashion & Apparel">Fashion & Apparel</option>
                <option value="Electronics & Gadgets">Electronics & Gadgets</option>
                <option value="Home & Kitchen">Home & Kitchen</option>
                <option value="Health & Beauty">Health & Beauty</option>
                <option value="Books, Movies, & Media">Books, Movies, & Media</option>
                <option value="Sports & Outdoor">Sports & Outdoor</option>
                <option value="Food & Beverage">Food & Beverage</option>
                <option value="Games & Hobbies">Games & Hobbies</option>
            </select>
        </div>

        <label for="price">Stocks:</label>
        <div class="input-group">
            <span class="input-group-addon"></span>
            <input type="number" id="stocks" name="stocks" step="1" required>
        </div>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required cols="50" rows="4"></textarea>

        <button type="submit" name="submit">Add Product</button>
    </form>
</div>

</body>
</html>
