<?php require_once "includes/_header.php" ?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
  $(function() {
    $("#dialog").dialog();
  });
  </script>

<?php
if(Input::exists()){
   if(Token::check(Input::get('token'))){
       $validate = new Validate();
       $validation = $validate->check(array(
           'username' => array('required' => true),
           'password' => array('required' => true)
        ));

    if ($validation->passed()){
        $user = new User();

        $remember = (Input::get('remember') === 'on') ? true : false;
        $login = $user->login(Input::get('username'), Input::get('password'), $remember);

        if ($login) {
            Redirect::to('index.php');
        } else {

        }

       } else {
            foreach($validation->errors() as $error) {
                echo '<br><br><br><div class="container"><div class="alert alert-danger text-center" role="alert">'.$error.'</div></div>';
            }
        }
   }
}
?>
<br>
<br>

 <form action="login.php" method="post"  class="form-signin" role="form">
        <h2 class="form-signin-heading">Login</h2>
        <input type="text" name="username" class="form-control" placeholder="Username" id="username" required autofocus>
		<input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
		<label class="checkbox">
        <input type="checkbox" name="remember" id="remember"> Remember Me
        </label>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <br>
<div class="row">
<a href="index.php"><i class="fa fa-arrow-left"></i> Back To Homepage</a>
</div>
      </form>

<?php include "includes/_footer.php" ?>
