<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuristic Blog | Home</title>
    <link rel="stylesheet" href="css/style-homepage.css">
</head>
<body>
<div class="planet-container">
    <div class="planet planet1"></div>
    <div class="planet planet2"></div>
    <div class="planet planet3"></div>
</div>

    <header>
        <div class="container">
            <div class="logo">🚀 Futuristic<span>Blog</span></div>
            <nav>
                <a href="homepage.php" class="active">Home</a>
                <a href="login.php">Login</a>
                <a href="register.php">Sign Up</a>
                <a href="pages/dashboard.php">Dashboard</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to the Future of Blogging</h1>
            <p>Unleash your creativity in a futuristic space where your thoughts glow and your stories shine.</p>
            <a href="register.php" class="btn">Get Started</a>
        </div>
    </section>

    <section class="features">
        <h2>Why Choose Us?</h2>
        <div class="feature-box">
            <div class="feature">
                <h3>⚡ Fast & Secure</h3>
                <p>High-performance PHP & MySQL ensuring a smooth experience.</p>
            </div>
            <div class="feature">
                <h3>🌐 Fully Responsive</h3>
                <p>Seamless UI accessible from any device.</p>
            </div>
            <div class="feature">
                <h3>🚀 Light & Dark Mode</h3>
                <p>Effortless theme switching for better reading.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 FuturisticBlog | Designed for the Hackathon</p>
    </footer>
    <script>
document.querySelectorAll('.planet').forEach(planet => {
    planet.addEventListener('mouseover', () => {
        planet.style.transform = `scale(1.2)`;
    });

    planet.addEventListener('mouseout', () => {
        planet.style.transform = `scale(1)`;
    });
});
</script>

</body>
</html>