<?php
include "includes/_header.php";
include "includes/database.php";
include "includes/otadata.php";
?>

<body>
  <!-- Header -->
      <header>
          <div class="container">
              <div class="intro-text">
                <a href="https://www.phcompany.com/">
                   <img src="https://d2gtglxhqmkzi.cloudfront.net/s3fs-public/logo-white.png" alt="Logo" style="width:304px;height:120px;">
                </a>
                <br>
                 <br>
                   <br>
                    <br>
                   <br>
                 <br>
               <br>
               <a href="managedata.php" class="btn btn-dark btn-lg">Back</a>
              </div>
          </div>
      </header>


<?php
//Instantiate database class
$db = new Database();

//Get active hotel list from the database
$getHotelList = $db->getHotelList();

// Get and Update OTA Values
$updateOtaValues = $db->updateOTAData($getHotelList);

//Close Database;
$db->__destroy();

include "includes/_footer.php"

?>
