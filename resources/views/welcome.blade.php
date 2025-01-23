<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - Islamic Proposals</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for Animations -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        /* [Your existing CSS styles here] */
        :root {
            --primary-color: #2D3047;
            --accent-color: #9c0c58;
            --text-color: #2D3047;
            --light-gray: #f8f9fa;
        }

        body {
            background: white;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            /* overflow: hidden; */
            /* Prevent scrolling */
            position: relative;
        }

        /* Add these styles to your existing CSS */

        /* Alert Styles */
        .alert {
            position: relative;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 15px;
            font-size: 0.9rem;
            font-weight: 500;
            animation: slideDown 0.3s ease-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .alert-success {
            background-color: rgba(75, 181, 67, 0.1);
            color: #2d8a25;
            border-left: 4px solid #4BB543;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-left: 4px solid #dc3545;
        }

        .alert ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .alert ul li {
            margin-bottom: 0.3rem;
        }

        .alert ul li:last-child {
            margin-bottom: 0;
        }

        /* Close button for alerts */
        .alert-dismissible {
            padding-right: 3rem;
        }

        .alert-dismissible .close {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            padding: 0.5rem;
            background: transparent;
            border: none;
            color: inherit;
            opacity: 0.7;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .alert-dismissible .close:hover {
            opacity: 1;
        }

        /* Animation for alerts */
        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Alert icon styles */
        .alert::before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            margin-right: 10px;
            font-size: 1rem;
        }

        .alert-success::before {
            content: "\f00c";
            /* Checkmark icon */
        }

        .alert-danger::before {
            content: "\f071";
            /* Warning icon */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .alert {
                padding: 0.8rem 1rem;
                font-size: 0.85rem;
            }
        }

        .pattern-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(#f0f0f0 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.3;
            pointer-events: none;
            z-index: 0;
        }

        .main-container {
            position: relative;
            z-index: 1;
            padding: 1rem;
        }

        .logo-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
        }

        .logo-circle {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 2px solid var(--accent-color);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            height: 90%;
            object-fit: contain;
            border-radius: 50%;
            padding: 8px;
        }

        /* Flexbox for Equal Height Feature Cards */
        .feature-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .feature-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 15px;
            padding: 1.5rem;
            margin: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            flex: 1 1 200px;
            /* Flex-grow, Flex-shrink, Flex-basis */
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 200px;
            /* Fixed height for uniformity */
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 0;
            background: var(--accent-color);
            transition: height 0.3s ease;
        }

        .feature-card:hover::before {
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .subscribe-form {
            position: relative;
            max-width: 400px;
            margin: 1.5rem auto;
        }

        .form-control {
            padding: 0.8rem 1.2rem;
            border-radius: 50px;
            border: 2px solid #eee;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: none;
        }

        .btn-notify {
            background: var(--accent-color);
            color: white;
            border-radius: 50px;
            padding: 0.6rem 1.8rem;
            border: none;
            position: relative;
            overflow: hidden;
            font-size: 0.9rem;
            font-weight: 600;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn-notify::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-notify:hover::after {
            left: 100%;
        }

        .btn-notify:hover {
            background: #c22a7b;
            transform: translateY(-2px);
        }

        .social-links a {
            color: var(--text-color);
            margin: 0 10px;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .social-links a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background: var(--accent-color);
            bottom: -5px;
            left: 0;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .social-links a:hover::after {
            transform: scaleX(1);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 1.5rem 0;
            flex-wrap: wrap;
        }

        .countdown-item {
            text-align: center;
            background: var(--light-gray);
            padding: 0.8rem 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            min-width: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100px;
            /* Fixed width for uniformity */
            height: 100px;
            /* Fixed height for uniformity */
        }

        .countdown-number {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--accent-color);
            margin-bottom: 0.3rem;
        }

        .countdown-label {
            font-size: 0.75rem;
            color: var(--text-color);
            text-transform: uppercase;
        }

        /* Moving Background Elements */
        .moving-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .floating-element {
            position: absolute;
            background: linear-gradient(45deg, rgba(233, 30, 99, 0.05), rgba(233, 30, 99, 0.1));
            border-radius: 50%;
            pointer-events: none;
            animation: float-around 15s linear infinite;
        }

        .element-1 {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .element-2 {
            width: 100px;
            height: 100px;
            top: 70%;
            right: 10%;
            animation-delay: -5s;
        }

        .element-3 {
            width: 60px;
            height: 60px;
            top: 40%;
            left: 50%;
            animation-delay: -8s;
        }

        .element-4 {
            width: 90px;
            height: 90px;
            top: 20%;
            right: 30%;
            animation-delay: -12s;
        }

        @keyframes float-around {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(50px, 25px) rotate(90deg);
            }

            50% {
                transform: translate(25px, 50px) rotate(180deg);
            }

            75% {
                transform: translate(-25px, 25px) rotate(270deg);
            }

            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .countdown {
                gap: 0.5rem;
            }

            .countdown-number {
                font-size: 1.5rem;
            }

            .countdown-label {
                font-size: 0.7rem;
            }

            .feature-card {
                padding: 1rem;
                margin: 0.3rem;
                height: 180px;
                /* Adjusted for smaller screens */
            }

            .logo-container {
                width: 100px;
                height: 100px;
                margin-bottom: 1rem;
            }

            .logo {
                padding: 6px;
            }

            .btn-notify {
                padding: 0.6rem 1.5rem;
                font-size: 0.8rem;
            }

            .countdown-item {
                width: 80px;
                /* Adjusted width for smaller screens */
                height: 80px;
                /* Adjusted height for smaller screens */
            }

            .feature-row {
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Pattern Overlay -->
    <div class="pattern-overlay"></div>

    <!-- Moving Background Elements -->
    <div class="moving-background">
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        <div class="floating-element element-3"></div>
        <div class="floating-element element-4"></div>
    </div>

    <!-- Main Content -->
    <div class="container main-container d-flex align-items-center justify-content-center">
        <div class="row w-100">
            <div class="col-12 mt-5 text-center">
                <!-- Logo -->
                <div class="logo-container">
                    <div class="logo-circle"></div>
                    <img src="{{ asset('admin/assets/images/brands/proposals-logo.jpeg') }}" alt="Islamic Proposals"
                        class="logo">
                </div>

                <!-- Heading -->
                <h1 class="display-5 mb-2 animate__animated animate__fadeIn">Coming Soon</h1>
                <p class="lead mb-3 animate__animated animate__fadeIn">Finding your soulmate the halal way</p>

                <!-- Countdown Timer -->
                <div class="countdown mb-3">
                    <div class="countdown-item">
                        <div class="countdown-number" id="days">00</div>
                        <div class="countdown-label">Days</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="hours">00</div>
                        <div class="countdown-label">Hours</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="minutes">00</div>
                        <div class="countdown-label">Minutes</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="seconds">00</div>
                        <div class="countdown-label">Seconds</div>
                    </div>
                </div>

                <!-- Feature Cards -->
                <div class="feature-row mb-3">
                    <div class="feature-card animate__animated animate__fadeInUp">
                        <i class="fas fa-heart mb-2" style="color: var(--accent-color); font-size: 1.2rem;"></i>
                        <h6>Halal Matchmaking</h6>
                        <p class="mb-0">Guided by Islamic principles</p>
                    </div>
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                        <i class="fas fa-shield-alt mb-2" style="color: var(--accent-color); font-size: 1.2rem;"></i>
                        <h6>Safe & Secure</h6>
                        <p class="mb-0">Your privacy matters</p>
                    </div>
                </div>

                <!-- Subscription Form -->
                <div class="subscribe-form">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('subscribe.message') }}" method="POST"
                        class="d-flex justify-content-center gap-2">
                        @csrf
                        <input type="email" name="email" class="form-control" placeholder="Your email address"
                            required>
                        <button type="submit" class="btn btn-notify">Notify Me</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Countdown Script -->
    <script>
        // Set the launch date to 2 months from now
        const launchDate = new Date();
        launchDate.setMonth(launchDate.getMonth() + 2);

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = launchDate - now;

            // Time calculations
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Update the countdown display
            document.getElementById('days').innerHTML = days.toString().padStart(2, '0');
            document.getElementById('hours').innerHTML = hours.toString().padStart(2, '0');
            document.getElementById('minutes').innerHTML = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').innerHTML = seconds.toString().padStart(2, '0');

            // If the countdown is finished, display a message
            if (distance < 0) {
                clearInterval(countdownInterval);
                document.querySelector('.countdown').innerHTML =
                    '<div class="countdown-item"><div class="countdown-number">00</div><div class="countdown-label">Days</div></div><div class="countdown-item"><div class="countdown-number">00</div><div class="countdown-label">Hours</div></div><div class="countdown-item"><div class="countdown-number">00</div><div class="countdown-label">Minutes</div></div><div class="countdown-item"><div class="countdown-number">00</div><div class="countdown-label">Seconds</div></div>';
            }
        }

        // Update the countdown every second
        updateCountdown(); // Initial call
        const countdownInterval = setInterval(updateCountdown, 1000);

        // Add interactive movement to floating elements based on mouse position
        document.addEventListener('mousemove', (e) => {
            const elements = document.querySelectorAll('.floating-element');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            elements.forEach((element, index) => {
                const movement = (index + 1) * 10; // Reduced movement for smaller elements
                const translateX = (mouseX - 0.5) * movement;
                const translateY = (mouseY - 0.5) * movement;

                element.style.transform =
                    `translate(${translateX}px, ${translateY}px) rotate(${translateX}deg)`;
            });
        });
        // Add this to your existing script section
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // Add fade out animation before closing
            const closeButtons = document.querySelectorAll('.alert .close');
            closeButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const alert = this.closest('.alert');
                    alert.style.transition = 'opacity 0.3s ease-out';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }, 300);
                });
            });
        });
    </script>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
