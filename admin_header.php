<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : "Admin Dashboard - Siltie Tour"; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Noto+Sans+Ethiopic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <h3><i class="fa-solid fa-gears"></i> Admin Portal</h3>
                <button class="sidebar-toggle" aria-label="Toggle Sidebar">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <nav class="sidebar-menu">
                <a href="admin_dashboard.php" class="<?php echo (isset($active_page) && $active_page == 'dashboard') ? 'active' : ''; ?>"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
                <a href="manage_packages.php" class="<?php echo (isset($active_page) && $active_page == 'packages') ? 'active' : ''; ?>"><i class="fa-solid fa-map-location-dot"></i> Manage Packages</a>
                <a href="manage_bookings.php" class="<?php echo (isset($active_page) && $active_page == 'bookings') ? 'active' : ''; ?>"><i class="fa-solid fa-book"></i> Manage Bookings</a>
                <a href="manage_users.php" class="<?php echo (isset($active_page) && $active_page == 'users') ? 'active' : ''; ?>"><i class="fa-solid fa-users"></i> Manage Users</a>
                <a href="view_messages.php" class="<?php echo (isset($active_page) && $active_page == 'messages') ? 'active' : ''; ?>"><i class="fa-solid fa-envelope"></i> Manage Messages</a>
                <a href="logout.php" class="btn-logout-admin"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="admin-main">
            <header class="admin-navbar">
                <button class="mobile-sidebar-trigger" aria-label="Open Menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="admin-user-info">
                    <span>Welcome, <strong><?php echo htmlspecialchars($_SESSION['admin_user']); ?></strong></span>
                    <a href="index.php" class="visit-site-link" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> Visit Site</a>
                </div>
            </header>
            <main class="admin-content-inner">
