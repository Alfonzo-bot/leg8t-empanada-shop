<?php
session_start();
include("includes/db.php");
include("includes/log_activity.php");
include("config/mail.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
/* ==========================================
   REGISTER
========================================== */
if (isset($_POST['register'])) {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $address = trim($_POST['address']);
    $contact = trim($_POST['contact']);
    /* ==========================
       PASSWORD CHECK
    ========================== */
    if ($password != $confirm) {
        $error = "Password and Confirm Password do not match.";
    } else {
        /* ==========================
           CHECK EXISTING EMAIL
        ========================== */
        $check = mysqli_query(
            $conn,
            "SELECT *
             FROM users
             WHERE email='$email'"
        );
        if (mysqli_num_rows($check) > 0) {
            $error = "Email already exists.";
        } else {
            /* ==========================
               HASH PASSWORD
            ========================== */
            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
            mysqli_query(
                $conn,
                "INSERT INTO users
                (
                    fullname,
                    email,
                    password,
                    address,
                    contact,
                    role,
                    status
                )
                VALUES
                (
                    '$fullname',
                    '$email',
                    '$hashedPassword',
                    '$address',
                    '$contact',
                    'buyer',
                    'pending'
                )"
            );
            $user_id = mysqli_insert_id($conn);
            /* ==========================
               SEND EMAIL
            ========================== */
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = $mailUsername;
                $mail->Password = $mailPassword;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom(
                    $mailUsername,
                    "Leg8t Empanada"
                );
                $mail->addAddress(
                    $email,
                    $fullname
                );
                $mail->isHTML(true);
                $mail->Subject = "Welcome to Leg8t Empanada";
                $mail->Body = "
                <div style='font-family:Arial,sans-serif;padding:20px;'>
                    <h2 style='color:#5C2D0A;'>
                        Welcome to Leg8t Empanada!
                    </h2>
                    <p>
                        Hello <strong>$fullname</strong>,
                    </p>
                    <p>
                        Thank you for registering with
                        <strong>Leg8t Empanada</strong>.
                    </p>
                    <p>
                        Your account has been successfully created.
                    </p>
                    <hr>
                    <p>
                        <strong>Email Address:</strong>
                        $email
                    </p>
                    <p>
                        Your account is currently
                        <strong>Pending</strong>
                        until approved by the administrator.
                    </p>
                    <br>
                    <p>
                        Thank you for choosing
                        <strong>Leg8t Empanada</strong>.
                    </p>
                </div>
                ";
                $mail->send();
            } catch (Exception $e) {
                $error = "Registration completed, but the confirmation email could not be sent.";
            }
            /* ==========================
               AUDIT LOG
            ========================== */
            logActivity(
                $conn,
                $user_id,
                "Registered New Account"
            );
            if (!isset($error)) {
                $success = "Registration successful! A confirmation email has been sent to your email address.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Register
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
            Create Account
        </h2>
        <p>
            Register to start ordering delicious empanadas.
        </p>
        <?php
if (isset($error)) {
?>
        <div class="error">
            <?php echo $error; ?>
        </div>
        <?php
}
if (isset($success)) {
?>
        <div class="success">
            <?php echo $success; ?>
        </div>
        <?php
}
?>
        <form method="POST">
            <div class="form-group">
                <label>
                    Complete Name
                </label>
                <input type="text" name="fullname" required>
            </div>
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
                <input type="password" name="password" required autocomplete="new-password">
            </div>
            <div class="form-group">
                <label>
                    Confirm Password
                </label>
                <input type="password" name="confirm" required autocomplete="new-password">
            </div>
            <div class="form-group">
                <label>
                    Complete Address
                </label>
                <textarea name="address" required></textarea>
            </div>
            <div class="form-group">
                <label>
                    Contact Number
                </label>
                <input type="text" name="contact" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary" style="width:100%;">
                Create Account
            </button>
        </form>
        <br>
        <center>
            Already have an account?
            <a href="login.php">
                Login
            </a>
        </center>
    </div>
    <footer>
        🫓
        <strong>
            Leg8t Empanada
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
