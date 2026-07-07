<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Crust Empanada Shop</title>
    <link rel="stylesheet" href="style.css">
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
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="store.php">Store</a>
            </li>
            <li>
                <a href="about.php">About</a>
            </li>
            <?php
if(isset($_SESSION['user_id'])){
?>
            <li>
                <a href="cart.php">Cart</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
            <?php
}else{
?>
            <li>
                <a href="login.php">Login</a>
            </li>
            <li>
                <a href="register.php">Register</a>
            </li>
            <?php
}
?>
        </ul>
    </nav>
    <!-- ==========================================
     HERO SECTION
========================================== -->
    <section class="hero">
        <h1>
            Freshly Baked
            <span>
                Empanadas
            </span>
        </h1>
        <p>
            Experience the perfect combination of crispy,
            golden pastry and delicious homemade fillings.
            Every empanada is freshly baked with love.
        </p>
        <br><br>
        <a href="store.php" class="btn btn-primary">
            🛒 Shop Now
        </a>
        &nbsp;
        <a href="about.php" class="btn btn-secondary">
            📖 Learn More
        </a>
    </section>
    <!-- ==========================================
     FEATURES
========================================== -->
    <div class="container">
        <h2 style="text-align:center; color:var(--brown); margin-bottom:40px;">
            Why Choose Golden Crust?
        </h2>
        <div class="grid">
            <div class="card" style="padding:30px;text-align:center;">
                <h1>🫓</h1>
                <h3>Fresh Daily</h3>
                <p>
                    Every empanada is baked fresh
                    every morning.
                </p>
            </div>
            <div class="card" style="padding:30px;text-align:center;">
                <h1>🥩</h1>
                <h3>Premium Ingredients</h3>
                <p>
                    Quality ingredients for
                    exceptional taste.
                </p>
            </div>
            <div class="card" style="padding:30px;text-align:center;">
                <h1>🚚</h1>
                <h3>Fast Delivery</h3>
                <p>
                    Fresh and hot empanadas
                    delivered to your doorstep.
                </p>
            </div>
        </div>
    </div>
    <!-- ==========================================
     FEATURED PRODUCTS
========================================== -->
    <div class="container">
        <h2 style="text-align:center; color:var(--brown); margin-bottom:40px;">
            Customer Favorites
        </h2>
        <div class="grid">
            <div class="product">
                <div class="product-image">
                    🥩
                </div>
                <div class="product-body">
                    <div class="category">
                        Best Seller
                    </div>
                    <h3>
                        Beef Empanada
                    </h3>
                    <p>
                        Crispy pastry filled with
                        flavorful seasoned beef.
                    </p>
                    <div class="price">
                        ₱30.00
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="product-image">
                    🍗
                </div>
                <div class="product-body">
                    <div class="category">
                        Popular
                    </div>
                    <h3>
                        Chicken Empanada
                    </h3>
                    <p>
                        Tender chicken with herbs
                        inside flaky pastry.
                    </p>
                    <div class="price">
                        ₱25.00
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="product-image">
                    🧀
                </div>
                <div class="product-body">
                    <div class="category">
                        New
                    </div>
                    <h3>
                        Cheese Empanada
                    </h3>
                    <p>
                        Rich melted cheese wrapped
                        in golden pastry.
                    </p>
                    <div class="price">
                        ₱35.00
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========================================
     CALL TO ACTION
========================================== -->
    <section style="background:#5C2D0A; color:white; text-align:center; padding:80px 20px; margin-top:60px;">
        <h2>
            Ready to Taste the Best Empanadas?
        </h2>
        <br>
        <p>
            Order today and enjoy freshly baked
            empanadas made just for you.
        </p>
        <br><br>
        <a href="store.php" class="btn btn-primary">
            Start Ordering
        </a>
    </section>
    <!-- ==========================================
     FOOTER
========================================== -->
    <footer>
        <strong>
            🫓 Leg8t Empanada
        </strong>
        <br><br>
        Freshly Baked • Freshly Served
        <br><br>
        © 2026 Leg8t Empanada
    </footer>
</body>
</html>
