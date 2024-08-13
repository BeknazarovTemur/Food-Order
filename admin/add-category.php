<?php
include 'partials/header.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];

    //For Radio input, we need to check whether the button is selected or not
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "No";
    }

    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No";
    }

   /* //Check whether the image is selected or not and set the value for image name accordingly
    print_r($_FILES['image']);
    die();//Break the code here*/

    if (isset($_FILES['image']['name'])) {
        //To upload image we need image name, source path and destination path
        $image_name = $_FILES['image']['name'];
        //Upload Image only if image is selected
        if ($image_name != "") {
            //Auto Renaming our Image
            //Get the Extension of our image (jpg, png, gif, etc)
            $ext = explode('.', $image_name);
            $image_ext = end($ext);
            $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;
            //Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                header('location:' . SITEURL . 'admin/add-category.php');
                die();
            }
        }
    } else {
        $image_name = "";
    }

    $sql = "INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";
    $res = mysqli_query($conn, $sql);
    if ($res==true) {
        $_SESSION['add'] = "<div class='success'>Category Added Successfully!</div>";
        header('location:' .SITEURL. 'admin/manage-category.php');
    } else {
        $_SESSION['add'] = "<div class='error'>Category Not Added!</div>";
        header('location:' .SITEURL. 'admin/manage-category.php');
    }

}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1> <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">
                        <input type="radio" name="featured" value="No">
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">
                        <input type="radio" name="active" value="No">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>

</div>

<?php include 'partials/footer.php'; ?>
