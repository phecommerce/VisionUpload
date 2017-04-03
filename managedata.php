<?php require_once 'includes/_header.php'; ?>

<!-- Header -->
<!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
              <a href="https://www.phcompany.com/">
                 <img src="https://d2gtglxhqmkzi.cloudfront.net/s3fs-public/logo-white.png" alt="Logo" style="width:304px;height:120px;">
              </a>
            </div>
        </div>
    </header>

<body>

     <!-- About -->
     <section id="about" class="about">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12 text-center">
                     <h2>What gets measured, gets managed - Peter Drucker</h2>
                     <p class="lead">He uses statistics as a drunken man uses lamp posts, for support rather than for illumination - Andrew Lang</p>
                 </div>
             </div>
             <!-- /.row -->
         </div>
         <!-- /.container -->
     </section>

     <!-- Services -->
     <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
     <section id="services" class="services bg-primary">
         <div class="container">
             <div class="row text-center">
                 <div class="col-lg-10 col-lg-offset-1">
                     <h2>Run Scripts</h2>
                     <hr class="small">
                     <div class="row">
                         <div class="col-md-3 col-sm-6">
                             <div class="service-item">
                                 <a href="searchvalues.php"><span class="fa-stack fa-4x">
                                 <i class="fa fa-circle fa-stack-2x"></i>
                                 <i class="fa fa-code fa-stack-1x text-primary"></i>
                             </span></a>
                                 <h4>
                                     <p class="lead">Search Values</p>
                                 </h4>
                             </div>
                         </div>
                         <div class="col-md-3 col-sm-6">
                             <div class="service-item">
                                 <a href="webtraffic.php"><span class="fa-stack fa-4x">
                                 <i class="fa fa-circle fa-stack-2x"></i>
                                 <i class="fa fa-code fa-stack-1x text-primary"></i>
                             </span></a>
                                 <h4>
                                     <p class="lead">Web Traffic</p>
                                 </h4>
                             </div>
                         </div>
                         <div class="col-md-3 col-sm-6">
                             <div class="service-item">
                                 <a href="transactions.php"><span class="fa-stack fa-4x">
                                 <i class="fa fa-circle fa-stack-2x"></i>
                                 <i class="fa fa-code fa-stack-1x text-primary"></i>
                             </span></a>
                                 <h4>
                                     <p class="lead">Web Transactions</p>
                                 </h4>
                             </div>
                         </div>
                         <div class="col-md-3 col-sm-6">
                             <div class="service-item">
                                 <a href="strvalues.php"><span class="fa-stack fa-4x">
                                 <i class="fa fa-circle fa-stack-2x"></i>
                                 <i class="fa fa-code fa-stack-1x text-primary"></i>
                             </span></a>
                                 <h4>
                                     <p class="lead">STR Values</p>
                                 </h4>
                             </div>
                         </div>
                     </div>
                     <!-- /.row (nested) -->
                 </div>
                 <!-- /.col-lg-10 -->
             </div>
             <!-- /.row -->

             <div class="row text-center">
                 <div class="col-lg-10 col-lg-offset-1">
                     <h2>Import CSV</h2>
                     <hr class="small">
                     <div class="row">
                         <div class="col-md-4 col-sm-6">
                             <div class="service-item">
                                 <a href="http://www.phcompany.report/phpmyadmin/index.php?db=bookingdata&table=travel_agents&target=sql.php&token=c2364529d70cca1da512dc9683b69093#PMAURL-1:tbl_import.php?db=bookingdata&table=reservations&server=1&target=&token=c2364529d70cca1da512dc9683b69093">
                               <span class="fa-stack fa-4x">
                                 <i class="fa fa-circle fa-stack-2x"></i>
                                 <i class="fa fa-file-code-o fa-stack-1x text-primary"></i>
                               </span></a>
                                 <h4>
                                     <p class="lead">Reservations</p>
                                 </h4>
                             </div>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <div class="service-item">
                                 <a href="http://www.phcompany.report/phpmyadmin/tbl_import.php?db=bookingdata&table=reservations&server=1&target=&token=c2364529d70cca1da512dc9683b69093#PMAURL-5:tbl_import.php?db=bookingdata&table=res_stats&server=1&target=&token=c2364529d70cca1da512dc9683b69093">
                               <span class="fa-stack fa-4x">
                                 <i class="fa fa-circle fa-stack-2x"></i>
                                 <i class="fa fa-file-code-o fa-stack-1x text-primary"></i>
                               </span></a>
                                 <h4>
                                     <p class="lead">Reservation Stats</p>
                                 </h4>
                             </div>
                         </div>
                         <div class="col-md-4 col-sm-6">
                             <div class="service-item">
                                 <a href="http://www.phcompany.report/phpmyadmin/tbl_import.php?db=bookingdata&table=reservations&server=1&target=&token=c2364529d70cca1da512dc9683b69093#PMAURL-7:tbl_import.php?db=bookingdata&table=res_forecast&server=1&target=&token=c2364529d70cca1da512dc9683b69093">
                               <span class="fa-stack fa-4x">
                                 <i class="fa fa-circle fa-stack-2x"></i>
                                 <i class="fa fa-file-code-o fa-stack-1x text-primary"></i>
                               </span></a>
                                 <h4>
                                     <p class="lead">Reservation Forecast</p>
                                 </h4>
                             </div>
                         </div>
                     </div>
                     <!-- /.row (nested) -->
                 </div>
                 <!-- /.col-lg-10 -->
             </div>
             <!-- /.row -->
         </div>
         <!-- /.container -->
     </section>


<?php include "includes/_footer.php"; ?>
