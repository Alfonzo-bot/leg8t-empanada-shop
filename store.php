<?php
session_start();
include("includes/db.php");
/* ==========================================
   CATEGORY FILTER
========================================== */
$category = "";
if (isset($_GET['category'])) {
    $category = mysqli_real_escape_string(
        $conn,
        $_GET['category']
    );
}
if ($category == "" || $category == "All") {
    $result = mysqli_query(
        $conn,
        "SELECT *
         FROM products
         ORDER BY product_name ASC"
    );
} else {
    $result = mysqli_query(
        $conn,
        "SELECT *
         FROM products
         WHERE category='$category'
         ORDER BY product_name ASC"
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Store | Leg8t Empanada
    </title>
    <link rel="stylesheet" href="style.css">
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
                <a href="index.php">
                    Home
                </a>
            </li>
            <li>
                <a href="store.php" class="active">
                    Store
                </a>
            </li>
            <li>
                <a href="about.php">
                    About
                </a>
            </li>
            <?php
if(isset($_SESSION['user_id'])){
?>
            <li>
                <a href="cart.php">
                    Cart
                </a>
            </li>
            <li>
                <a href="logout.php">
                    Logout
                </a>
            </li>
            <?php
}else{
?>
            <li>
                <a href="login.php">
                    Login
                </a>
            </li>
            <li>
                <a href="register.php">
                    Register
                </a>
            </li>
            <?php
}
?>
        </ul>
    </nav>
    <!-- ==========================================
     HERO
========================================== -->
    <section class="hero">
        <h1>
            Our
            <span>
                Products
            </span>
        </h1>
        <p>
            Browse our freshly baked empanadas
            made with premium ingredients.
        </p>
    </section>
    <!-- ==========================================
     STORE
========================================== -->
    <div class="container">
        <h2 style="margin-bottom:20px; color:var(--brown);">
            Our Products
        </h2>
        <div class="category-filter">
            <a href="store.php?category=All" class="<?php echo ($category=='' || $category=='All') ? 'active-category' : ''; ?>">
            </a>
            <a href="store.php?category=Savory" class="<?php echo ($category=='Savory') ? 'active-category' : ''; ?>">
            </a>
            <a href="store.php?category=Sweet" class="<?php echo ($category=='Sweet') ? 'active-category' : ''; ?>">
            </a>
            <a href="store.php?category=Drinks" class="<?php echo ($category=='Drinks') ? 'active-category' : ''; ?>">
            </a>
            <a href="store.php?category=Party Pack" class="<?php echo ($category=='Party Pack') ? 'active-category' : ''; ?>">
            </a>
        </div>
        <div class="grid">
            <?php
while($product = mysqli_fetch_assoc($result)){
?>
            <div class="product">
                <div class="product-image">
                    <?php
if ($product['image'] != "") {
?>
                    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['product_name']; ?>" width="100%" height="180" style="object-fit:cover;">
                    <?php
} else {
?>
                    🫓
                    <?php
}
?>
                </div>
                <div class="product-body">
                    <div class="category">
                        <?php echo strtoupper($product['category']); ?>
                    </div>
                    <h3>
                        <?php echo $product['product_name']; ?>
                    </h3>
                    <p>
                        <?php echo $product['description']; ?>
                    </p>
                    <div class="price">
                        ₱<?php echo number_format($product['price'], 2); ?>
                    </div>
                    <br>
                    <?php
if($product['stock'] > 0){
?>
                    <a href="cart.php?id=<?php echo $product['product_id']; ?>" class="btn btn-primary" style="display:block;text-align:center;">
                        🛒 Add to Cart
                    </a>
                    <br>
                    <small style="color:green; font-weight:600;">
                        In Stock:
                        <?php echo $product['stock']; ?>
                    </small>
                    <?php
}else{
?>
                    <button class="btn btn-danger" style="width:100%;" disabled>
                        Out of Stock
                    </button>
                    <?php
}
?>
                </div>
            </div>
            <?php
}
?>
        </div>
    </div>
    <!-- ==========================================
     FOOTER
========================================== -->
    <footer>
        <strong>
            🫓 Leg8t Empanada
        </strong>
        <br><br>
        Group Name:
        <strong>
           Leg8t Empanada
        </strong>
        <br><br>
        ⚠️ This website is for educational purposes only and is submitted as our Final Project.
    </footer>
</body>
</html>
