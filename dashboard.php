<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }
$user_id = $_SESSION['user_id'];

$page_title = "My Dashboard - Siltie Tour";
$active_page = "dashboard";
include 'header.php';
?>

<main class="container">
    <h2 class="section-title">My Booking History</h2>
    <div class="section-divider"></div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Package</th>
                    <th>Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT b.*, p.package_name FROM bookings b 
                        JOIN packages p ON b.package_id = p.package_id 
                        WHERE b.user_id = $user_id
                        ORDER BY b.booking_id DESC";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <td style="font-weight: 600; color: var(--text-primary);"><?php echo htmlspecialchars($row['package_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['travel_date']); ?></td>
                        <td style="font-weight: 600;"><?php echo number_format($row['total_price'], 2); ?> ETB</td>
                        <td>
                            <span class="<?php echo ($row['status']=='Pending') ? 'status-pending' : 'status-confirmed'; ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                        </td>
                        <td>
                            <?php if($row['status'] == 'Pending'): ?>
                                <a href="pay.php?booking_id=<?php echo $row['booking_id']; ?>&amount=<?php echo $row['total_price']; ?>" class="btn btn-pay" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Pay Now</a>
                            <?php else: ?>
                                <span style="color: var(--primary); font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Paid</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php 
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center; color: var(--text-secondary); padding: 2rem;'>You haven't booked any tours yet. <a href='tour_package.php' style='color: var(--primary); font-weight: 600; text-decoration: underline;'>Browse Packages</a></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php include 'footer.php'; ?>