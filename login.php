<?php
session_start();
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php"); 
            exit();
        } else {
            $message = "የተሳሳተ ፓስወርድ ነው (Incorrect Password)።";
        }
    } else {
        $message = "ይህ ኢሜይል አልተመዘገበም (User not found)።";
    }
}

$page_title = "Login - Siltie Tour";
$active_page = "login";
include 'header.php';
?>

<main class="container">
    <div class="form-container">
        <h2>Login (ግባ)</h2>
        <?php if($message != ""): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn" style="width:100%; margin-top: 1rem;">Login</button>
        </form>
        <p style="text-align:center; margin-top: 1.5rem; color: var(--text-secondary); font-size: 0.9rem;">
            Don't have an account? <a href="register.php" style="color: var(--primary); font-weight: 600;">Register here</a>
        </p>
    </div>
</main>

<?php include 'footer.php'; ?>