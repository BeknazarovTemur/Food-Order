<?php
include "partials/header.php";
?>


<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <br />
        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add']; //Displaying session message
                unset($_SESSION['add']); //Removing session message
            }
        ?>
        <br><br><br>

        <!--Button to Add Admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br /> <br /> <br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM tbl_admin";
                $res = mysqli_query($conn, $sql);

                if ($res==true) {
                    $count = mysqli_num_rows($res);
                    $sn=1; //Create variable and Assign the value
                    if ($count > 0) {
                        while($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            ?>

                            <tr>
                                <td><?= $sn++ ?> </td>
                                <td><?= $full_name ?></td>
                                <td><?= $username ?></td>
                                <td>
                                    <a href="#" class="btn-secondary">Update Admin</a>
                                    <a href="#" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {

                    }
                }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php
include "partials/footer.php";