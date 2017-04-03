<?php include "includes/_header.php" ?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
  $(function() {
    $("#dialog").dialog();
  });
  </script>

<?php

if(!$username = Input::get('user')){
    Redirect::to('index.php');
    }
else {
    $user = new User($username);
    if (!$user->exists()){
        Redirect::to(404);
    } else {
        $data = $user->data();
    }
}

?>


<br>
<br>
<form action="profile.php" method="post" class="form-signin">
<h2 class="form-signin-heading">About Me</h2> <br>

<div class="col-md-12">
<div class="team-member">
<img src="assets/images/users/<?php echo escape($data->image);?>" class="img-responsive img-circle" alt="profile picture">
</div>
</div>

<h3>Name:</h3>
<input type="text" class="form-control" value="<?php echo escape($data->name);?>"> <br>
<h3>Username:</h3>
<input type="text" class="form-control" value="<?php echo escape($data->username);?>"> <br>
<h3>Email:</h3>
<input type="text" class="form-control" value="<?php echo escape($data->email);?>"> <br>
<h3>Status:</h3>
<input type="text" class="form-control" value="<?php if(escape($data->group) == 1){echo "User";} else if(escape($data->group) == 2){echo "Administrator";}else {echo "Property";}?>"> <br>

<br>
<a href="index.php"><i class="fa fa-arrow-left"></i> Back To Homepage</a>
</form>



<?php include "includes/_footer.php" ?>
