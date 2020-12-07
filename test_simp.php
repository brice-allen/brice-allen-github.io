<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
$servername = "ucdencsesql05.ucdenver.pvt";
$username = "student08";
$password = "NVNkjbhWWxZT";
$database = "student08db";
$port = 22;

// Create connection
$con = mysqli_connect($servername, $username, $password, $database, $port);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " .$con->connect_error);
}
echo "successful ";

$sql = "SELECT\n"
    . " constructors.name as \'Constructor Name\',\n"
    . " c_rank.total_points as \'Points YTD\'\n"
    . "From\n"
    . " constructors,\n"
    . " c_rank \n"
    . "Where\n"
    . " constructors.constructor_id = c_rank.constructor_id\n"
    . "Order by c_rank.total_points Desc\n"
    . "\n"
    . "limit 0,3\n"
    . "";
$result = $con->query($sql);
if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        echo "<tr><td>".
            $row["Name"]."</td><td>".
            $row["Rank"]."</td><td>";
    }
    echo "</table>";
}else {echo "No results";}

?>
</body>
</html>