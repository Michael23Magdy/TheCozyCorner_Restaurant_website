<?php include('components/sidebar_header.php') ?>

    <main>
        <h2> <i class="fa-solid fa-database"></i> Dashboard Summary</h2>
        <br>
        <div class="database">
            <div class="summary-cards">
                <div class="card-summary">
                    <?php 
                        $sql = "SELECT SUM(total_price) as total FROM orders WHERE status='Done'";
                        $res = mysqli_query($conn, $sql);
                        $sum = mysqli_fetch_assoc($res);
                    ?>
                    <p class="statistic">$<?php echo $sum['total']?> </p>
                    <p class="statistic-name">total revenue</p>
                </div>
                <div class="card-summary">
                    <?php 
                        $sql = "SELECT COUNT(order_id) as cnt FROM orders WHERE status!='Cancel'";
                        $res = mysqli_query($conn, $sql);
                        $cnt = mysqli_fetch_assoc($res);
                    ?>
                    <p class="statistic"><?php echo $cnt['cnt']?></p>
                    <p class="statistic-name">orders</p>
                </div>
                <div class="card-summary">
                    <?php 
                        $sql = "SELECT COUNT(user_id) as cnt FROM users WHERE role='user'";
                        $res = mysqli_query($conn, $sql);
                        $cnt = mysqli_fetch_assoc($res);
                    ?>
                    <p class="statistic"><?php echo $cnt['cnt']?></p>
                    <p class="statistic-name">customers</p>
                </div>
                <div class="card-summary">
                    <?php 
                        $sql = "SELECT COUNT(id) as cnt FROM foods WHERE active=1";
                        $res = mysqli_query($conn, $sql);
                        $cnt = mysqli_fetch_assoc($res);
                    ?>
                    <p class="statistic"><?php echo $cnt['cnt']?></p>
                    <p class="statistic-name">meals on menu</p>
                </div>
            </div>
        </div>
    </main>

<?php include('components/footer.php') ?>