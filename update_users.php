<?php include "includes/_header.php";

//checks if user is logged
$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

//obtain id from from the get method and query to select everything from the database
$parsed_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id= '$parsed_id'";
$result = $db->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
?>
    <div class="container">

        <?php
        validateAndUpdateUser($db, $parsed_id);
        ?>
        <br>
        <br>
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Update User <?php echo $row['id']; ?></h3>
            </div>
            <div class="panel-body">

                <form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xs-9">

                <?php
                // include the form so we are duplicating codes
                include 'partials/update_user_form.php'; ?>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">
                                    <button type="submit" class="btn btn-success" value="Update">Update</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
        <a href="manageusers.php"><i class="fa fa-arrow-left"></i> Back To Manage All Users</a>
        <br>
        <a href="index.php"><i class="fa fa-arrow-left"></i> Back To Homepage</a>
    </div>

<?php require 'includes/_footer.php'; ?>
