<?php
include "partials/header.php";
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1><br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);//Get all the Data
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                header('location:' .SITEURL.'admin/manage-category.php');
            }
        } else {
            header('location:' .SITEURL.'admin/manage-category.php');
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?= $title ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php
                            if ($current_image != "") {
                                ?>
                                <img src="<?= SITEURL; ?>images/category/<?= $current_image; ?>" width="150px">
                                <?php
                            } else {
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured=='Yes') {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured=='No') {echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active=='Yes') {echo "checked";} ?>  type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active=='No') {echo "checked";} ?>  type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?= $current_image; ?>">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php

        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //Updating New Image if Selected
            //Check whether the image is selected or not
            if (isset($_FILES['image']['name'])) {
                //Get the Image Details
                $image_name = $_FILES['image']['name'];
                //Check whether the image is available or not
                if ($image_name != "") {
                    //Image Available
                    //Upload the New Image
                    $ext = explode('.', $image_name);
                    $image_ext = end($ext);
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;
                    //Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        die();
                    }
                    //Remove the Current Image if available
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            $_SESSION['failed_remove'] = "<div class='error'>Failed to Remove Image. </div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            $sql2 = "UPDATE tbl_category SET title = '$title', image_name = '$image_name', featured = '$featured', active = '$active' WHERE id = $id";

            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                header('location:' .SITEURL.'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Category Not Found.</div>";
                header('location:' .SITEURL.'admin/manage-category.php');
            }
        }

        ?>
    </div>
</div>

<?php
include 'partials/footer.php';
?>
