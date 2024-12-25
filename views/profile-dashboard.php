<?php

session_start();
include '../config/sessionInfo.php';

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="../public/styles/style-profile.css">
    <link rel="stylesheet" href="../public/styles/styleJa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header class="header">
    <nav class="navbar">
        <div class="logo">
            <a href="../views/home-page.php" class="unset">
                <i class="fas fa-shopping-bag"></i>
                Lokalaku
            </a>
        </div>
        <div class="nav-links">
            <a class="nav-link" href="../views/cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
            <a class="nav-link" href="../views/orderstatus-page.php">Order Status</a>
            <a class="nav-link" href="../private/logoutProcess.php">Log Out</a>
            
            <!-- Display Admin link only if the user is an admin -->
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <a class="nav-link" href="../views/adminProduct.php" class="active">Admin</a>
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
        <form action="../private/profileProcess.php" method="POST" class="profile-form" enctype="multipart/form-data">
            <label for="profile-picture">Ubah Foto Profil</label>
            <input type="file" id="profile-picture" name="image" accept=".jpg, .jpeg, .png">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="alamat">Alamat</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" pattern="[A-Za-z0-9\s,.\-#/&]+" required>

            <label for="telp">No. Telp</label>
            <input type="text" id="number" name="number" value="<?php echo htmlspecialchars($user['no_telp']); ?>" pattern="[0-9]{8,20}" required>

            <button type="submit">Simpan</button>
        </form>
    </main>       
</body>
</html>
