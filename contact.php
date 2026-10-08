<?php
$conn = new mysqli("localhost", "root", "", "tourism_final");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$success_msg = "";
$error_msg = "";

if(isset($_POST['send_message'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if(mysqli_query($conn, $sql)) {
        $success_msg = "መልዕክትዎ በትክክል ተልኳል! አድሚኑ በቅርቡ ያገኝዎታል።";
    } else {
        $error_msg = "ይቅርታ፣ ስህተት ተፈጥሯል። እንደገና ይሞክሩ።";
    }
}

$page_title = "Contact Us - Siltie Tour";
$active_page = "contact";
include 'header.php';
?>

<main class="container">
    <div class="contact-container">
        <div class="contact-info">
            <h2>ስልጤ የጉብኝት ቦታ</h2>
            <p>ጥያቄ አለዎት? ወይስ ስለ ስልጤ ዞን ጉብኝትዎ ተጨማሪ መረጃ ይፈልጋሉ? እኛን ለማግኘት ወደኋላ አይበሉ! የእርስዎ አስተያየት እና ጥያቄ ለሥራችን መሳካት ትልቅ ዋጋ አለው።</p>
            
            <div class="info-item"><i class="fas fa-phone"></i> <span>+251 911 00 00 00</span></div>
            <div class="info-item"><i class="fas fa-envelope"></i> <span>info@silte_tour.com</span></div>
            <div class="info-item"><i class="fas fa-map-marker-alt"></i> <span>አድራሻ፦ ስልጤ ዞን፣ ወራቤ ከተማ፣ ኢትዮጵያ</span></div>
            <div class="info-item"><i class="fab fa-facebook-f"></i> <a href="https://www.facebook.com" target="_blank">Facebook</a></div>
            <div class="info-item"><i class="fab fa-instagram"></i> <a href="https://www.instagram.com" target="_blank">Instagram</a></div>
            <div class="info-item"><i class="fab fa-twitter"></i> <a href="https://twitter.com" target="_blank">Twitter</a></div>
            <div class="info-item"><i class="fab fa-youtube"></i> <a href="https://www.youtube.com" target="_blank">Youtube</a></div>
        </div>

        <div class="contact-form">
            <h2>Send a Message</h2>
            
            <?php if($success_msg): ?> <div class="alert alert-success"><?php echo $success_msg; ?></div> <?php endif; ?>
            <?php if($error_msg): ?> <div class="alert alert-danger"><?php echo $error_msg; ?></div> <?php endif; ?>

            <form action="contact.php" method="POST">
                <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <label>Your Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <label>Your Message</label>
                    <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" name="send_message" class="btn" style="width: 100%;">Send Message</button>
            </form>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>