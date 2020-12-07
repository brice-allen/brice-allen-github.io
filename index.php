<!doctype html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="reset.css" rel="stylesheet" type="text/css">
    <link href="2020.css" rel="stylesheet" type="text/css">
    <link href="simp-grid.css" rel="stylesheet" type="text/css">
    <title>Brice Allen | CSCI-3287 |Homework 10</title>
    <meta name="description" content="Brice is a developer who also loves to bike very far.">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: #97F7E3;
            font-family: monospace;
            font-size: 1.3vw;
            text-align:center;
        }
        table caption {
            padding: 10px;
            color: white;
			font-size:1.5vw;
			text-align: left;
			font:bolder;
			font-family: "Brandon Grotesque Black"
        }
        th {
            background-color: #C7F9EF;
            color: black;
        }
        tr:nth-child(odd) {background-color: lightgrey}
        tr:nth-child(even) {background-color: white}

    </style>
</head>

<body class="dark" data-new-gr-c-s-check-loaded="14.984.0" data-gr-ext-installed style
      data-new-gr-c-s-loaded="14.984.0">
<section class="navigation">
    <div class="container">
        <div class="row">
            <h1><a href="/index.html" title="Home" class="heavy type-white" style="font-size:6vw">Brice Allen</a></h1>
        </div>
        <div class="col-9 col-8-sm align-r">
          <li><a href="/index.html" title="Home" class="heavy type-white" style="font-size:2vw">Home</a></li>s
            
            <li><a href="/index.php"  title="Homework 10" class="heavy type-white"style="font-size:2vw">Homework 10</a></li>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-8">
			    <h1><a href="/Homework 10 Practical DB Formula 1.pdf" target="_blank" title="Assignment .pdf" class="heavy type-white" style="font-size:2vw" >Peep the assignment.</a></h1>
            	<h1> <a href="/Homework 10 Practical DB Formula 1.pdf" target="_blank" title="Three Schema" class="heavy type-white"style="font-size:2vw" >Whoa, a three schema diagram.</h1></a>
            	<h1><a href="/Homework 10 Practical DB Formula 1.pdf" target="_blank" title="ER Diagram" class="heavy type-white"style="font-size:2vw">Look at this entitiy relationship diagram.</h1></a>
            	<h1><a href="/Homework 10 Practical DB Formula 1.pdf" target="_blank" title="Normilization" class="heavy type-white"style="font-size:2vw">Can you believe this normilization diagram?</h></a>
        
    </div>
</div>


<?php
$servername = "ucdencsesql05.ucdenver.pvt";
$username = "student08";
$password = "NVNkjbhWWxZT";
$database = "student08db";
$port = 22;

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " .$con->connect_error);
}
?>
	
<section>

<?php
$sql ="SELECT
		races.date as 'Date',
		tracks.track_name as 'Name',
		concat_ws(' ', drivers.first, drivers.last) as 'Driver',
		cars.year as 'Year',
		concat_ws(' ', cars.make, cars.model) as 'Vehicle',
		c_results.points as 'Points',
		c_results.bonus as 'Bonus'
FROM
		races,
		drivers,
		cars,
		c_results,
		tracks
WHERE
		races.driver_id = drivers.driver_id
AND
		races.result_id = c_results.c_res_id
AND
		races.car_id = cars.car_id
AND
		races.track_id = tracks.track_id 
		
ORDER BY races.date ASC


";

$result = $con->query($sql);
    if($result->num_rows > 0){
      echo "<table>
      <caption>Table One -- A list of races</caption>

<tr>
  <th>Date</th>
  <th>Name</th>
  <th>Driver</th>
  <th>Year</th>
  <th>Vehilce</th>
  <th>Points</th>
  <th>Bonus</th>
</tr>";

while ($row = $result->fetch_assoc()) {
  echo "<tr>  <td>" .
      $row["Date"] . "</td><td>" .
      $row["Name"] . "</td><td>" .
      $row["Driver"] . "</td><td>" .
      $row["Year"] . "</td><td>" .
      $row["Vehicle"] . "</td><td>" .
      $row["Points"] . "</td><td>" .
      $row["Bonus"] . "</td> </tr>";
}
        echo "</table>";
    }else {echo "No results";}

