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
        Audit Log
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
    <div class="container">
        <h2 style="color:var(--brown); margin-bottom:25px;">
            Audit Log
        </h2>
        <table>
            <thead>
                <tr>
                    <th>Log ID</th>
                    <th>User ID</th>
                    <th>Activity</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
$result = mysqli_query(
    $conn,
    "SELECT *
     FROM audit_log
     ORDER BY activity_date DESC"
);
while($row = mysqli_fetch_assoc($result)){
?>
                <tr>
                    <td>
                        <?php echo $row['log_id']; ?>
                    </td>
                    <td>
                        <?php echo $row['user_id']; ?>
                    </td>
                    <td>
                        <?php echo $row['activity']; ?>
                    </td>
                    <td>
                        <?php echo $row['activity_date']; ?>
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
