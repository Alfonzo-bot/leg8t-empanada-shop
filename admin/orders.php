<?php
session_start();
include("../includes/db.php");
/* ==========================================
   ADMIN AUTHENTICATION
========================================== */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
if ($_SESSION['role'] != "admin") {
    header("Location: ../index.php");
    exit();
}
/* ==========================================
   UPDATE ORDER STATUS
========================================== */
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    mysqli_query(
        $conn,
        "UPDATE orders
         SET order_status='$status'
         WHERE order_id='$order_id'"
    );
}
/* ==========================================
   GET ORDERS
========================================== */
$orders = mysqli_query(
    $conn,
    "SELECT
        orders.*,
        users.fullname
     FROM orders
     INNER JOIN users
     ON orders.user_id = users.user_id
     ORDER BY orders.order_date DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Customer Orders
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
                <a href="audit_log.php">
                    Audit Log
                </a>
            </li>
            <li>
                <a href="../logout.php">
                    Logout
                </a>
            </li>
        </ul>
    </nav>
    <section class="hero">
        <h1>
            Customer
            <span>
                Orders
            </span>
        </h1>
        <p>
            Monitor customer purchases and update order status.
        </p>
    </section>
    <div class="container">
        <div class="card" style="padding:30px;">
            <h2 style="margin-bottom:25px; color:var(--brown);">
                Customer Orders
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>
                            Order #
                        </th>
                        <th>
                            Customer
                        </th>
                        <th>
                            Payment
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
while($row = mysqli_fetch_assoc($orders)){
?>
                    <tr>
                        <td>
                            #<?php echo $row['order_id']; ?>
                        </td>
                        <td>
                            <?php echo $row['fullname']; ?>
                        </td>
                        <td>
                            <?php echo $row['payment_method']; ?>
                        </td>
                        <td>
                            ₱<?php echo number_format($row['total_amount'],2); ?>
                        </td>
                        <td>
                            <?php echo $row['delivery_address']; ?>
                        </td>
                        <td>
                            <?php echo $row['order_date']; ?>
                        </td>
                        <td>
                            <span style="font-weight:bold; color:#5C2D0A;">
                                <?php echo $row['order_status']; ?>
                            </span>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                <select name="status" style="padding:8px; border-radius:6px;">
                                    <option <?php if($row['order_status']=="Pending") echo "selected"; ?>>
                                        Pending
                                    </option>
                                    <option <?php if($row['order_status']=="Processing") echo "selected"; ?>>
                                        Processing
                                    </option>
                                    <option <?php if($row['order_status']=="Completed") echo "selected"; ?>>
                                        Completed
                                    </option>
                                    <option <?php if($row['order_status']=="Cancelled") echo "selected"; ?>>
                                        Cancelled
                                    </option>
                                </select>
                                <br><br>
                                <button name="update_status" class="btn btn-primary">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
}
?>
                </tbody>
            </table>
        </div>
    </div>
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
