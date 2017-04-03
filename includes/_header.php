    <?php require_once 'config/init.php'; ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--[if IE]>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <meta name="description" content="#">
        <meta name="author" content="Joanne Kennedy">

        <title>PH Company</title>
        <link rel="stylesheet" type="text/css" href="assets/css/inline.min.css">
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/c3/c3.css" rel="stylesheet" type="text/css">

        <!-- Custom styles for this template -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,600,800' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/style.min.css" rel="stylesheet">
        <link href="assets/css/responsive.min.css" rel="stylesheet">
        <link href="assets/css/signin.min.css" rel="stylesheet">
        <link href="assets/css/stylish-portfolio.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Cinzel+Decorative' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Antic+Didone' rel='stylesheet' type='text/css'>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body id="top">

        <!-- begin:navbar -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-top">
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <?php
                            $user = new User();
                            if ($user->isLoggedIn()) {
                                ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span
                                    class="glyphicon glyphicon-user"></span>
                                    Hello <?php echo escape($user->data()->username); ?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                      <li>
                                          <a href="index.php">Home</a>
                                      </li>
                                        <li>
                                            <a href="profile.php?user=<?php echo escape($user->data()->username); ?>">My Profile</a>
                                        </li>
                                        <li>
                                            <a href="logout.php">Log out</a>
                                        </li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation" class="dropdown-header">Mange Account</li>
                                        <li>
                                            <a href="update.php">Update Details</a>
                                        </li>
                                        <?php
                                        if($user->hasPermission('admin')){
                                        ?>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation" class="dropdown-header">Admin Panel</li>
                                        <li>
                                            <a href="manageusers.php">Manage Users</a>
                                        </li>
                                        <li>
                                            <a href="managedata.php">Manage Data</a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation" class="dropdown-header">Manage Property</li>
                                        <?php
                                        if($user->hasPermission('DCC')){
                                        ?>
                                            <li>
                                                <a href="DCC.php">Reports</a>
                                            </li>
                                        <?php
                                        }
                                        else if ($user->hasPermission('admin')){
                                        ?>
                                        <li>
                                            <a href="ALL.php">Reports</a>
                                        </li>
                                        <?php
                                         }
                                         ?>
                                        </ul>
                                    </li>
                                    <?php
                                }
                            else {
                                ?>
                                <li><a href="login.php">Login</a></li>
                                <?php
                            }
                            ?>

                        </ul>

                        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

                        <script src="assets/js/custom.min.js"></script>

                        <script src="assets/c3/d3.v3.min.js"></script>

                        <script src="assets/c3/c3.min.js"></script>


                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>
            <!-- end:navbar -->
