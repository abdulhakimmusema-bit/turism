<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }

$package_id = $_GET['id'];
$pkg = $conn->query("SELECT * FROM packages WHERE package_id=$package_id")->fetch_assoc();

if(isset($_POST['confirm_booking'])){
    $user_id = $_SESSION['user_id'];
    $date = $_POST['date'];
    $travelers = $_POST['travelers'];
    $total = $pkg['price'] * $travelers;

    $sql = "INSERT INTO bookings (user_id, package_id, travel_date, travelers, total_price, status) 
            VALUES ('$user_id', '$package_id', '$date', '$travelers', '$total', 'Pending')";
    
    if($conn->query($sql)){
        header("Location: dashboard.php");
        exit();
    } else {
        $error_msg = "Error: " . $conn->error;
    }
}

$page_title = "Book Tour - Siltie Tour";
include 'header.php';
?>

<main class="container">
    <div class="form-container">
        <h2>Book: <?php echo htmlspecialchars($pkg['package_name']); ?></h2>
        
        <?php if(isset($error_msg)): ?>
            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>Date of Travel</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Number of Travelers</label>
                <input type="number" name="travelers" class="form-control" value="1" min="1" required>
            </div>
            
            <button type="submit" name="confirm_booking" class="btn" style="width: 100%; margin-top: 1rem;">Confirm Booking</button>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>