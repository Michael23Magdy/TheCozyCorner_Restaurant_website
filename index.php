<?php include('config/constants.php') ?>
<?php include('components/display-food.php') ?>
<?php include('components/display-category.php') ?>
<?php include('components/meta-data.php') ?>

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
                        <a href="<?php echo SITE_URL."food-menu.php"?>"> View Menu</a>
                        <a href="#about-us"> Learn More</a>
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

    <?php include('components/search-section.php') ?>

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