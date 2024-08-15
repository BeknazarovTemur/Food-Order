<?php
include "partials/header.php";

?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /> <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['failed_remove'])) {
            echo $_SESSION['failed_remove'];
            unset($_SESSION['failed_remove']);
        }
        ?>
        <br /><br />
        <!--Button to Add Category-->
        <a href="<?= SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br /> <br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query to Get all Categories from Database
                $sql = "SELECT * FROM tbl_category";
            //Execute Query
                $res = mysqli_query($conn, $sql);
            //Cont Rows
                $count = mysqli_num_rows($res);
                $sn=1;
            //Check whether we have data in Database or not
                if ($count > 0) {
                //We have data in Database
                //Get the data and display
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
                        <tr>
                            <td><?= $sn++ ?>. </td>
                            <td><?= $title ?></td>
                            <td>
                                <?php
                                if ($image_name!="") {
                                    //Display the Image
                                    ?>
                                    <img src="<?= SITEURL; ?>images/category/<?= $image_name; ?>" width="100px">
                                    <?php
                                } else {
                                    //Display the Message
                                    echo "<div class='error'>Image not Added.</div>";
                                }
                                ?>
                            </td>
                            <td><?= $featured ?></td>
                            <td><?= $active ?></td>
                            <td>
                                <a href="<?= SITEURL; ?>admin/update-category.php?id=<?= $id; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?= SITEURL; ?>admin/delete-category.php?id=<?= $id; ?>&image_name=<?= $image_name; ?>" class="btn-danger">Delete Category</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                //We don't have data
                //We'll display the message inside table
                    ?>
                    <tr>
                            <td colspan="6" class="error">No Category Added.</td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->
<?php
include "partials/footer.php";
?>
