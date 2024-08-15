<?php
include "partials/header.php";
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1><br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
            $res2 = mysqli_query($conn, $sql2);

            $count = mysqli_num_rows($res2);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res2);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-food-found'] = "<div class='error'>Food Not Found.</div>";
                header('location:' .SITEURL.'admin/manage-food.php');
            }
        } else {
            header('location:' .SITEURL.'admin/manage-food.php');
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
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?= $description ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?= $price ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            ?>
                            <img src="<?= SITEURL; ?>images/foods/<?= $current_image; ?>" width="150px">
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
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    $ext = explode('.', $image_name);
                    $image_ext = end($ext);
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/foods/" . $image_name;
                    $upload = move_uploaded_file($src, $dst);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        die();
                    }
                    if ($current_image != "") {
                        $remove_path = "../images/foods/" . $current_image;
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            $_SESSION['failed_remove'] = "<div class='error'>Failed to Remove Image. </div>";
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            $sql3 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = '$price', 
                    image_name = '$image_name', 
                    featured = '$featured', 
                    active = '$active' 
                WHERE id = $id";

            $res3 = mysqli_query($conn, $sql3);
            if ($res3 == true) {
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                header('location:' .SITEURL.'admin/manage-food.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Category Not Found.</div>";
                header('location:' .SITEURL.'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>

<?php
include "partials/footer.php";
?>
