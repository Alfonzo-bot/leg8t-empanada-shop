<?php
session_start();
include("../includes/db.php");
/* ==========================================
   CHECK USER ID
========================================== */
if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}
$id = $_GET['id'];
/* ==========================================
   OPTIONAL:
   PREVENT ADMIN FROM DELETING OWN ACCOUNT
========================================== */
if (
    isset($_SESSION['user_id']) &&
    $_SESSION['user_id'] == $id
) {
    echo "<script>
        alert('You cannot delete your own account.');
        window.location='users.php';
    </script>";
    exit();
}
/* ==========================================
   DELETE USER
========================================== */
mysqli_query(
    $conn,
    "DELETE FROM users
     WHERE user_id='$id'"
);
/* ==========================================
   REDIRECT
========================================== */
header("Location: users.php");
exit();
?>
