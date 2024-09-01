<?php include('config/constants.php') ?>
<?php include('components/display-food.php') ?>
<?php include('components/display-category.php') ?>

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
        <?php include('components/header.php') ?>
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
                <?php 
                    display_food($conn, "featured = 1", "not available");
                ?>
            </div>
        </div>
    </section>

    <section class="qoute-section" id="search-section">
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
                <?php
                    display_category($conn, "featured = 1", "not available");
                ?>
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
    <?php include('components/footer.php') ?>
</body>
</html>