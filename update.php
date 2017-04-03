<?php include "includes/_header.php" ?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
  $(function() {
    $("#dialog").dialog();
  });
  </script>

<?php
$user = new User();
if (!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array (
                'required' => true,
                'min' => 2,
                'max' =>50
                ),
            'username' => array (
                'required' => true,
                'min' => 2,
                'max' =>20
                ),
            'email' => array (
                'required' => true,
                'min' => 2,
                'max' => 50
                )

        ));

        if($validation->passed()){


            try {
                $user->update(array(
                    'name' =>Input::get('name'),
                    'username' =>Input::get('username'),
                    'email' =>Input::get('email'),
                ));

            Redirect::to('index.php');

            } catch(Exception $e) {
                die ($e->getMessage());
            }

        } else {
            foreach ($validation->errors() as $error) {
                echo '<br><br><br><div class="container"><div class="alert alert-danger text-center" role="alert">' . $error . '</div></div>';
            }
        }
    }
}

?>

<br>
<br>
<br>
<br>

<form action="update.php" method="post" class="form-signin" role="form" enctype="multipart/form-data">
<h2 class="form-signin-heading">Update Details</h2>

<input type="text" name="name" class="form-control" placeholder="Full Name" value="<?php echo escape($user->data()->name); ?>"> <br>

<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo escape($user->data()->username); ?>"><br>

<input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo escape($user->data()->email); ?>"><br>


<br>

<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
<button class="btn btn-lg btn-primary btn-block" type="submit" value="Update">Update</button>

<br>
<a href="index.php"><i class="fa fa-arrow-left"></i> Back To Homepage</a>

</form>





<?php include "includes/_footer.php" ?>
