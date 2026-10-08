<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin_id'])) { header("Location: admin_login.php"); exit; }

$msg = "";
$msg_type = "";

// አዲስ Package ሲጨመር
if (isset($_POST['add_package'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    
    // ምስል Upload Logic
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO packages (package_name, description, price, image_file) VALUES ('$name', '$desc', '$price', '$image')";
        if($conn->query($sql)) {
            $msg = "Package Added Successfully!";
            $msg_type = "success";
        } else {
            $msg = "Database Error: " . $conn->error;
            $msg_type = "danger";
        }
    } else {
        $msg = "Image Upload Failed!";
        $msg_type = "danger";
    }
}

// Package ለማጥፋት
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if($conn->query("DELETE FROM packages WHERE package_id=$id")) {
        header("Location: manage_packages.php");
        exit();
    }
}

$page_title = "Manage Packages - Siltie Tour";
$active_page = "packages";
include 'admin_header.php';
?>

<h1><i class="fa-solid fa-map-location-dot"></i> Manage Tour Packages</h1>

<?php if($msg != ""): ?>
    <div class="alert alert-<?php echo $msg_type; ?>"><?php echo $msg; ?></div>
<?php endif; ?>

<div class="admin-card">
    <h3>Add New Package</h3>
    <form method="post" enctype="multipart/form-data">
        <div class="inline-form-row">
            <div class="form-group">
                <label>Package Name</label>
                <input type="text" name="name" class="form-control" placeholder="Worabe Getaway" required>
            </div>
            <div class="form-group">
                <label>Price (ETB)</label>
                <input type="number" name="price" class="form-control" placeholder="Price in ETB" required>
            </div>
            <div class="form-group">
                <label>Package Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>
        </div>
        
        <div class="form-group" style="margin-top: 1rem;">
            <label>Description</label>
            <textarea name="description" class="form-control" placeholder="Details about this package..." required style="height: 120px;"></textarea>
        </div>
        
        <button type="submit" name="add_package" class="btn" style="margin-top: 1rem;"><i class="fa-solid fa-plus"></i> Add Package</button>
    </form>
</div>

<div class="admin-card">
    <h3>Active Packages</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Package Name</th>
                    <th>Price</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM packages ORDER BY package_id DESC");
                if ($res && $res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='images/".htmlspecialchars($row['image_file'])."' width='60' height='40' style='object-fit: cover; border-radius: 6px; border: 1px solid var(--border);'></td>";
                        echo "<td style='font-weight: 600; color: var(--text-primary);'>".htmlspecialchars($row['package_name'])."</td>";
                        echo "<td style='font-weight: 600;'>".number_format($row['price'], 2)." ETB</td>";
                        echo "<td style='text-align: right;'><a href='manage_packages.php?delete=".$row['package_id']."' style='color: #ef4444; font-weight: 600;' onclick='return confirm(\"Are you sure you want to delete this package?\")'><i class='fa-solid fa-trash'></i> Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' style='text-align: center; color: var(--text-secondary); padding: 2rem;'>No packages created yet. Add one above!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'admin_footer.php'; ?>