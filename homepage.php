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

        <!-- Search Form -->
        <form action="search.php" method="get" class="search-form">
            <input type="text" name="keyword" placeholder="Search blogs..." required>
            <button type="submit">Search</button>
        </form>
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

<style>
/* Style the search bar */
.search-form {
    display: inline-block;
    margin-left: 20px;
}

.search-form input {
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.search-form button {
    padding: 5px 10px;
    border: none;
    background-color: #00ffcc;
    color: #000;
    cursor: pointer;
    border-radius: 5px;
}

.search-form button:hover {
    background-color: #00cc99;
}
</style>

</body>
</html>
