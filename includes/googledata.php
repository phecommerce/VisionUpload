<?php

class GoogleData
{

  private $trafficFilePath;
  private $searchFilePath;
  private $transactionFilePath;
  private $filePath;
  private $hotelName;

  public function __construct()
  {
    $this->filePath = "csv/google/";
    $this->trafficFilePath = "csv/google/traffic/";
    $this->searchFilePath = "csv/google/search/";
    $this->transactionFilePath = "csv/google/transaction/";
  }

  public function getTrafficValues($array)
  {
    $values = array();
    $i = 0;
    foreach($array as $value) {
      $operaID = $value[0];

      if (is_dir($this->trafficFilePath)){
        if ($dh = opendir($this->trafficFilePath)){
          while (($filename = readdir($dh)) !== false){
            if (strpos($filename, "Analytics PHCompany.com (Reporting) ") !== false) {
              $arr = explode("Analytics PHCompany.com (Reporting) ", $filename);
              $originFile = $arr[1];

              // if (strpos($originFile, $hotelName) !== false) {
                if (strpos($originFile, $operaID) !== false) {
                // $this->hotelName = $hotelName;
                $this->operaID = $operaID;
                $file = $this->trafficFilePath . $filename;
                $handle = fopen($file, 'r');
                while (!feof($handle)) {
                  $row = fgetcsv($handle, 1000, ",");
                  if(substr($row[0],0,2) == "20") {

                    //Convert the date
                    $year = substr($row[0],0,4);
                    $month = substr($row[0],4,2);
                    $day = substr($row[0],6,2);
                    $hour = substr($row[0],8,2);
                    $date = $year."-".$month."-".$day;

                    // $values[$i][] = $this->hotelName;
                    $values[$i][] = $this->operaID;
                    $values[$i][] = $date;
                    $values[$i][] = $hour;
                    $values[$i][] = $row[1];
                    $values[$i][] = $row[2];
                    $values[$i][] = intval(str_replace(",","",$row[3]));
                    $values[$i][] = intval(str_replace(",","",$row[4]));
                    $values[$i][] = intval(str_replace(",","",$row[5]));
                    $values[$i][] = intval(str_replace(",","",$row[6]));
                    $values[$i][] = intval(str_replace(",","",$row[7]));
                    $values[$i][] = intval(str_replace(",","",$row[8]));
                    $values[$i][] = intval(str_replace(",","",$row[9]));
                    $revenue = str_replace("£","",$row[10]);
                    $revenue = floatval(str_replace(",","",$revenue));
                    $values[$i][] = $revenue;
                    $values[$i][] = intval(str_replace(",","",$row[11]));
                    $values[$i][] = intval(str_replace(",","",$row[12]));
                    $values[$i][] = intval(str_replace(",","",$row[13]));
                    $values[$i][] = intval(str_replace(",","",$row[14]));
                    $values[$i][] = intval(str_replace(",","",$row[15]));
                    $values[$i][] = intval(str_replace(",","",$row[16]));
                    $i++;
                  }
                }
              }
            } else {
              null;
              //echo "Skipping: " .$filename . "<br/>";
            }
          }
        }
      }
    }
    return $values;
    fclose($handle);
    closedir($dh);
  }

  public function getSearchValues($array)
  {
    $values = array();
    $i = 0;

    foreach($array as $value) {
      $operaID = $value[0];

      //Check to see if the folder exists
      if (is_dir($this->searchFilePath)){
        //If folder exists, open the folder
        if ($dh = opendir($this->searchFilePath)){
          //Looping through the files in the folder
          while (($filename = readdir($dh)) !== false){
            //Check to see if the file name has the string "Demand Report"
            if (strpos($filename, $operaID . " Demand") !== false) {
              //Open the file and begin generating an array
              $this->operaID = $operaID;
              $file = $this->searchFilePath . $filename;
              $handle = fopen($file, 'r');
              while (!feof($handle)) {
                $row = fgetcsv($handle, 1000, ",");
                if(substr($row[0],0,1) == "2") {

                  //Convert search date to yyyy-mm-dd
                  $year = substr($row[0],0,4);
                  $month = substr($row[0],4,2);
                  $day = substr($row[0],6,2);
                  $hour = substr($row[0],8,2);
                  $searchDate = $year."-".$month."-".$day;

                  //Convert check in date to yyyy-mm-dd
                  $year = substr($row[3],6,4);
                  $month = substr($row[3],3,2);
                  $day = substr($row[3],0,2);
                  $checkInDate = $year."-".$month."-".$day;

                  //Convert check out date to yyyy-mm-dd
                  $year = substr($row[4],6,4);
                  $month = substr($row[4],3,2);
                  $day = substr($row[4],0,2);
                  $checkOutDate = $year."-".$month."-".$day;


                  $values[$i][] = $this->operaID;
                  $values[$i][] = $searchDate;
                  $values[$i][] = $hour;
                  $values[$i][] = $row[1];
                  $values[$i][] = $row[2];
                  $values[$i][] = $checkInDate;
                  $values[$i][] = $checkOutDate;
                  $values[$i][] = intval($row[5]);
                  $values[$i][] = intval($row[6]);
                  $values[$i][] = intval($row[7]);
                  $values[$i][] = intval($row[8]);
                  $i++;
                }
              }
            }
          }
        }
      }
    }
    return $values;
    fclose($handle);
    closedir($dh);
  }

