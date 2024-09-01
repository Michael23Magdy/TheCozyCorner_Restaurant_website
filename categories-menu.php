<?php include('config/constants.php') ?>
<?php include('components/display-category.php') ?>
<?php include('components/meta-data.php') ?>

<body>
    <?php include('components/header.php') ?>
    <section class="featured">
        <div class="container">
            <h2> Featured Categories </h2>
            <div class="cards category-cards">
                <?php
                    display_category($conn, "active = 1", "not available");
                ?>
            </div>
        </div>
    </section>




    <?php include('components/search-section.php') ?>
    <?php include('components/footer.php') ?>
</body>