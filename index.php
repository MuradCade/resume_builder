<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Builder - Home</title>
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero {
            /* background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://source.unsplash.com/1600x900/?resume,office') center/cover no-repeat; */
            background-color: #f1604d;
            color: white;
            padding: 100px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }
        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
        }
        .feature-box {
            text-align: center;
            padding: 30px;
            transition: transform 0.3s;
        }
        .feature-box i {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 15px;
        }
        .feature-box:hover {
            transform: translateY(-10px);
        }
        .footer {
            background: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Create Your Professional Resume Effortlessly</h1>
            <p>Join thousands of users in crafting the perfect resume with our intuitive builder.</p>
            <a href="signup.html" class="btn btn-secondary btn-lg mt-3">Get Started</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container my-5">
        <div class="row text-center">
            <div class="col-md-4 feature-box">
                <i class="bi bi-lightning-charge-fill"></i>
                <h4>Fast & Easy</h4>
                <p>Quickly input your details and generate a professional resume in minutes.</p>
            </div>
            <div class="col-md-4 feature-box">
                <i class="bi bi-shield-lock-fill"></i>
                <h4>Secure Authentication</h4>
                <p>Protect your account with email verification and secure login.</p>
            </div>
            <div class="col-md-4 feature-box">
                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                <h4>Download as PDF</h4>
                <p>Easily download your resume in high-quality PDF format.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="container text-center my-5">
        <h2>What Our Users Say</h2>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <blockquote class="blockquote">
                    <p>"This resume builder made the process so simple. I landed my dream job thanks to this tool!"</p>
                    <footer class="blockquote-footer">Jane Smith, Software Engineer</footer>
                </blockquote>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Resume Builder | All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>
