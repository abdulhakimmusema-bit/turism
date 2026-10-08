<?php
session_start();
include 'db.php'; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_email = $conn->query("SELECT user_id FROM users WHERE email='$email'");
    
    if ($check_email->num_rows > 0) {
        $message = "ይህ ኢሜይል አስቀድሞ ተመዝግቧል! እባክዎ ይግቡ (Login)።";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('ምዝገባዎ ተሳክቷል! አሁን መግባት ይችላሉ።'); window.location='login.php';</script>";
        } else {
            $message = "ስህተት: " . $conn->error;
        }
    }
}

$page_title = "Register - Siltie Tour";
$active_page = "register";
include 'header.php';
?>

<main class="container">
    <div class="form-container">
        <h2>Register (ተመዝገብ)</h2>
        <?php if($message != ""): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label>Full Name (ሙሉ ስም)</label>
                <input type="text" name="username" class="form-control" placeholder="John Doe" required>
            </div>
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
            </div>
            
            <div class="form-group">
                <label>Password (የይለፍ ቃል)</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn" style="width:100%; margin-top: 1rem;">Register</button>
        </form>
        <p style="text-align:center; margin-top: 1.5rem; color: var(--text-secondary); font-size: 0.9rem;">
            Already have an account? <a href="login.php" style="color: var(--primary); font-weight: 600;">Login here</a>
        </p>
    </div>
</main>

<?php include 'footer.php'; ?>