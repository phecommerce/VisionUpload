<?php

class OTAData {


  public function getOTAValues($array)
  {
    date_default_timezone_set('Europe/London');
    $token = "3NsDxn0dyTvBaGvxVWIc";

    $values = array();
    $i = 0;
    foreach($array as $value)
    {
      $operaID = $value[0];
      $hotel_name = $value[1];
      $otaInsightID = $value[2];
      $i++;

      for ($i=0;$i<count($otaInsightID);$i++) { // this ensures no duplicates are entered
        if ($otaInsightID[$i] == "0") { // this ensures the column headings are not entered as data
          null;
        } else {
          if($otaInsightID != "") {
            $response = file_get_contents('https://login.otainsight.com/apiv1/external/?token='.$token.'&hotelId='.$otaInsightID.'&ota=bookingdotcom&persons=2');
            $decoded = gzdecode($response);
            $lines = explode(PHP_EOL, $decoded);
            $data = array();

            foreach ($lines as $line)
            {
              $data[] = str_getcsv($line);
            }
          }
        }
      }
    }
     echo '<pre>'; print_r($data); echo '</pre>';
    // return $values;
    // return $data;
  }



}
?>
