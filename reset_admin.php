<?php
// ስህተት ካለ እንዲያሳየን
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php'; 

echo "<h2>Admin Repair & Diagnostic Tool</h2>";

// 1. የዳታቤዝ ግንኙነትን ማረጋገጥ
if ($conn->connect_error) {
    die("<p style='color:red'>Database Connection Failed: " . $conn->connect_error . "</p>");
}
echo "<p style='color:green'>Step 1: Database Connected Successfully.</p>";

// 2. የድሮውን table አጥፍቶ እንደገና መፍጠር (To ensure clean structure)
$conn->query("DROP TABLE IF EXISTS admins");
$sql_create = "CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql_create) === TRUE) {
    echo "<p style='color:green'>Step 2: Admin table created successfully.</p>";
} else {
    die("<p style='color:red'>Step 2 Failed: " . $conn->error . "</p>");
}

// 3. አዲስ አድሚን ማስገባት (admin / admin123)
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);
$username = 'admin';

// በቀጥታ Query እንጠቀም (to avoid bind_param issues for diagnostic)
$sql_insert = "INSERT INTO admins (username, password) VALUES ('$username', '$hash')";

if ($conn->query($sql_insert) === TRUE) {
    echo "<p style='color:green'>Step 3: New Admin User Inserted.</p>";
    echo "<ul><li>Username: <strong>admin</strong></li><li>Password: <strong>admin123</strong></li></ul>";
} else {
    die("<p style='color:red'>Step 3 Failed: " . $conn->error . "</p>");
}

// 4. አሁኑኑ መሰራቱን ማረጋገጥ (Verification)
$result = $conn->query("SELECT * FROM admins WHERE username='admin'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // እራሱ ኮዱ ይሞክረው
    if (password_verify('admin123', $row['password'])) {
        echo "<h3 style='color:green; border: 2px solid green; padding: 10px;'>✅ SUCCESS! System Verified.</h3>";
        echo "<p>ችግሩ ተፈትቷል! አሁን መግባት ይችላሉ።</p>";
        echo "<a href='admin_login.php' style='font-size: 20px; font-weight: bold;'>Go to Admin Login Now >></a>";
    } else {
        echo "<h3 style='color:red;'>❌ FAILED! Password mismatch detected.</h3>";
    }
} else {
    echo "<p style='color:red'>Error: User was not found after insertion.</p>";
}
?>