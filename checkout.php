<?php
session_start();
include("includes/db.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$result = mysqli_query(
    $conn,
    "SELECT *
     FROM users
     WHERE user_id='".$_SESSION['user_id']."'"
);
$user = mysqli_fetch_assoc($result);
$total = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Checkout
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
            <li><a href="cart.php">Cart</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="grid" style="grid-template-columns:2fr 1fr; gap:30px;">
            <div class="card" style="padding:30px;">
                <h2>
                    Delivery Details
                </h2>
                <form action="payment.php" method="POST">
                    <div class="form-group">
                        <label>
                            Complete Name
                        </label>
                        <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>
                            Address
                        </label>
                        <textarea name="address" readonly><?php echo $user['address']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>
                            Contact Number
                        </label>
                        <input type="text" value="<?php echo $user['contact']; ?>" readonly>
                    </div>
                    <input type="hidden" name="total" value="0" id="grandTotal">
                    <button class="btn btn-secondary" style="width:100%;">
                        Continue to Payment →
                    </button>
                </form>
            </div>
            <div class="card" style="padding:30px;">
                <h2>
                    Order Summary
                </h2>
                <hr><br>
                <?php
if(isset($_SESSION['cart'])){
foreach($_SESSION['cart'] as $id=>$qty){
$product = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT *
FROM products
WHERE product_id='$id'"
)
);
$subtotal = $product['price'] * $qty;
$total += $subtotal;
?>
                <p>
                    <strong>
                        <?php echo $product['product_name']; ?>
                    </strong>
                    <br>
                    <?php echo $qty; ?>
                    ×
                    ₱<?php echo number_format($product['price'],2); ?>
                </p>
                <p>
                    Subtotal :
                    <strong>
                        ₱<?php echo number_format($subtotal,2); ?>
                    </strong>
                </p>
                <hr>
                <?php
}
}
?>
                <h3>
                    Grand Total
                </h3>
                <h2 style="color:#5C2D0A;">
                    ₱<?php echo number_format($total,2); ?>
                </h2>
                <script>
                    document
                        .getElementById("grandTotal")
                        .value = < ? php echo $total; ? > ;
                </script>
            </div>
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
