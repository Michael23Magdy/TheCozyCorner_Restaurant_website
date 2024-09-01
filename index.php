<?php include('config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Cozy Corner : Home Page</title>
    <link rel="icon" href="images/logo.png" type="image/png">

    <!-- Render all elements normally -->
    <link rel="stylesheet" href="css/normalize.css">

    <!-- main styling -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="welcome">
        <header>
            <div class="container">
                <div class="brand">
                    <img src="images/logo.png" alt="LOGO" class="logo">
                    <h1 class="websit_name">THE COZY<br>CORNER</h1>
                </div>
                <ul class="navigation">
                    <li><a href="" class="set"> Food Menu </a></li>
                    <li><a href="" class="set"> Categories</a></li>
                    <li><a href="#about-us" class="set"> About US</a></li>
                </ul>
                <div class="icons">
                    <a href=""><i class="fa-solid fa-search" onclick=""></i></a>
                    <a href=""><i class="fa-solid fa-utensils"></i></a>
                    <a href=""><i class="fa-solid fa-circle-user"></i></a>
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <div>
                    <p>Modern Mediterranean Restaurant</p>
                    <h1>
                        Delicious Moments <br>
                        Are Waiting for You
                    </h1>
                    <div class="call-for-action">
                        <a href=""> Order Now</a>
                        <a href=""> Learn More</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="featured">
        <div class="container">
            <h2> Featured Meals </h2>
            <div class="cards food-cards">
                
                <div class="food-card card">
                    <h3>title</h3>
                    <div class="details">
                        <p class="price">$30.30</p>
                        <p class="des">description</p>
                        <div>
                            <a href="">Order now</a>
                            <a href="">Add to Order</a>
                        </div>
                    </div>
                </div>
                <div class="food-card card">
                    <h3>title</h3>
                    <div class="details">
                        <p class="price">$30.30</p>
                        <p class="des">description</p>
                        <div>
                            <a href="">Order now</a>
                            <a href="">Add to Order</a>
                        </div>
                    </div>
                </div>
                <div class="food-card card">
                    <h3>title</h3>
                    <div class="details">
                        <p class="price">$30.30</p>
                        <p class="des">description</p>
                        <div>
                            <a href="">Order now</a>
                            <a href="">Add to Order</a>
                        </div>
                    </div>
                </div>
                <div class="food-card card">
                    <h3>title</h3>
                    <div class="details">
                        <p class="price">$30.30</p>
                        <p class="des">description</p>
                        <div>
                            <a href="">Order now</a>
                            <a href="">Add to Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="qoute-section">
        <div class="container">
            <div>
                <p class="qoute">"search you favourite food"</p>
                <form action="" method="">
                    <input type="search" name="" id="">
                    <input type="submit" value="search" class="set"> 
                </form>
            </div>
            <img class="side-img" src="images/chef_3.png" alt="chef">
        </div>
    </section>

    <section class="featured">
        <div class="container">
            <h2> Featured Categories </h2>
            <div class="cards category-cards">
                <div class="category-card card">
                    <h3>title</h3>
                    <a href="">
                        <div class="details">
                            <p class="des">description</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="qoute-section">
        <div class="container">
            <p class="qoute">"Good Food, Good Mood:<br>
            Every Bite Tells a Story."</p>
            <img class="side-img" src="images/chef.png" alt="chef">
        </div>
    </section>

    <section id="about-us">
        <div class="container">
            <h2>About Us</h2>
            <p>Founded in 2010, The Cozy Corner started as a small family-owned restaurant with a big dream: to bring comfort and joy through delicious food. Over the years, we've grown, but our mission remains the same. Our dedication to quality ingredients and exceptional service has made us a beloved destination for both locals and visitors alike. From our humble beginnings to now, every dish we serve tells the story of our passion and commitment.</p>
        
            <h3>Contact Us</h3>
            <p>Got questions? We'd love to hear from you!</p>
            <ul class="contact-info">
                <li><strong>Phone:</strong> (123) 456-7890</li>
                <li><strong>Email:</strong> info@thecozycorner.com</li>
                <li><strong>Address:</strong> 123 Cozy Street, Food Town, FL</li>
            </ul>
            <!-- <img src="images/chef_2.png" alt="About Us Image"> -->
        </div>
    </section>
    
    
    
    <footer>
        <p>
            &copy all rights reserved to <span>The Cozy Corner</span>. 
            developed by <span>Michael Magdy</span>.
        </p>
    </footer>
</body>
</html>