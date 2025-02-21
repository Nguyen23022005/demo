</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?= $title ?? "My App" ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->


    <!-- Fonts -->

    <!-- Vendor CSS Files -->
    <!-- <link href="image/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="image/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="image/vendor/aos/aos.css" rel="stylesheet">
  <link href="image/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="image/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

     Main CSS File -->
    <!-- <link href="./main.css" rel="stylesheet"> -->

    <!-- =======================================================
  * Template Name: Sailor
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styles */
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            background-color: #ffffff;
        }

        /* Header */
        .header {
            background: #fff;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .container-xl {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo img {
            height: 50px;
            width: 50px;
            object-fit: cover;
            margin-right: 10px;
        }

        .logo h1 {
            font-size: 22px;
            color: #333;
            font-weight: bold;
        }

        /* Navigation Menu */
        .navmenu ul {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navmenu ul li {
            display: inline-block;
        }

        .navmenu ul li a {
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            color: #444;
            padding: 10px 15px;
            transition: color 0.3s;
        }

        .navmenu ul li a:hover,
        .navmenu ul li a.active {
            color: red;
        }


        /* Welcome Text */
        .navmenu ul li a.welcome-text {
            font-weight: bold;
            color: #333;
        }

        /* Logout Button */
        .btn-getstarted {
            background: red;
            color: white;
            font-size: 16px;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-getstarted:hover {
            background: darkred;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navmenu ul {
                flex-direction: column;
                align-items: flex-start;
            }

            .navmenu ul li {
                width: 100%;
            }

            .navmenu ul li a {
                display: block;
                width: 100%;
                text-align: left;
            }
        }

        /* Footer Styles */
        .footer {
            background: #2e3641;
            color: #d1d7e0;
            padding: 50px 0;
            font-size: 16px;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
            transition: 0.3s;
        }

        .footer a:hover {
            color: #ff4d4d;
        }

        .footer .footer-top {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-about {
            max-width: 300px;
        }

        .footer-about .sitename {
            font-size: 22px;
            font-weight: bold;
            color: #ffffff;
        }

        .footer-contact p {
            margin: 5px 0;
        }

        .footer-contact strong {
            color: #ffffff;
        }

        .social-links {
            display: flex;
            gap: 10px;
        }

        .social-links a {
            font-size: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: #ffffff20;
            border-radius: 50%;
            transition: 0.3s;
        }

        .social-links a:hover {
            background: #ff4d4d;
            color: #fff;
        }

        /* Footer Links */
        .footer-links h4,
        .footer-newsletter h4 {
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 15px;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links ul li {
            margin-bottom: 10px;
        }

        .footer-newsletter p {
            font-size: 14px;
        }

        /* Newsletter */
        .newsletter-form {
            display: flex;
            margin-top: 10px;
        }

        .newsletter-form input[type="email"] {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 5px 0 0 5px;
            outline: none;
        }

        .newsletter-form input[type="submit"] {
            background: red;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: 0.3s;
        }

        .newsletter-form input[type="submit"]:hover {
            background: darkred;
        }

        /* Copyright */
        .copyright {
            border-top: 1px solid #444;
            padding-top: 20px;
            font-size: 14px;
        }

        .credits a {
            color: red;
        }

        /* Scroll to Top Button */
        .scroll-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: red;
            color: white;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            transition: 0.3s;
        }

        .scroll-top:hover {
            background: darkred;
        }
    </style>
</head>


<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">



            <nav id="navmenu" class="navmenu">
                <ul>
                    <a href="index.html" class="logo d-flex align-items-center me-auto">
                        <!-- Uncomment the line below if you also wish to use an image logo -->
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPG778OYL7hZbcyd2FnVYhYAT6xNXuGRxz1A&s" alt="">
                        <h1 class="sitename">Sailor</h1>
                    </a>
                    <li><a href="/" class="active">Home</a></li>


                    <li><a href="/products">product</a></li>


                    </li>
                    <li><a href="/products">Product</a></li>
                    <li><a href="/categories">categories</a></li>
                    <li><a href="/users">User</a></li>
                    <li><a href="sizes">Size</a></li>
                    <li><a href="colors">colors</a></li>
                    <li><a href="productsVariants">ProductVariant</a></li>

                    <?php if (isset($_SESSION['user'])): ?>
                        <li><a>Welcome, <?= htmlspecialchars($_SESSION['user']['name']); ?></a></li>

                        <a href="/logout" class="btn-getstarted">Logout</a>
                    <?php else: ?>
                        <a href="/login" class="btn-getstarted">Login</a>
                        <a href="/register" class="btn-getstarted">Register</a>
                    <?php endif; ?>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>




        </div>
    </header>


    <main class="container my-4">
        <?= $content ?>
    </main>


</body>
<footer id="footer" class="footer dark-background">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.html" class="logo d-flex align-items-center">
                    <span class="sitename">Sailor</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>A108 Adam Street</p>
                    <p>New York, NY 535022</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                    <p><strong>Email:</strong> <span>info@example.com</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Terms of service</a></li>
                    <li><a href="#">Privacy policy</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Product Management</a></li>
                    <li><a href="#">Marketing</a></li>
                    <li><a href="#">Graphic Design</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12 footer-newsletter">
                <h4>Our Newsletter</h4>
                <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                <form action="forms/newsletter.php" method="post" class="php-email-form">
                    <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                </form>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Sailor</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short">^^</i></a>


</html>