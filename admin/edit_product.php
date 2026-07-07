<?php
session_start();
include("../includes/db.php");
/* ==========================================
   GET PRODUCT
========================================== */
$id = $_GET['id'];
$result = mysqli_query(
    $conn,
    "SELECT * FROM products
     WHERE product_id='$id'"
);
$product = mysqli_fetch_assoc($result);
/* ==========================================
   UPDATE PRODUCT
========================================== */
if (isset($_POST['update'])) {
    $category = $_POST['category'];
    $name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    if ($_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../images/".$image
        );
    } else {
        $image = $product['image'];
    }
    mysqli_query(
        $conn,
        "UPDATE products SET
        category='$category',
        product_name='$name',
        description='$description',
        price='$price',
        stock='$stock',
        image='$image'
        WHERE product_id='$id'"
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
        Edit Product
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
                Edit Product
            </h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>
                        Category
                    </label>
                    <select name="category" required>
                        <option <?php if($product['category']=="Savory") echo "selected"; ?>>
                            Savory
                        </option>
                        <option <?php if($product['category']=="Sweet") echo "selected"; ?>>
                            Sweet
                        </option>
                        <option <?php if($product['category']=="Drinks") echo "selected"; ?>>
                            Drinks
                        </option>
                        <option <?php if($product['category']=="Party Pack") echo "selected"; ?>>
                            Party Pack
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        Product Name
                    </label>
                    <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label>
                        Description
                    </label>
                    <textarea name="description" required><?php echo $product['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>
                        Price
                    </label>
                    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
                </div>
                <div class="form-group">
                    <label>
                        Stock
                    </label>
                    <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
                </div>
                <div class="form-group">
                    <label>
                        Current Image
                    </label>
                    <br><br>
                    <img src="../images/<?php echo $product['image']; ?>" width="150" style="border-radius:10px;">
                </div>
                <div class="form-group">
                    <label>
                        Change Image
                    </label>
                    <input type="file" name="image" accept="image/*">
                </div>
                <button name="update" class="btn btn-primary" style="width:100%;">
                    Update Product
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
