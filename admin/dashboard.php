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
   DASHBOARD COUNTS
========================================== */
$users = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM users"
    )
);
$products = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM products"
    )
);
$orders = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM orders"
    )
);
$inventory = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT SUM(stock) AS total_stock
         FROM products"
    )
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Admin Dashboard
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
                <a href="../store.php">
                    Store
                </a>
            </li>
            <li>
                <a href="../about.php">
                    About
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
     HERO
========================================== -->
    <section class="hero">
        <h1>
            Admin
            <span>
                Dashboard
            </span>
        </h1>
        <p>
            Manage products,
            users,
            inventory,
            orders
            and reports.
        </p>
    </section>
    <!-- ==========================================
     DASHBOARD
========================================== -->
    <div class="container">
        <div class="grid">
            <div class="card" style="padding:25px;text-align:center;">
                <h3>
                    👥 Users
                </h3>
                <h1 style="color:var(--brown);margin-top:10px;">
                    <?php
echo $users;
?>
                </h1>
            </div>
            <div class="card" style="padding:25px;text-align:center;">
                <h3>
                    🫓 Products
                </h3>
                <h1 style="color:var(--brown);margin-top:10px;">
                    <?php
echo $products;
?>
                </h1>
            </div>
            <div class="card" style="padding:25px;text-align:center;">
                <h3>
                    📦 Total Stock
                </h3>
                <h1 style="color:var(--brown);margin-top:10px;">
                    <?php
echo $inventory['total_stock'];
?>
                </h1>
            </div>
            <div class="card" style="padding:25px;text-align:center;">
                <h3>
                    🛒 Orders
                </h3>
                <h1 style="color:var(--brown);margin-top:10px;">
                    <?php
echo $orders;
?>
                </h1>
            </div>
        </div>
        <br><br>
        <div class="card" style="padding:30px;">
            <h2 style="color:var(--brown); margin-bottom:25px;">
                Management Panel
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>
                            Module
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            👥 Users
                        </td>
                        <td>
                            Manage registered users.
                        </td>
                        <td>
                            <a href="users.php" class="btn btn-primary">
                                Open
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            🫓 Products
                        </td>
                        <td>
                            Add, edit or delete products.
                        </td>
                        <td>
                            <a href="products.php" class="btn btn-primary">
                                Open
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            📦 Inventory
                        </td>
                        <td>
                            View available stocks.
                        </td>
                        <td>
                            <a href="inventory.php" class="btn btn-primary">
                                Open
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            📋 Audit Log
                        </td>
                        <td>
                            Monitor system activities.
                        </td>
                        <td>
                            <a href="audit_log.php" class="btn btn-primary">
                                Open
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            🛒 Orders
                        </td>
                        <td>
                            View customer orders.
                        </td>
                        <td>
                            <a href="orders.php" class="btn btn-primary">
                                Open
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
