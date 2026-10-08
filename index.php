<?php
$page_title = "Siltie Tour - Home";
$active_page = "home";
include 'header.php';
include 'db.php';
?>

<div class="hero">
    <div class="hero-content">
        <h1>ስልጤን ያግኙ - የማይረሳ ጉዞ!</h1>
        <p>ከጥንታዊ ቅርስ እስከ አስደናቂ ተፈጥሮ ድረስ። ጉዞዎን ዛሬውኑ ያስይዙ።</p>
        <a href="tour_package.php" class="btn">See Packages</a>
    </div>
</div>

<main class="container">
    <h2 class="section-title">Our Tour Packages</h2>
    <div class="section-divider"></div>

    <div class="grid">
        <?php
        $sql = "SELECT * FROM packages";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            ?>
                <article class="card">
                    <div class="card-img-wrapper">
                        <img src="images/<?php echo htmlspecialchars($row['image_file']); ?>" alt="<?php echo htmlspecialchars($row['package_name']); ?>">
                    </div>
                    <div class="card-body">
                        <h3><?php echo htmlspecialchars($row['package_name']); ?></h3>
                        <p><?php echo htmlspecialchars(substr($row['description'], 0, 150)); ?>...</p>
                        <div class="card-price"><?php echo number_format($row['price'], 2); ?> ETB</div>
                        <a href="book.php?id=<?php echo $row['package_id']; ?>" class="btn" style="width: 100%;">Book Now</a>
                    </div>
                </article>
            <?php 
            }
        } else {
            echo "<p style='grid-column: 1/-1; text-align: center; color: var(--text-secondary);'>No packages available at the moment. Please check back later!</p>";
        }
        ?>
    </div>
</main>

<?php include 'footer.php'; ?>