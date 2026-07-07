<?php
session_start();
include("includes/db.php");
/* ==========================================
   ADD TO CART
========================================== */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}
/* ==========================================
   REMOVE ITEM
========================================== */
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
}
/* ==========================================
   INCREASE QUANTITY
========================================== */
if (isset($_GET['add'])) {
    $_SESSION['cart'][$_GET['add']]++;
}
/* ==========================================
   DECREASE QUANTITY
========================================== */
if (isset($_GET['minus'])) {
    $id = $_GET['minus'];
    $_SESSION['cart'][$id]--;
    if ($_SESSION['cart'][$id] <= 0) {
        unset($_SESSION['cart'][$id]);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Shopping Cart
    </title>
    <link rel="stylesheet" href="style.css">
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
            <li><a href="index.php">Home</a></li>
            <li><a href="store.php">Store</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2 style="color:var(--brown); margin-bottom:30px;">
            Shopping Cart
        </h2>
        <?php
$total = 0;
if (
    isset($_SESSION['cart']) &&
    count($_SESSION['cart']) > 0
) {
?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
foreach($_SESSION['cart'] as $product_id => $qty){
$result = mysqli_query(
$conn,
"SELECT *
FROM products
WHERE product_id='$product_id'"
);
$product = mysqli_fetch_assoc($result);
$subtotal = $product['price'] * $qty;
$total += $subtotal;
?>
                <tr>
                    <td>
                        <?php
if($product['image']!=""){
?>
                        <img src="images/<?php echo $product['image']; ?>" width="80" style="border-radius:10px;">
                        <?php
}else{
echo "No Image";
}
?>
                    </td>
                    <td>
                        <?php
echo $product['product_name'];
?>
                    </td>
                    <td>
                        ₱<?php
echo number_format(
$product['price'],
2
);
?>
                    </td>
                    <td>
                        <a href="cart.php?minus=<?php echo $product_id; ?>" class="btn btn-danger">
                            -
                        </a>
                        <strong>
                            <?php echo $qty; ?>
                        </strong>
                        <a href="cart.php?add=<?php echo $product_id; ?>" class="btn btn-primary">
                            +
                        </a>
                    </td>
                    <td>
                        ₱<?php
echo number_format(
$subtotal,
2
);
?>
                    </td>
                    <td>
                        <a href="cart.php?remove=<?php echo $product_id; ?>" class="btn btn-danger">
                            Remove
                        </a>
                    </td>
                </tr>
                <?php
}
?>
            </tbody>
        </table>
        <br>
        <div style="text-align:right; font-size:24px; font-weight:bold; color:var(--brown);">
            Grand Total :
            ₱<?php
echo number_format(
$total,
2
);
?>
        </div>
        <br>
        <div style="display:flex; justify-content:space-between;">
            <a href="store.php" class="btn btn-primary">
                ← Continue Shopping
            </a>
            <a href="checkout.php" class="btn btn-secondary">
                Proceed to Checkout →
            </a>
        </div>
        <?php
}else{
?>
        <div class="card" style="padding:50px; text-align:center;">
            <h2>
                🛒
            </h2>
            <h3>
                Your Cart is Empty
            </h3>
            <br>
            <a href="store.php" class="btn btn-primary">
                Start Shopping
            </a>
        </div>
        <?php
}
?>
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
