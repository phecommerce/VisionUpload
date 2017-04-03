<?php include "includes/_header.php";

//checks if user is logged
$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

?>
    <div class="container">
<br>
<br>
<br>
<br>
  <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Manage Users</h3>
            </div>
            <div class="panel-body">

                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#edit_playlist" id="home-tab" role="tab"
                                                                  data-toggle="tab"
                                                                  aria-controls="edit_playlist" aria-expanded="true">Edit User</a>
                        </li>
                        <li role="presentation"><a href="#remove_playlist" role="tab" id="profile-tab" data-toggle="tab"
                                                   aria-controls="profile" aria-expanded="false">Remove User</a></l>
                        </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="edit_playlist"
                             aria-labelledby="edit_playlist-tab">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center">Update User</h3>
                                </div>
                                <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <?php
                                        // include the head of the table
                                        include 'partials/user_table_head.php';
                                        //stores the query for processing
                                        $result = $db->query("SELECT * FROM users");
                                        //does the query and outputs the results in the function
                                        EditUsers($result); ?>
                                    </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        <div role="tabpanel" class="tab-pane fade " id="remove_playlist"
                             aria-labelledby="dropdown1-tab">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <?php
                                    // include the head of the table
                                    include 'partials/user_table_head.php';
                                    //stores the query for processing
                                    $result = $db->query("SELECT * FROM users");
                                    //does the query and outputs the results in the function
                                    displayUsers($result);
                                    ?>
                                </table>

                                <div id="msg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="index.php"><i class="fa fa-arrow-left"></i> Back To Homepage</a>
  <br>
    </div>
<?php include "includes/_footer.php" ?>
