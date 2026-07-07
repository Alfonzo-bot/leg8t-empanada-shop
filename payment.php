<?php
session_start();
include("includes/db.php");
include("includes/log_activity.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
/* ==========================================
   PLACE ORDER
========================================== */
if (isset($_POST['place_order'])) {
    $payment = $_POST['payment'];
    $user_id = $_SESSION['user_id'];
    $total = 0;
    foreach ($_SESSION['cart'] as $id => $qty) {
        $product = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT * FROM products
                 WHERE product_id='$id'"
            )
        );
        $total += ($product['price'] * $qty);
    }
    /* ======================================
       CREATE ORDER
    ====================================== */
    mysqli_query(
        $conn,
        "INSERT INTO orders
        (
            user_id,
            total_amount,
            order_date,
            order_status
        )
        VALUES
        (
            '$user_id',
            '$total',
            NOW(),
            'Pending'
        )"
    );
    $order_id = mysqli_insert_id($conn);
    /* ======================================
       SAVE ORDER ITEMS
    ====================================== */
    foreach ($_SESSION['cart'] as $id => $qty) {
        $product = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT * FROM products
                 WHERE product_id='$id'"
            )
        );
        $subtotal = $product['price'] * $qty;
        mysqli_query(
            $conn,
            "INSERT INTO order_items
            (
                order_id,
                product_id,
                quantity,
                subtotal
            )
            VALUES
            (
                '$order_id',
                '$id',
                '$qty',
                '$subtotal'
            )"
        );
        /* ==============================
           UPDATE STOCK
        ============================== */
        mysqli_query(
            $conn,
            "UPDATE products
             SET stock = stock - $qty
             WHERE product_id='$id'"
        );
    }
    /* ======================================
       AUDIT LOG
    ====================================== */
    logActivity(
        $conn,
        $user_id,
        "Placed Order #".$order_id
    );
    /* ======================================
       EMPTY CART
    ====================================== */
    unset($_SESSION['cart']);
    header("Location: success.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Payment
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
    </nav>
    <div class="container">
        <div class="form-card">
            <h2>
                Payment Method
            </h2>
            <p>
                Choose your preferred payment method.
            </p>
            <form method="POST">
                <div class="form-group">
                    <label>
                        <input type="radio" name="payment" value="Cash on Delivery" required>
                        Cash on Delivery
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" name="payment" value="GCash">
                        GCash
                    </label>
                </div>
                <button name="place_order" class="btn btn-primary" style="width:100%;">
                    Place Order
                </button>
            </form>
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