  public function getStrValues($filename)
  {
    $file = $this->filePath . $filename;
    $handle = fopen($file, 'r');

    $values = array();
    $i = 0;
    while (!feof($handle)) {
      $row = fgetcsv($handle, 1000, ",");
      if(substr($row[0],0,1) == "1" || substr($row[0],0,1) == "2" || substr($row[0],0,1) == "3") {

        $values[$i][] = intval($row[0]);
        $values[$i][] = $row[1];
        $values[$i][] = intval($row[2]);
        $values[$i][] = intval($row[3]);
        $values[$i][] = floatval(str_replace(",","",$row[4]));
        $values[$i][] = floatval($row[5]);
        $values[$i][] = floatval($row[6]);
        $values[$i][] = floatval($row[7]);
        $values[$i][] = intval($row[8]);
        $values[$i][] = intval($row[9]);
        $values[$i][] = floatval(str_replace(",","",$row[10]));
        $values[$i][] = floatval($row[11]);
        $values[$i][] = floatval($row[12]);
        $values[$i][] = floatval($row[13]);
        $values[$i][] = floatval($row[14]);
        $values[$i][] = floatval($row[15]);
        $values[$i][] = floatval($row[16]);
        $values[$i][] = $row[17];
        $values[$i][] = $row[18];
        $values[$i][] = $row[19];
        $values[$i][] = intval($row[20]);
        $values[$i][] = intval($row[21]);
        $values[$i][] = floatval(str_replace(",","",$row[22]));
        $values[$i][] = floatval($row[23]);
        $values[$i][] = floatval($row[24]);
        $values[$i][] = floatval($row[25]);
        $values[$i][] = intval($row[26]);
        $values[$i][] = intval($row[27]);
        $values[$i][] = floatval(str_replace(",","",$row[28]));
        $values[$i][] = floatval($row[29]);
        $values[$i][] = floatval($row[30]);
        $values[$i][] = floatval($row[31]);
        $values[$i][] = floatval($row[32]);
        $values[$i][] = floatval($row[33]);
        $values[$i][] = floatval($row[34]);
        $values[$i][] = $row[35];
        $values[$i][] = $row[36];
        $values[$i][] = $row[37];
        $values[$i][] = floatval($row[38]);
        $values[$i][] = floatval($row[39]);
        $values[$i][] = floatval($row[40]);
        $values[$i][] = floatval($row[41]);
        $values[$i][] = floatval($row[42]);
        $values[$i][] = floatval($row[43]);
        $values[$i][] = floatval($row[44]);
        $values[$i][] = floatval($row[45]);
        $values[$i][] = floatval($row[46]);
        $values[$i][] = floatval($row[47]);
        $values[$i][] = floatval($row[48]);
        $values[$i][] = floatval($row[49]);
        $values[$i][] = floatval($row[50]);
        $values[$i][] = floatval($row[51]);
        $values[$i][] = floatval($row[52]);
        $values[$i][] = $row[53];
        $values[$i][] = $row[54];
        $values[$i][] = $row[55];
        $i++;
      }
    }
    return $values;
    fclose($handle);
  }

  public function getTransactionValues($array)
  {
    $values = array();
    $i = 0;
    foreach($array as $value) {
      $operaID = $value[0];

      if (is_dir($this->transactionFilePath)){
        if ($dh = opendir($this->transactionFilePath)){
          while (($filename = readdir($dh)) !== false){
            if (strpos($filename, "Analytics PHCompany.com (Reporting) ") !== false) {
              $arr = explode("Analytics PHCompany.com (Reporting) ", $filename);
              $originFile = $arr[1];

              // if (strpos($originFile, $hotelName) !== false) {
                if (strpos($originFile, $operaID) !== false) {
                // $this->hotelName = $hotelName;
                $this->operaID = $operaID;
                $file = $this->transactionFilePath . $filename;
                $handle = fopen($file, 'r');
                while (!feof($handle)) {
                  $row = fgetcsv($handle, 1000, ",");
                  if(substr($row[0],0,2) == "20") {

                  //Convert transaction date to yyyy-mm-dd
                  $year = substr($row[0],0,4);
                  $month = substr($row[0],4,2);
                  $day = substr($row[0],6,2);
                  $hour = substr($row[0],8,2);
                  $transactionDate = $year."-".$month."-".$day;


                  $values[$i][] = $this->operaID;
                  $values[$i][] = $transactionDate;
                  $values[$i][] = $hour;
                  $values[$i][] = intval(str_replace(",","",$row[1]));
                  $values[$i][] = $row[2];
                  $values[$i][] = $row[3];
                  $values[$i][] = $row[4];
                  $values[$i][] = intval(str_replace(",","",$row[5]));
                  $total_revenue = str_replace("£","",$row[6]);
                  $total_revenue = floatval(str_replace(",","",$total_revenue));
                  $values[$i][] = $total_revenue;
                  $i++;
                 }
               }
             }
           } else {
             null;
            }
          }
        }
      }
    }
    return $values;
    fclose($handle);
    closedir($dh);
  }


}

?>
