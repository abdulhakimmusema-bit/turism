<?php
$page_title = "Admin Dashboard - Siltie Tour";
$active_page = "dashboard";
include 'admin_header.php';
include 'db.php';
?>

<h1><i class="fa-solid fa-chart-line"></i> Dashboard Overview</h1>

<div class="stats-grid">
    <div class="stat-box users">
        <div class="stat-data">
            <h3>Total Users</h3>
            <h1><?php echo $conn->query("SELECT * FROM users")->num_rows; ?></h1>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
    </div>
    
    <div class="stat-box bookings">
        <div class="stat-data">
            <h3>Total Bookings</h3>
            <h1><?php echo $conn->query("SELECT * FROM bookings")->num_rows; ?></h1>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
    </div>
    
    <div class="stat-box packages">
        <div class="stat-data">
            <h3>Tour Packages</h3>
            <h1><?php echo $conn->query("SELECT * FROM packages")->num_rows; ?></h1>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-map-location-dot"></i></div>
    </div>
    
    <div class="stat-box messages">
        <div class="stat-data">
            <h3>Customer Messages</h3>
            <h1><?php echo $conn->query("SELECT * FROM contact_messages")->num_rows; ?></h1>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
    </div>
</div>

<div class="admin-card">
    <h3>Quick Access Panel</h3>
    <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">Use the side drawer or the buttons below to easily manage booking queries, packages, messages, and users.</p>
    <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
        <a href="manage_packages.php" class="btn"><i class="fa-solid fa-plus"></i> Manage Packages</a>
        <a href="manage_bookings.php" class="btn btn-pay"><i class="fa-solid fa-book"></i> View Bookings</a>
        <a href="view_messages.php" class="btn btn-admin"><i class="fa-solid fa-envelope"></i> Read Messages</a>
    </div>
</div>

<?php include 'admin_footer.php'; ?>