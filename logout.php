<?php
session_start();
include("includes/db.php");
include("includes/log_activity.php");
/* ==========================================
   LOGOUT
========================================== */
if (isset($_SESSION['user_id'])) {
    logActivity(
        $conn,
        $_SESSION['user_id'],
        "User Logged Out"
    );
}
/* ==========================================
   DESTROY SESSION
========================================== */
session_unset();
session_destroy();
/* ==========================================
   REDIRECT
========================================== */
header("Location: login.php");
exit();
?>
