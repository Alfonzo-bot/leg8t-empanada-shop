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
        Product Management
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
                <a href="inventory.php">
                    Inventory
                </a>
            </li>
            <li>
                <a href="users.php">
                    Users
                </a>
            </li>
            <li>
                <a href="../logout.php">
                    Logout
                </a>
            </li>
        </ul>
    </nav>
    <!-- ==========================================
     PAGE TITLE
========================================== -->
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <h2 style="color:var(--brown);">
                Product Management
            </h2>
            <a href="add_product.php" class="btn btn-primary">
                + Add Product
            </a>
        </div>
        <!-- ==========================================
     TABLE
========================================== -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
$result = mysqli_query(
    $conn,
    "SELECT * FROM products
    ORDER BY product_id DESC"
);
while($row = mysqli_fetch_assoc($result)){
?>
                <tr>
                    <td>
                        <?php
echo $row['product_id'];
?>
                    </td>
                    <td>
                        <?php
if($row['image']!=""){
?>
                        <img src="../images/<?php echo $row['image']; ?>" width="70" height="70" style="object-fit:cover; border-radius:10px;">
                        <?php
}else{
echo "No Image";
}
?>
                    </td>
                    <td>
                        <?php
echo $row['product_name'];
?>
                    </td>
                    <td>
                        <?php
echo $row['category'];
?>
                    </td>
                    <td>
                        ₱<?php
echo number_format(
$row['price'],
2
);
?>
                    </td>
                    <td>
                        <?php
echo $row['stock'];
?>
                    </td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-secondary">
                            Edit
                        </a>
                        <a href="delete_product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this product?')">
                            Delete
                        </a>
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
