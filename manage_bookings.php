<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) { header("Location: admin_login.php"); exit; }

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $conn->query("DELETE FROM payments WHERE booking_id=$id"); 

    if($conn->query("DELETE FROM bookings WHERE booking_id=$id")) {
        echo "<script>alert('Booking and its payment history deleted successfully'); window.location='manage_bookings.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting booking: " . $conn->error . "');</script>"; 
    }
}

$page_title = "Manage Bookings - Siltie Tour";
$active_page = "bookings";
include 'admin_header.php';
?>

<h1><i class="fa-solid fa-book"></i> Manage Customer Bookings</h1>

<div class="admin-card">
    <h3>Active Bookings</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Package</th>
                    <th>Travel Date</th>
                    <th>Travelers</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT b.*, u.username, p.package_name 
                        FROM bookings b 
                        JOIN users u ON b.user_id = u.user_id 
                        JOIN packages p ON b.package_id = p.package_id 
                        ORDER BY b.booking_id DESC";
                
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $statusClass = ($row['status'] == 'Confirmed') ? 'status-confirmed' : 'status-pending';
                        ?>
                        <tr>
                            <td>#<?php echo $row['booking_id']; ?></td>
                            <td style="font-weight: 600; color: var(--text-primary);"><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['travel_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['travelers']); ?></td>
                            <td style="font-weight: 600;"><?php echo number_format($row['total_price'], 2); ?> ETB</td>
                            <td>
                                <span class="<?php echo $statusClass; ?>"><?php echo htmlspecialchars($row['status']); ?></span>
                            </td>
                            <td style="text-align: right;">
                                <a href="manage_bookings.php?delete=<?php echo $row['booking_id']; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this booking? This will also clear payment history.');" 
                                   style="color: #ef4444; font-weight: 600;"><i class="fa-solid fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align:center; color: var(--text-secondary); padding: 2rem;'>No bookings found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'admin_footer.php'; ?>