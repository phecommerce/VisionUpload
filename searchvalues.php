<?php
include "includes/_header.php";
include "includes/googledata.php";
include "includes/database.php";
?>

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

<br>

<div class="container">
<div class="row text-center">
<a href="managedata.php" class="btn btn-dark btn-lg">Back</a>
</div>
</div>


<?php
// Instantiate database class
$db = new Database();

// Instantiate google class
$googleData = new GoogleData;

// Get active hotel list from the database
$getHotelList = $db->getHotelList();

// Get Search values
$searchValues = $googleData->getSearchValues($getHotelList);

// Update Values into Database
$updateSearch = $db->updateSearchData($searchValues);

//Close Database;
$db->__destroy();

include "includes/_footer.php"

?>
