<?php
include 'partials-front/header.php'
?>
    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not Available.</div>";
                            } else {
                                ?>
                                <img src="<?= SITEURL ?>images/foods/<?= $image_name ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="food-menu-desc">
                            <h4><?= $title; ?></h4>
                            <p class="food-price">$<?= $price; ?></p>
                            <p class="food-detail"><?= $description ?></p>
                            <br>
                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Food Menu Section Ends Here -->

<?php
include 'partials-front/footer.php';
?>