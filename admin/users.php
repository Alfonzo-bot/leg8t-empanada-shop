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
        User Management
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
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <h2 style="color:var(--brown);">
                User Management
            </h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
$result = mysqli_query(
    $conn,
    "SELECT *
     FROM users
     ORDER BY user_id DESC"
);
while($row = mysqli_fetch_assoc($result)){
?>
                <tr>
                    <td>
                        <?php echo $row['user_id']; ?>
                    </td>
                    <td>
                        <?php echo $row['fullname']; ?>
                    </td>
                    <td>
                        <?php echo $row['email']; ?>
                    </td>
                    <td>
                        <?php echo $row['contact']; ?>
                    </td>
                    <td>
                        <?php echo ucfirst($row['role']); ?>
                    </td>
                    <td>
                        <?php echo ucfirst($row['status']); ?>
                    </td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-secondary">
                            Edit
                        </a>
                        <a href="delete_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this user?')">
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