?>
</section>

<section>
    <?php

$sql1 ="SELECT
		constructors.name as 'Constructor',
		c_rank.total_points as 'Points'
From
		constructors,
		c_rank
Where
		constructors.constructor_id = c_rank.constructor_id
Order by c_rank.total_points Desc

limit 0,3


    ";

    $result1 = $con->query($sql1);
        if($result1->num_rows > 0){
          echo "<table>
          <caption>Table Two -- Top three constructors</caption>

    <tr>
      <th>Constructor</th>
      <th>Points</th>
    </tr>";

    while ($row = $result1->fetch_assoc()) {
      echo "<tr>  <td>" .
          $row["Constructor"] . "</td>  <td>" .
          $row["Points"] . "</td> </tr>";
    }
            echo "</table>";
        }else {echo "No results";}

        ?>
      </section>
<section>
<?php
$sql2="SELECT
		concat_ws(' ',drivers.first, drivers.last) as 'Driver',
		constructors.name as 'Constructor',
		cars.year as 'Year',
		concat_ws(' ', cars.make, cars.model) as 'Vehicle',
		d_rank.total_points as 'Points YTD'
From
		drivers,
		constructors,
		c_rank,
		d_rank,
		cars
Where
		drivers.constructor_id = c_rank.constructor_id
AND		constructors.constructor_id = c_rank.constructor_id
AND		drivers.driver_id = d_rank.driver_id
AND		drivers.car_id= cars.car_id
Order by d_rank.total_points Desc

limit 0,3
";

$result2 = $con->query($sql2);
    if($result2->num_rows > 0){
      echo "<table>
      <caption>Table Three -- Top three drivers</caption>

<tr>
  <th>Driver</th>
  <th>Constructor</th>
  <th>Year</th>
  <th>Vehicle</th>
  <th>Points YTD</th>

</tr>";

while ($row = $result2->fetch_assoc()) {
  echo "<tr>
  <td>" .
      $row["Driver"] . "</td>  <td>" .
      $row["Constructor"] . "</td>  <td>" .
	  $row["Year"] . "</td>  <td>" .
      $row["Vehicle"] . "</td>  <td>" .
      $row["Points YTD"] . "</td>
      </tr>";
}
        echo "</table>";
    }else {echo "No results";}

 ?>
</section>
<section>
<?php
$sql3="SELECT 
			constructors.name as 'Constructor',
			concat_ws(' ', constructors.first, constructors.last) as 'Principal',
			constructors.email as 'Email'
	   FROM
	   		constructors
";

$result3 = $con->query($sql3);
    if($result2->num_rows > 0){
      echo "<table>
      <caption>Table Four -- Principal contact list</caption>

<tr>
  <th>Constructor</th>
  <th>Principal</th>
  <th>Email</th>

</tr>";

while ($row = $result3->fetch_assoc()) {
  echo "<tr>
  <td>" .
      $row["Constructor"] . "</td>  <td>" .
      $row["Principal"] . "</td>  <td>" .
      $row["Email"] . "</td>
      </tr>";
}
        echo "</table>";
    }else {echo "No results";}

 ?>
</section>
<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <p class="label type-white"style="font-size:1vw">Want to learn more</p>
                <p>
                    <a href="/index.html" title="About" class="heavy type-white"style="font-size:2vw">About me</a>
                </p>
            </div>
            <div class="col-4">
                <p class="label type-white"style="font-size:1vw">How about we say</p>
                <p><a href="mailto:briceallen@gmail.com" target="_blank" title="Hello"
                      class="heavy type-white"style="font-size:2vw">Hello</a></p>
            </div>

        </div>
    </div>
</section>
</body>
</html>
