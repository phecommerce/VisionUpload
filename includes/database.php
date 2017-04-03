<?php

class Database
{
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "bookingdata";
  private $mysqli;

  public function __construct()
  {
    $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }
  }

  public function getHotelList()
  {
    $query = "SELECT ga_hotel_name, opera_id, ota_insight_id, brand, division FROM hotel_info WHERE status != 'Deactivated'";
    $result = $this->mysqli->query($query);

    $array = array();
    $i = 0;
    while($row = $result->fetch_assoc()) {
        $array[$i][] = $row["opera_id"];
        $array[$i][] = $row["ga_hotel_name"];
        $array[$i][] = $row['ota_insight_id'];
        $array[$i][] = $row['brand'];
        $array[$i][] = $row['division'];
        $i++;
    }
    return $array;
  }

  public function updateTrafficData($array)
  {
    foreach($array as $value) {
      $operaID = mysqli_escape_string($this->mysqli,$value[0]);
      $query = "SELECT opera_id from hotel_info WHERE opera_id = '$operaID'";
      $result = $this->mysqli->query($query);
      while($row = $result->fetch_assoc()) {
          $operaID = $row["opera_id"];
      }

      $date = $value[1];
      $hour = $value[2];
      $channel = mysqli_escape_string($this->mysqli,$value[3]);
      $device = mysqli_escape_string($this->mysqli,$value[4]);
      $sessions = $value[5];
      $users = $value[6];
      $newUsers = $value[7];
      $pageviews = $value[8];
      $bounces = $value[9];
      $transactions = $value[10];
      $quantity = $value[11];
      $revenue = $value[12];
      $weddingEnquiries = $value[13];
      $conferenceEnquiries = $value[14];
      $rateEnquiries = $value[15];
      $callGeneral = $value[16];
      $callConference = $value[17];
      $generalEnquiries = $value[18];

      //Query the database to see if the row already exists
      $query = "SELECT * FROM web_traffic WHERE opera_id = '$operaID' AND shopped_date = '$date' AND shopped_hour = '$hour'
      AND channel = '$channel' AND device = '$device' AND sessions = '$sessions'";

      $result = $this->mysqli->query($query);

      //Insert row if no matching row is found
      if ($result->num_rows == 0) {
        $query = "INSERT INTO web_traffic (opera_id, shopped_date, shopped_hour, channel, device, sessions, users, new_users, pageviews, bounces, transactions, quantity,
          total_revenue, wedding_enquiries, conference_enquiries, rate_enquiries, call_general, call_conference, general_enquiries)
        VALUES ('$operaID', '$date', '$hour', '$channel','$device','$sessions','$users','$newUsers','$pageviews','$bounces','$transactions','$quantity',
          '$revenue','$weddingEnquiries', '$conferenceEnquiries', '$rateEnquiries', '$callGeneral', '$callConference', '$generalEnquiries')";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();

        $trafficFilePath = "csv/google/traffic/";
        //Check to see if the folder exists
        if (is_dir($trafficFilePath)){
          //If folder exists, open the folder
          if ($dh = opendir($trafficFilePath)){
            //Looping through the files in the folder
            while (($filename = readdir($dh)) !== false){
              if ($filename != "." && $filename != "..") {
              //delete the file once uploaded
              $file = $trafficFilePath . $filename;
              unlink($file);
              }
            }
          }
        }
      }
    }
  }

  public function updateSearchData($array)
  {

    foreach($array as $value) {
      $operaID = mysqli_escape_string($this->mysqli,$value[0]);
      $query = "SELECT opera_id from hotel_info WHERE opera_id = '$operaID'";
      $result = $this->mysqli->query($query);
      while($row = $result->fetch_assoc()) {
          $operaID = $row["opera_id"];
      }

      $date = $value[1];
      $hourDay = $value[2];
      $device = mysqli_escape_string($this->mysqli,$value[3]);
      $channel = mysqli_escape_string($this->mysqli,$value[4]);
      $checkInDate = $value[5];
      $checkOutDate = $value[6];
      $noAdults = $value[7];
      $noChildren = $value[8];
      $noRooms = $value[9];
      $hits = $value[10];

      $query = "SELECT * FROM search_data WHERE shopped_date = '$date' AND shopped_hour = '$hourDay' AND device = '$device'
      AND channel = '$channel' AND opera_id = '$operaID' AND arrival_date = '$checkInDate' AND departure_date = '$checkOutDate'
      AND adults = '$noAdults' AND children = '$noChildren' AND rooms ='$noRooms'";
      $result = $this->mysqli->query($query);

      if ($result->num_rows == 0) {
        $query = "INSERT INTO search_data (opera_id, shopped_date, shopped_hour, device, channel, arrival_date, departure_date, adults, children, rooms, hits)
        VALUES ('$operaID','$date', '$hourDay', '$device', '$channel', '$checkInDate','$checkOutDate','$noAdults','$noChildren','$noRooms','$hits')";
        // $stmt = $this->mysqli->prepare($query);
        // $stmt->execute();
        $execute = $this->mysqli->query($query);

        $searchFilePath = "csv/google/search/";
        //Check to see if the folder exists
        if (is_dir($searchFilePath)){
          //If folder exists, open the folder
          if ($dh = opendir($searchFilePath)){
            //Looping through the files in the folder
            while (($filename = readdir($dh)) !== false){
              if ($filename != "." && $filename != "..") {
              //delete the file once uploaded
              $file = $searchFilePath . $filename;
              unlink($file);
              }
            }
          }
        }
      }
    }
  }

  public function updateStrData($array, $date)
  {
    $todayDate = $date;
    foreach($array as $value) {
      $censusId = $value[0];
      $hotelName = mysqli_escape_string($this->mysqli,$value[1]);

      if ($hotelName == "The Principal Edinburgh George Street") {
        $hotelName = "The Principal Edinburgh George...";
      } else {
        $hotelName = $hotelName;
      }

      $query = "SELECT opera_id from hotel_info WHERE ga_hotel_name = '$hotelName'";
      $result = $this->mysqli->query($query);
      while($row = $result->fetch_assoc()) {
          $operaId = $row["opera_id"];
      }

      $currentHotelSupply = $value[2];
      $currentHotelDemand = $value[3];
      $currentHotelRevenue = $value[4];
      $currentHotelOccupancy = $value[5];
      $currentHotelAdr = $value[6];
      $currentHotelRevPar = $value[7];
      $currentCompsetSupply = $value[8];
      $currentCompsetDemand = $value[9];
      $currentCompsetRevenue = $value[10];
      $currentCompsetOccupancy = $value[11];
      $currentCompsetAdr = $value[12];
      $currentCompsetRevPar = $value[13];
      $currentIndexOccupancy = $value[14];
      $currentIndexAdr = $value[15];
      $currentIndexRevPar = $value[16];
      $currentRankOccupancy = mysqli_escape_string($this->mysqli,$value[17]);
      $currentRankAdr = mysqli_escape_string($this->mysqli,$value[18]);
      $currentRankRevPar = mysqli_escape_string($this->mysqli,$value[19]);
      $previousHotelSupply = $value[20];
      $previousHotelDemand = $value[21];
      $previousHotelRevenue = $value[22];
      $previousHotelOccupancy = $value[23];
      $previousHotelAdr = $value[24];
      $previousHotelRevPar = $value[25];
      $previousCompsetSupply = $value[26];
      $previousCompsetDemand = $value[27];
      $previousCompsetRevenue = $value[28];
      $previousCompsetOccupancy = $value[29];
      $previousCompsetAdr = $value[30];
      $previousCompsetRevPar = $value[31];
      $previousIndexOccupancy = $value[32];
      $previousIndexAdr = $value[33];
      $previousIndexRevPar = $value[34];
      $previousRankOccupancy = mysqli_escape_string($this->mysqli,$value[35]);
      $previousRankAdr = mysqli_escape_string($this->mysqli,$value[36]);
      $previousRankRevPar = mysqli_escape_string($this->mysqli,$value[37]);
      $hotelChangeSupply = $value[38];
      $hotelChangeDemand = $value[39];
      $hotelChangeRevenue = $value[40];
      $hotelChangeOccupancy = $value[41];
      $hotelChangeAdr = $value[42];
      $hotelChangeRevPar = $value[43];
      $compsetChangeSupply = $value[44];
      $compsetChangeDemand = $value[45];
      $compsetChangeRevenue = $value[46];
      $compsetChangeOccupancy = $value[47];
      $compsetChangeAdr = $value[48];
      $compsetChangeRevPar = $value[49];
      $indexChangeOccupancy = $value[50];
      $indexChangeAdr = $value[51];
      $indexChangeRevPar = $value[52];
      $rankChangeOccupancy = mysqli_escape_string($this->mysqli,$value[53]);
      $rankChangeAdr = mysqli_escape_string($this->mysqli,$value[54]);
      $rankChangeRevPar = mysqli_escape_string($this->mysqli,$value[55]);

      $query = "SELECT * FROM str_data WHERE census_id = '$censusId' AND opera_id = '$operaId' AND hotel_name = '$hotelName' AND date = '$todayDate'";
      $result = $this->mysqli->query($query);

      if ($result->num_rows == 0) {
        $query = "INSERT INTO str_data (date, census_id, opera_id, hotel_name, current_hotel_supply, current_hotel_demand, current_hotel_revenue, current_hotel_occupancy,
                   current_hotel_adr, current_hotel_rev_par, current_compset_supply, current_compset_demand, current_compset_revenue, current_compset_occupancy,
                   current_compset_adr, current_compset_rev_par, current_index_occupancy, current_index_adr, current_index_rev_par, current_rank_occupancy,
                   current_rank_adr, current_rank_rev_par, previous_hotel_supply, previous_hotel_demand, previous_hotel_revenue, previous_hotel_occupancy,
                   previous_hotel_adr, previous_hotel_rev_par, previous_compset_supply, previous_compset_demand, previous_compset_revenue, previous_compset_occupancy,
                   previous_compset_adr, previous_compset_rev_par, previous_index_occupancy, previous_index_adr, previous_index_rev_par, previous_rank_occupancy,
                   previous_rank_adr, previous_rank_rev_par, hotel_change_supply, hotel_change_demand, hotel_change_revenue, hotel_change_occupancy, hotel_change_adr,
                   hotel_change_rev_par, compset_change_supply, compset_change_demand, compset_change_revenue, compset_change_occupancy, compset_change_adr,
                   compset_change_rev_par, index_change_occupancy, index_change_adr, index_change_rev_par, rank_change_occupancy, rank_change_adr, rank_change_rev_par)
                   VALUES ('$todayDate', '$censusId', '$operaId' ,'$hotelName', '$currentHotelSupply','$currentHotelDemand','$currentHotelRevenue','$currentHotelOccupancy','$currentHotelAdr',
                   '$currentHotelRevPar','$currentCompsetSupply', '$currentCompsetDemand', '$currentCompsetRevenue', '$currentCompsetOccupancy', '$currentCompsetAdr',
                   '$currentCompsetRevPar', '$currentIndexOccupancy', '$currentIndexAdr', '$currentIndexRevPar', '$currentRankOccupancy', '$currentRankAdr',
                   '$currentRankRevPar', '$previousHotelSupply', '$previousHotelDemand', '$previousHotelRevenue', '$previousHotelOccupancy', '$previousHotelAdr',
               '$previousHotelRevPar', '$previousCompsetSupply', '$previousCompsetDemand', '$previousCompsetRevenue', '$previousCompsetOccupancy',
               '$previousCompsetAdr', '$previousCompsetRevPar', '$previousIndexOccupancy', '$previousIndexAdr', '$previousIndexRevPar', '$previousRankOccupancy',
               '$previousRankAdr', '$previousRankRevPar', '$hotelChangeSupply', '$hotelChangeDemand', '$hotelChangeRevenue', '$hotelChangeOccupancy',
               '$hotelChangeAdr', '$hotelChangeRevPar', '$compsetChangeSupply', '$compsetChangeDemand', '$compsetChangeRevenue', '$compsetChangeOccupancy',
               '$compsetChangeAdr', '$compsetChangeRevPar', '$indexChangeOccupancy', '$indexChangeAdr', '$indexChangeRevPar', '$rankChangeOccupancy',
               '$rankChangeAdr', '$rankChangeRevPar')";
        $stmt = $this->mysqli->prepare($query);
        $stmt->execute();
      }
    }
  }

  public function updateOTAData($array)
  {
    date_default_timezone_set('Europe/London');
    $token = "3NsDxn0dyTvBaGvxVWIc";

    $values = array();
    $i = 0;
    foreach($array as $value)
    {
      $operaID = $value[0];
      $otaInsightID = $value[2];
      $i++;

      for ($i=0;$i<count($otaInsightID);$i++) {
        if ($otaInsightID[$i] == "0") {
          null;
        } else {
          $response = file_get_contents('https://login.otainsight.com/apiv1/external/?token='.$token.'&hotelId='.$otaInsightID.'&ota=bookingdotcom&persons=2');
          $decoded = gzdecode($response);
          $lines = explode(PHP_EOL, $decoded);
          $array = array();

          foreach ($lines as $line)
          {
            $array[] = str_getcsv($line);
          }

          $z = 1;

          while ($z < count($array)-1) {
            $hotel_id = $array[$z][0];
            $hotel_name = mysqli_escape_string($this->mysqli,$array[$z][1]);
            $shopped_timedate = strtotime($array[$z][2]);
            $shopped_date = substr($array[$z][2],0,10);
            $shopped_time = substr($array[$z][2],11,8);
            $arrival_date = $array[$z][3];
            $demand = $array[$z][4];
            if($demand == "")
            {
              $demand = 0;
            }
            $source = "OTA Insight";
            $rate = $array[$z][5];
            $z++;

            // check to see if row exists
            $query = "SELECT * FROM benchmark WHERE opera_id = '$operaID' AND ota_insight_id = '$hotel_id' AND shopped_date = '$shopped_date' AND shopped_time = '$shopped_time' AND arrival_date = '$arrival_date' AND hotel_name = '$hotel_name' AND demand = '$demand' AND source = '$source' AND sell_rate = '$rate'";

            $result = $this->mysqli->query($query);

            if ($result->num_rows == 0)
            {
              $query = "INSERT INTO benchmark (opera_id, ota_insight_id, shopped_date, shopped_time, arrival_date,
                hotel_name, demand, source, sell_rate) VALUES ('$operaID', '$hotel_id', '$shopped_date', '$shopped_time', '$arrival_date',
                  '$hotel_name', '$demand', '$source', '$rate')";
                  $stmt = $this->mysqli->prepare($query);
                  $stmt->execute();
                }
              }
            }
          }
        }
      }


      public function updateTransactionData($array)
      {

        foreach($array as $value) {
          $operaID = mysqli_escape_string($this->mysqli,$value[0]);
          $query = "SELECT opera_id from hotel_info WHERE opera_id = '$operaID'";
          $result = $this->mysqli->query($query);
          while($row = $result->fetch_assoc()) {
              $operaID = $row["opera_id"];
          }

          $transactionDate = $value[1];
          $hour = $value[2];
          $stt = $value[3];
          $confirmation_id = mysqli_escape_string($this->mysqli,$value[4]);
          $channel = mysqli_escape_string($this->mysqli,$value[5]);
          $device = mysqli_escape_string($this->mysqli,$value[6]);
          $transactions = $value[7];
          $totalRevenue = $value[8];

          //Query the database to see if the row already exists
          $query = "SELECT * FROM web_transactions WHERE opera_id = '$operaID' AND booked_date = '$transactionDate' AND booked_hour = '$hour'
          AND channel = '$channel' AND device = '$device' AND transactions = '$transactions' AND confirmation_id = '$confirmation_id'";
          $result = $this->mysqli->query($query);

          //Insert row if no matching row is found
          if ($result->num_rows == 0) {
            $query = "INSERT INTO web_transactions (opera_id, booked_date, booked_hour, stt, confirmation_id, channel, device, transactions, total_revenue)
            VALUES ('$operaID', '$transactionDate', '$hour', '$stt','$confirmation_id','$channel','$device','$transactions','$totalRevenue')";
            $stmt = $this->mysqli->prepare($query);
            $stmt->execute();

            $transactionFilePath = "csv/google/transaction/";
            //Check to see if the folder exists
            if (is_dir($transactionFilePath)){
              //If folder exists, open the folderphp
              if ($dh = opendir($transactionFilePath)){
                //Looping through the files in the folder
                while (($filename = readdir($dh)) !== false){
                  if ($filename != "." && $filename != "..") {
                  //delete the file once uploaded
                  $file = $transactionFilePath . $filename;
                  unlink($file);
                  }
                }
              }
            }
          }
        }
      }


  public function __destroy()
  {
    $closeConnection = $this->mysqli->close();

    if($closeConnection === false)
    {
      echo "could not close connection";
    }
  }
}

?>
