<?php
session_start();
include("../includes/db.php");
/* ==========================================
   ADD PRODUCT
========================================== */
if (isset($_POST['save'])) {
    $category = $_POST['category'];
    $product  = $_POST['product_name'];
    $desc     = $_POST['description'];
    $price    = $_POST['price'];
    $stock    = $_POST['stock'];
    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    move_uploaded_file(
        $temp,
        "../images/".$image
    );
    mysqli_query(
        $conn,
        "INSERT INTO products
        (
            category,
            product_name,
            description,
            price,
            stock,
            image
        )
        VALUES
        (
            '$category',
            '$product',
            '$desc',
            '$price',
            '$stock',
            '$image'
        )"
    );
    header("Location: products.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Add Product
    </title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
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
                <a href="../logout.php">
                    Logout
                </a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="form-card">
            <h2>
                Add Product
            </h2>
            <p>
                Create a new product.
            </p>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>
                        Category
                    </label>
                    <select name="category" required>
                        <option>
                            Savory
                        </option>
                        <option>
                            Sweet
                        </option>
                        <option>
                            Drinks
                        </option>
                        <option>
                            Party Pack
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        Product Name
                    </label>
                    <input type="text" name="product_name" required>
                </div>
                <div class="form-group">
                    <label>
                        Description
                    </label>
                    <textarea name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label>
                        Price
                    </label>
                    <input type="number" step="0.01" name="price" required>
                </div>
                <div class="form-group">
                    <label>
                        Stock
                    </label>
                    <input type="number" name="stock" required>
                </div>
                <div class="form-group">
                    <label>
                        Product Image
                    </label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <button name="save" class="btn btn-primary" style="width:100%;">
                    Save Product
                </button>
            </form>
            <br>
            <center>
                <a href="products.php">
                    ← Back to Products
                </a>
            </center>
        </div>
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
