<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Leg8t Empanada</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ==========================================
     NAVIGATION
========================================== -->
<nav>
    <div class="logo">
        <img src="images/logo.png" alt="Leg8t Empanada" class="logo-image">
    </div>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="store.php">Store</a></li>
        <li><a href="about.php" class="active">About</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>

<!-- ==========================================
     HERO
========================================== -->
<section class="hero">
    <img src="images/logo.png" class="about-logo" alt="Leg8t Logo">
    <h1>About <span>Leg8t Empanada</span></h1>
    <p>Freshly Baked &bull; Authentic Flavors</p>
</section>

<!-- ==========================================
     ABOUT
========================================== -->
<div class="container about-container">

    <div class="about-card">
        <h2>Our Story</h2>
        <p>
            Leg8t Empanada is a modern web-based ordering system inspired by the
            rich Filipino tradition of serving freshly baked empanadas made from
            quality ingredients. The project was created to provide customers
            with a simple, fast, and convenient online ordering experience while
            allowing the business to efficiently manage products, inventory,
            customers, and orders.
        </p>
        <p>
            This system was developed as part of the CCS0043 Final Project by
            students of <strong>FEU Institute of Technology</strong> to
            demonstrate practical web development, database management, and
            software engineering skills.
        </p>
    </div>

    <br><br>

    <div class="about-grid">
        <div class="mission-card">
            <h2>🎯 Mission</h2>
            <p>
                To provide freshly baked, high-quality empanadas using premium
                ingredients while delivering excellent customer service,
                convenience, and customer satisfaction.
            </p>
        </div>

        <div class="mission-card">
            <h2>👁 Vision</h2>
            <p>
                To become one of the most trusted empanada brands by combining
                traditional Filipino recipes with modern technology, innovation,
                and outstanding service.
            </p>
        </div>
    </div>

    <br><br>

    <div class="about-card">
        <h2 style="text-align:center;">Meet the Developers</h2>
        <p style="text-align:center; margin-bottom:45px;">
            This website was designed and developed by students of
            <strong>FEU Institute of Technology</strong> for the
            <strong>CCS0043 Final Project.</strong>
        </p>

        <div class="team-grid">

            <!-- ==========================================
                 DEVELOPER 1
            ========================================== -->
            <div class="team-card">
                <img src="images/pfp1.jpg" class="team-photo" alt="Developer 1">
                <div class="team-content">
                    <h3>Member Name 1</h3>
                    <span class="role">Project Leader</span>
                    <p>
                        Responsible for the overall planning, backend development,
                        database integration, and system implementation.
                    </p>
                </div>
            </div>

            <!-- ==========================================
                 DEVELOPER 2
            ========================================== -->
            <div class="team-card">
                <img src="images/pfp2.jpg" class="team-photo" alt="Developer 2">
                <div class="team-content">
                    <h3>Member Name 2</h3>
                    <span class="role">Frontend Developer</span>
                    <p>
                        Responsible for the website layout, user interface,
                        responsive design, and user experience.
                    </p>
                </div>
            </div>

            <!-- ==========================================
                 DEVELOPER 3
            ========================================== -->
            <div class="team-card">
                <img src="images/pfp3.jpg" class="team-photo" alt="Developer 3">
                <div class="team-content">
                    <h3>Member Name 3</h3>
                    <span class="role">Database Administrator</span>
                    <p>
                        Responsible for database design, SQL implementation,
                        documentation, testing, and quality assurance.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <br><br>

</div>

<!-- ==========================================
     CONTACT
========================================== -->
<div class="container about-container">
    <div class="about-card">
        <h2 style="text-align:center;">Get in Touch</h2>
        <p style="text-align:center; margin-bottom:40px;">
            Have questions, suggestions, or would like to know more about
            Leg8t Empanada? Feel free to contact us.
        </p>

        <div class="contact-grid">
            <div>
                <h3>📧 Email</h3>
                <p>leg8tempanada@gmail.com</p>
            </div>

            <div>
                <h3>📍 Address</h3>
                <p>
                    FEU Institute of Technology<br>
                    Sampaloc, Manila<br>
                    Philippines
                </p>
            </div>

            <div>
                <h3>📱 Contact Number</h3>
                <p>+63 912 345 6789</p>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     FOOTER
========================================== -->
<footer>
    <br>
    <strong>Leg8t Empanada</strong>
    <br><br>
    CCS0043 Final Project
    <br>
    Group Name: <strong>YOUR GROUP NAME</strong>
    <br><br>
    ⚠️ This website is for educational purposes only.
</footer>

</body>
</html>
