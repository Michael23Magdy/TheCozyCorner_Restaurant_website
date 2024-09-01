<header>
    <div class="container">
        <div class="brand">
            <img src="images/logo.png" alt="LOGO" class="logo">
            <h1 class="websit_name">THE COZY<br>CORNER</h1>
        </div>
        <ul class="navigation">
            <li><a href="" class="set"> Home </a></li>
            <li><a href="" class="set"> Food Menu </a></li>
            <li><a href="" class="set"> Categories</a></li>
        </ul>
        <div class="icons">
            <a href="#search-section"><i class="fa-solid fa-search"></i><span> Search</span></a>
            <a href=""><i class="fa-solid fa-utensils"></i><span> Order Box</span></a>
            <?php
                if(isset($_SESSION['username'])){
                    echo "<a href=\"logout.php\"><i class=\"fa-solid fa-right-from-bracket\"></i><span> Log out</span></a>";
                } else {
                    echo "<a href=\"login.php\"><i class=\"fa-solid fa-right-to-bracket\"></i><span> Log in</span></a>";
                }
            ?>
        </div>
    </div>
</header>