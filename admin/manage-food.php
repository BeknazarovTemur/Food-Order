<?php

include "partials/header.php";

?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /><br /> <br />

        <!--Button to Add Food-->
        <a href="<?= SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

        <br /> <br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['no-food-found'])) {
            echo $_SESSION['no-food-found'];
            unset($_SESSION['no-food-found']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['failed_remove'])) {
            echo $_SESSION['failed_remove'];
            unset($_SESSION['failed_remove']);
        }

        ?>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php

            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?= $sn++ ?></td>
                        <td><?= $title ?></td>
                        <td>$<?= $price ?></td>
                        <td>
                            <?php
                            if ($image_name != "") {
                                ?>
                                <img src="<?= SITEURL; ?>images/foods/<?= $image_name; ?>" width="100px">
                                <?php
                            } else {
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            ?>
                        </td>
                        <td><?= $featured ?></td>
                        <td><?= $active ?></td>
                        <td>
                            <a href="<?= SITEURL; ?>admin/update-food.php?id=<?= $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?= SITEURL; ?>admin/delete-food.php?id=<?= $id; ?>&image_name=<?= $image_name; ?>" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7' class='error'>Food not Added yet!</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->
<?php
include "partials/footer.php";
?>
