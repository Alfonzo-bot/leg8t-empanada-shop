<?php
session_start();
include("../includes/db.php");
/* ==========================================
   GET USER
========================================== */
if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}
$id = $_GET['id'];
$result = mysqli_query(
    $conn,
    "SELECT *
     FROM users
     WHERE user_id='$id'"
);
$user = mysqli_fetch_assoc($result);
/* ==========================================
   UPDATE USER
========================================== */
if (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $address  = $_POST['address'];
    $contact  = $_POST['contact'];
    $role     = $_POST['role'];
    $status   = $_POST['status'];
    mysqli_query(
        $conn,
        "UPDATE users SET
        fullname='$fullname',
        email='$email',
        address='$address',
        contact='$contact',
        role='$role',
        status='$status'
        WHERE user_id='$id'"
    );
    header("Location: users.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Edit User
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
                <a href="../logout.php">
                    Logout
                </a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="form-card">
            <h2>
                Edit User
            </h2>
            <form method="POST">
                <div class="form-group">
                    <label>
                        Full Name
                    </label>
                    <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" required>
                </div>
                <div class="form-group">
                    <label>
                        Email
                    </label>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label>
                        Address
                    </label>
                    <textarea name="address" required><?php echo $user['address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>
                        Contact Number
                    </label>
                    <input type="text" name="contact" value="<?php echo $user['contact']; ?>" required>
                </div>
                <div class="form-group">
                    <label>
                        Role
                    </label>
                    <select name="role" required>
                        <option value="buyer" <?php if($user['role']=="buyer") echo "selected"; ?>>
                            Buyer
                        </option>
                        <option value="admin" <?php if($user['role']=="admin") echo "selected"; ?>>
                            Admin
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        Status
                    </label>
                    <select name="status" required>
                        <option value="pending" <?php if($user['status']=="pending") echo "selected"; ?>>
                            Pending
                        </option>
                        <option value="active" <?php if($user['status']=="active") echo "selected"; ?>>
                            Active
                        </option>
                        <option value="inactive" <?php if($user['status']=="inactive") echo "selected"; ?>>
                            Inactive
                        </option>
                    </select>
                </div>
                <button name="update" class="btn btn-primary" style="width:100%;">
                    Update User
                </button>
            </form>
            <br>
            <center>
                <a href="users.php">
                    ← Back to Users
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
