<?php
session_start();
include("../includes/db.php");
/* ==========================================
   DELETE PRODUCT
========================================== */
if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}
$id = $_GET['id'];
/* ==========================================
   GET IMAGE
========================================== */
$result = mysqli_query(
    $conn,
    "SELECT image
     FROM products
     WHERE product_id='$id'"
);
$product = mysqli_fetch_assoc($result);
/* ==========================================
   DELETE IMAGE
========================================== */
if (
    $product &&
    $product['image'] != "" &&
    file_exists("../images/".$product['image'])
) {
    unlink("../images/".$product['image']);
}
/* ==========================================
   DELETE PRODUCT
========================================== */
mysqli_query(
    $conn,
    "DELETE FROM products
     WHERE product_id='$id'"
);
header("Location: products.php");
exit();
?>
