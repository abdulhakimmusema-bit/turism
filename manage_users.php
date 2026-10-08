<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) { header("Location: admin_login.php"); exit; }

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $conn->query("DELETE FROM payments WHERE booking_id IN (SELECT booking_id FROM bookings WHERE user_id=$id)");
    $conn->query("DELETE FROM bookings WHERE user_id=$id");

    if($conn->query("DELETE FROM users WHERE user_id=$id")) {
        echo "<script>alert('User and all their history deleted successfully!'); window.location='manage_users.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting user: " . $conn->error . "'); window.location='manage_users.php';</script>";
    }
}

$page_title = "Manage Users - Siltie Tour";
$active_page = "users";
include 'admin_header.php';
?>

<h1><i class="fa-solid fa-users"></i> Manage Registered Users</h1>

<div class="admin-card">
    <h3>Registered Users List</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Registered Date</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM users ORDER BY user_id DESC";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>#<?php echo $row['user_id']; ?></td>
                            <td style="font-weight: 600; color: var(--text-primary);"><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                            <td style="text-align: right;">
                                <a href="manage_users.php?delete=<?php echo $row['user_id']; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this user? All their bookings and payment history will be deleted.');" 
                                   style="color: #ef4444; font-weight: 600;"><i class="fa-solid fa-user-minus"></i> Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center; color: var(--text-secondary); padding: 2rem;'>No users registered yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'admin_footer.php'; ?>