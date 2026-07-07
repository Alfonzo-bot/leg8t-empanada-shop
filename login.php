<?php
session_start();
include("includes/db.php");
include("includes/log_activity.php");
/* ==========================================
   LOGIN PROCESS
========================================== */
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $query = mysqli_query(
        $conn,
        "SELECT *
         FROM users
         WHERE email='$email'
         LIMIT 1"
    );
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        /* ==================================
           VERIFY HASHED PASSWORD
        ================================== */
        if (password_verify($password, $user['password'])) {
            /* ==============================
               CHECK ACCOUNT STATUS
            ============================== */
            if ($user['status'] != "active") {
                $error = "Your account is not yet active. Please wait for admin approval.";
            } else {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['role'] = $user['role'];
                /* ==============================
                   AUDIT LOG
                ============================== */
                logActivity(
                    $conn,
                    $user['user_id'],
                    "User Logged In"
                );
                /* ==============================
                   REDIRECT
                ============================== */
                if ($user['role'] == "admin") {
                    header("Location: admin/dashboard.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            }
        } else {
            $error = "Invalid Email or Password.";
        }
    } else {
        $error = "Invalid Email or Password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Login
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
    <div class="form-card">
        <h2>
            Welcome Back
        </h2>
        <p>
            Login to continue ordering delicious empanadas.
        </p>
        <?php
if (isset($error)) {
?>
        <div class="error">
            <?php echo $error; ?>
        </div>
        <?php
}
?>
        <form method="POST">
            <div class="form-group">
                <label>
                    Email Address
                </label>
                <input type="email" name="email" required autocomplete="email">
            </div>
            <div class="form-group">
                <label>
                    Password
                </label>
                <input type="password" name="password" required autocomplete="current-password">
            </div>
            <button type="submit" name="login" class="btn btn-primary" style="width:100%;">
                Login
            </button>
        </form>
        <br>
        <center>
            Don't have an account?
            <a href="register.php">
                Create One
            </a>
        </center>
    </div>
    <footer>
        🫓
        <strong>
            Leg8t Empanada
        </strong>
        <br><br>
        ⚠️ This website is for educational purposes only and is submitted as our Final Project.
    </footer>
</body>
</html>
