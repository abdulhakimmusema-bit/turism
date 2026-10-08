<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['admin_id'])) { 
    header("Location: admin_login.php"); 
    exit; 
}

if(isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $id = mysqli_real_escape_string($conn, $id);
    $delete_query = "DELETE FROM contact_messages WHERE id = '$id'";
    
    if(mysqli_query($conn, $delete_query)) {
        echo "<script>alert('መልዕክቱ በትክክል ተሰርዟል!'); window.location='view_messages.php';</script>";
        exit();
    }
}

$page_title = "Manage Messages - Siltie Tour";
$active_page = "messages";
include 'admin_header.php';
?>

<h1><i class="fa-solid fa-envelope-open-text"></i> Customer Messages</h1>

<div class="admin-card">
    <h3>Received Messages</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM contact_messages ORDER BY submitted_at DESC";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td style="font-weight: 600; color: var(--text-primary);"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" style="color: var(--primary); text-decoration: underline;"><?php echo htmlspecialchars($row['email']); ?></a></td>
                            <td style="max-width: 400px; line-height: 1.5;"><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                            <td><?php echo date('M d, Y', strtotime($row['submitted_at'])); ?></td>
                            <td style="text-align: right;">
                                <a href="view_messages.php?delete_id=<?php echo $row['id']; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this message?');" 
                                   style="color: #ef4444; font-weight: 600;"><i class="fa-solid fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center; color: var(--text-secondary); padding: 2rem;'>ምንም የተላከ መልዕክት የለም (No messages found).</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'admin_footer.php'; ?>