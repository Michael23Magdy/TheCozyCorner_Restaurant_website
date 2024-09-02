<?php include('config/constants.php') ?>
<?php include('components/display-food.php') ?>
<?php include('components/meta-data.php') ?>

<body>
    <?php include('components/header.php') ?>
    <?php
        function sanitize_input($data) {
            return htmlspecialchars(trim($data));
        }
        $category_id = isset($_GET['category'])? " AND category_id = {$_GET['category']} ":"";
        // $category_id = sanitize_input($category_id);
        $search = isset($_GET['search'])? " AND ( name LIKE \"%{$_GET['search']}%\" OR description LIKE \"%{$_GET['search']}%\") ":""; 
        // $search = sanitize_input($search);
    ?>
    <section class="featured">
        <div class="container">
            <?php
                if(isset($_GET['category_name'])) {
                    echo "<h2>{$_GET['category_name']}</h2>";
                } elseif(isset($_GET['search'])) {
                    echo "<h2>your search on {$_GET['search']}</h2>";
                } else {
                    echo "<h2> food menu </h2>";
                }
            ?>
            
            <div class="cards food-cards">
                <?php 
                    display_food($conn, "active = 1".$category_id.$search, "not available");
                ?>
            </div>
        </div>
    </section>




    <?php include('components/search-section.php') ?>
    <?php include('components/footer.php') ?>
</body>