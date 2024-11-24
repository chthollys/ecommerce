<?php
session_start();
$user_id = $_SESSION['user_id'];

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'e-commerce_db');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Prepare and execute the SQL statement to get user information
$stmt = mysqli_prepare($conn, "SELECT name, email, no_telp, address, profile_img FROM user WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result); // Fetch a single row as an associative array

if (!$user) {
    echo "No user found in your registry.";
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="./styles-images/style-profile.css">
    <link rel="stylesheet" href="./styles-images/styleJa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header class="header">
    <nav class="navbar">
        <div class="logo">
            <a href="home-page.php" class="unset">
                <i class="fas fa-shopping-bag"></i>
                Lokalaku
            </a>
        </div>
        <div class="nav-links">
            <a class="nav-link" href="logoutProcess.php">Log Out</a>

            <!-- Display Admin link only if the user is an admin -->
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <a class="nav-link" href="adminProduct.php" class="active">Admin</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
    <main class="profile-container">
        <div class="profile-picture">
            <?php if (isset($user['profile_img']) && !empty($user['profile_img'])): ?>
                <img src="<?php echo htmlspecialchars($user['profile_img']); ?>" alt="Foto Profil">
            <?php else: ?>
                <img src="https://s3.amazonaws.com/37assets/svn/765-default-avatar.png" alt="Foto Profil">
            <?php endif; ?>
        </div>

        <!-- Form with user data -->
        <form action="profileProcess.php" method="POST" class="profile-form" enctype="multipart/form-data">
            <label for="profile-picture">Ubah Foto Profil</label>
            <input type="file" id="profile-picture" name="image" accept=".jpg, .jpeg, .png">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="alamat">Alamat</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>

            <label for="telp">No. Telp</label>
            <input type="text" id="number" name="number" value="<?php echo htmlspecialchars($user['no_telp']); ?>" required>

            <button type="submit">Simpan</button>
        </form>
    </main>       
</body>
</html>
