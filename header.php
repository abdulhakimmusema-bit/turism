<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : "Siltie Tour - Explore Ethiopia"; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Noto+Sans+Ethiopic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="brand">
                <a href="index.php"><i class="fa-solid fa-earth-africa"></i> ስልጤ-Tour</a>
            </div>

            <button class="menu-toggle" aria-label="Toggle Navigation">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="nav-menu">
                <div class="nav-links">
                    <a href="index.php" class="<?php echo (isset($active_page) && $active_page == 'home') ? 'active' : ''; ?>">Home</a>
                    <a href="about.php" class="<?php echo (isset($active_page) && $active_page == 'about') ? 'active' : ''; ?>">About Us</a>
                    <a href="tour_package.php" class="<?php echo (isset($active_page) && $active_page == 'packages') ? 'active' : ''; ?>">Tour Packages</a>
                    <a href="contact.php" class="<?php echo (isset($active_page) && $active_page == 'contact') ? 'active' : ''; ?>">Contact Us</a>
                </div>

                <div class="nav-auth">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="dashboard.php" class="<?php echo (isset($active_page) && $active_page == 'dashboard') ? 'active' : ''; ?>"><i class="fa fa-user"></i> My Dashboard</a>
                        <a href="logout.php" class="btn-logout">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="<?php echo (isset($active_page) && $active_page == 'login') ? 'active' : ''; ?>">Login</a>
                        <a href="register.php" class="btn-register <?php echo (isset($active_page) && $active_page == 'register') ? 'active' : ''; ?>">Register</a>
                        <a href="admin_login.php" class="btn-admin">Admin</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
