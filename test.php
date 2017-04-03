<?php
include 'includes/_header.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookingdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


  $sql = "SELECT
  h.ga_hotel_name AS 'Hotel',
  r.opera_id AS 'Opera ID',
  r.market_code AS 'Market Code',
  SUM(r.nights) AS 'Room Nights',
  CAST(SUM(r.room_revenue) AS DECIMAL) AS 'Room Revenue',
  MONTH(r.business_date) AS 'Month',
  YEAR(r.business_date) AS 'Year',
  CAST((SUM(r.room_revenue)/SUM(r.nights)) AS DECIMAL)  AS 'ADR',
  CASE
  WHEN DAYNAME(r.business_date) IN ('Saturday','Sunday') THEN 'Weekend'
  ELSE 'Midweek'
  END AS 'MW or WK',
  CASE
  WHEN MONTH(r.business_date) IN (1,2,3) THEN 'Q1'
  WHEN MONTH(r.business_date) IN (4,5,6) THEN 'Q2'
  WHEN MONTH(r.business_date) IN (7,8,9) THEN 'Q3'
  WHEN MONTH(r.business_date) IN (10,11,12) THEN 'Q4'
  END AS 'Quarter',
  CASE
  WHEN r.market_code LIKE 'G%' THEN 'Group'
  WHEN r.market_code LIKE 'T%' THEN 'Transient'
  WHEN r.market_code LIKE 'C%' THEN 'Contract'
  ELSE 'Other'
  END AS 'Market Group',
  r.market_desc AS 'Market',
  CASE
  WHEN h.ga_hotel_name LIKE '%Principal%' THEN 'Principal'
  WHEN h.ga_hotel_name != 'De Vere Orchard Hotel' AND h.ga_hotel_name LIKE 'De Vere%' THEN 'De Vere'
  WHEN h.ga_hotel_name IN ('Blythswood Square Hotel','The Bonham Hotel','The Roxburghe Hotel','De Vere Orchard Hotel') THEN 'Other'
  ELSE 'Partner'
  END AS 'Grouping'
  FROM res_stats r
  LEFT JOIN hotel_info h
  ON h.opera_id = r.opera_id
  WHERE r.business_date <= CURDATE() - INTERVAL 1 DAY
  AND r.business_date LIKE '2016-01%' OR r.business_date LIKE '2017-01%'
  AND h.status = 'Active'
  GROUP BY YEAR(r.business_date), MONTH(r.business_date), 'Quarter', r.opera_id, h.ga_hotel_name, r.market_code, 'MK or WK','Market', 'Market Group'
  LIMIT 10
  UNION
  SELECT
  h.ga_hotel_name AS 'Hotel',
  f.opera_id AS 'Opera ID',
  f.market_code AS 'Market Code',
  SUM(f.rooms) AS 'Room Nights',
  CAST(SUM(f.room_revenue) AS DECIMAL) AS 'Room Revenue',
  MONTH(f.business_date) AS 'Month',
  YEAR(f.business_date) AS 'Year',
  CAST((SUM(f.room_revenue)/SUM(f.rooms)) AS DECIMAL) AS 'ADR',
  CASE
  WHEN DAYNAME(f.business_date) IN ('Saturday','Sunday') THEN 'Weekend'
  ELSE 'Midweek'
  END AS 'MW or WK',
  CASE
  WHEN MONTH(f.business_date) IN (1,2,3) THEN 'Q1'
  WHEN MONTH(f.business_date) IN (4,5,6) THEN 'Q2'
  WHEN MONTH(f.business_date) IN (7,8,9) THEN 'Q3'
  WHEN MONTH(f.business_date) IN (10,11,12) THEN 'Q4'
  END AS 'Quarter',
  CASE
  WHEN f.market_code LIKE 'G%' THEN 'Group'
  WHEN f.market_code LIKE 'T%' THEN 'Transient'
  WHEN f.market_code LIKE 'C%' THEN 'Contract'
  ELSE 'Other'
  END AS 'Market Group',
  f.market_desc AS 'Market',
  CASE
  WHEN h.ga_hotel_name LIKE '%Principal%' THEN 'Principal'
  WHEN h.ga_hotel_name != 'De Vere Orchard Hotel' AND h.ga_hotel_name LIKE 'De Vere%' THEN 'De Vere'
  WHEN h.ga_hotel_name IN ('Blythswood Square Hotel','The Bonham Hotel','The Roxburghe Hotel','De Vere Orchard Hotel') THEN 'Other'
  ELSE 'Partner'
  END AS 'Grouping'
  FROM res_forecast f
  LEFT JOIN hotel_info h
  ON h.opera_id = f.opera_id
  WHERE f.business_date >= CURDATE()
  AND f.business_date LIKE '2016-01%' OR f.business_date LIKE '2017-01%'
  AND h.status = 'Active'
  GROUP BY YEAR(f.business_date), MONTH(f.business_date), 'Quarter', f.opera_id, h.ga_hotel_name, f.market_code, 'MW or WK','Market', 'Market Group'
  LIMIT 10";
  $result = $conn->query($sql);
?>


<body>

<div class="container">
  <br>
  <br>
  <h2>Table</h2>
  <div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Hotel</th>
        <th>Opera ID</th>
        <th>Room Nights</th>
        <th>Room Revenue</th>
      </tr>
    </thead>
    <tbody>
      <?php
          while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['Hotel'] . "</td>";
          echo "<td>" . $row['Opera ID'] . "</td>";
          echo "<td>" . $row['Room Nights'] . "</td>";
          echo "<td>" . $row['Room Revenue'] . "</td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
  </div>

<div id="chart"></div>
<?php
$sql =
  " SELECT
  h.ga_hotel_name AS 'Hotel',
  CAST(SUM(r.room_revenue) AS DECIMAL) AS 'Room Revenue',
  SUM(r.nights) AS 'Room Nights'
  FROM res_stats r
  LEFT JOIN hotel_info h
  ON h.opera_id = r.opera_id
  GROUP BY opera_id";
$result = $conn->query($sql);
var_dump ($result);
?>
<script>
    var js_array = [<?php echo json_encode($result);?>]
    var chart = c3.generate({
    bindto: '#chart',
    data: {
      columns: [js_array]
    }
});
</script>
</div>


<?php
$conn->close();
?>
