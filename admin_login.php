<?php
session_start();
include 'db.php'; 

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); 
    $password = trim($_POST['password']); 

    $stmt = $conn->prepare("SELECT admin_id, username, password FROM admins WHERE username=?");
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_user'] = $row['username'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $msg = "የይለፍ ቃል ስህተት ነው (Invalid Password)";
        }
    } else {
        $msg = "ይህ User በዳታቤዝ ውስጥ የለም (User not found).";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Siltie Tour</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Outfit', sans-serif;
            color: #f1f5f9;
        }
        .form-container {
            background-color: #1e293b;
            border-color: #334155;
            color: #f1f5f9;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.3);
        }
        .form-container h2 {
            color: #f1f5f9;
        }
        .form-control {
            background-color: #0f172a;
            border-color: #334155;
            color: #f1f5f9;
        }
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(241, 196, 15, 0.15);
        }
        .btn-admin-submit {
            background-color: var(--accent);
            color: #0f172a;
            font-weight: 700;
        }
        .btn-admin-submit:hover {
            background-color: #f39c12;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 style="margin-bottom: 0.5rem;"><i class="fa-solid fa-lock" style="color: var(--accent);"></i> Admin Portal</h2>
        <p style="text-align: center; color: #94a3b8; font-size: 0.9rem; margin-bottom: 2rem;">Authorized Personnel Only</p>
        
        <?php if($msg != ""): ?>
            <div class="alert alert-danger"><?php echo $msg; ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="admin_user" required autocomplete="username">
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required autocomplete="current-password">
            </div>
            
            <button type="submit" class="btn btn-admin-submit" style="width:100%; margin-top: 1rem;">Login to Dashboard</button>
        </form>
        <p style="text-align:center; margin-top: 1.5rem; font-size: 0.9rem;">
            <a href="index.php" style="color: #94a3b8; text-decoration: underline;"><i class="fa-solid fa-arrow-left"></i> Back to Homepage</a>
        </p>
    </div>
</body>
</html>