<?php
session_start();
include("../includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Inventory Report
    </title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- ==========================================
     NAVIGATION
========================================== -->
    <nav>
        <div class="logo">
    <img
        src="images/logo.png"
        alt="Leg8t Empanada"
        class="logo-image"
    >
    <div class="logo-text">
        <h2>
            Leg8t Empanada
        </h2>
        <small>
            Freshly Baked • Authentic Flavors
        </small>
    </div>
</div>
        <ul>
            <li>
                <a href="dashboard.php">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="products.php">
                    Products
                </a>
            </li>
            <li>
                <a href="users.php">
                    Users
                </a>
            </li>
            <li>
                <a href="inventory.php">
                    Inventory
                </a>
            </li>
            <li>
                <a href="../logout.php">
                    Logout
                </a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <h2 style="color:var(--brown); margin-bottom:25px;">
            Inventory Report
        </h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
$result = mysqli_query(
    $conn,
    "SELECT *
     FROM products
     ORDER BY product_name ASC"
);
while($row = mysqli_fetch_assoc($result)){
?>
                <tr>
                    <td>
                        <?php echo $row['product_id']; ?>
                    </td>
                    <td>
                        <?php
if($row['image']!=""){
?>
                        <img src="../images/<?php echo $row['image']; ?>" width="70" height="70" style="object-fit:cover; border-radius:8px;">
                        <?php
}else{
echo "No Image";
}
?>
                    </td>
                    <td>
                        <?php echo $row['product_name']; ?>
                    </td>
                    <td>
                        <?php echo $row['category']; ?>
                    </td>
                    <td>
                        ₱<?php echo number_format($row['price'],2); ?>
                    </td>
                    <td>
                        <?php echo $row['stock']; ?>
                    </td>
                    <td>
                        <?php
if($row['stock'] > 10){
?>
                        <span style="background:#d4edda; color:#155724; padding:6px 12px; border-radius:20px; font-weight:bold;">
                            In Stock
                        </span>
                        <?php
}else if($row['stock'] > 0){
?>
                        <span style="background:#fff3cd; color:#856404; padding:6px 12px; border-radius:20px; font-weight:bold;">
                            Low Stock
                        </span>
                        <?php
}else{
?>
                        <span style="background:#f8d7da; color:#721c24; padding:6px 12px; border-radius:20px; font-weight:bold;">
                            Out of Stock
                        </span>
                        <?php
}
?>
                    </td>
                </tr>
                <?php
}
?>
            </tbody>
        </table>
    </div>
    <footer>
        🫓
        <strong>
           Leg8t Empanada
        </strong>
        <br><br>
        Educational purposes only.
    </footer>
</body>
</html>
