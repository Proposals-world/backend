<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Islamic Proposals - Find Your Soulmate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #E91E63;
            --secondary-color: #FF4081;
            --accent-color: #880E4F;
        }

        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle, rgba(233,30,99,0.2) 0%, rgba(136,14,79,0.4) 100%);
        }

        .navbar {
            background-color: rgba(255,255,255,0.95) !important;
            backdrop-filter: blur(10px);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.2);
        }

        .testimonial-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
        }

        .testimonial-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid var(--primary-color);
            padding: 3px;
        }

        .app-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        }

        .app-screenshot {
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .app-screenshot:hover {
            transform: scale(1.05);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, 15px); }
            100% { transform: translate(0, -0px); }
        }

        .feature-card {
            padding: 2rem;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .social-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--primary-color);
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.2);
            background: var(--secondary-color);
        }

        footer {
            background: linear-gradient(to right, #1a1a1a, #2d2d2d);
        }

    </style>
</head>
<body>
<!-- Navbar -->
{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Islamic Proposals</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
                <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                <li class="nav-item"><a class="nav-link" href="#download">Download</a></li>
                <li class="nav-item"><a class="nav-link btn btn-success ms-2" href="#register">Register Now</a></li>
            </ul>
        </div>
    </div>
</nav> --}}

<!-- Hero Section -->
<section class="hero-section d-flex align-items-center">
    <div class="container text-center">
        <h1 class="display-4 mb-4 animate__animated animate__fadeInDown">Find Your Soulmate the Halal Way</h1>
        <p class="lead mb-5 animate__animated animate__fadeInUp">Join thousands of Muslims who have found their perfect match through our Islamic matrimonial service</p>
        {{-- <a href="#register" class="btn btn-success btn-lg me-3 animate__animated animate__fadeInLeft">Get Started</a>
        <a href="#learn-more" class="btn btn-outline-light btn-lg animate__animated animate__fadeInRight">Learn More</a> --}}
    </div>
</section>


</body>
</html>
