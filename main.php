<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","larsenjo-db","BiAYDWCjLQmUGtwv","larsenjo-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Space Marine Chapters Database</title>i
</head>

<body>

<div id="FullTable">
<table>
    <tr>
	    <th>Space Marine Chapters</th>
	</tr>
	<tr>
	    <th>Name</th>
		<th>Primarch</th>
		<th>Homeworld</th>
	</tr>
<-- 	<tr>
	    <td>Ultramarines</td>
		<td>Robert Guilliman</td>
		<td>Ultramar</td>
    </tr>	
-->
<?php
if(!($stmt = $mysqli->prepare("SELECT bsg_people.fname, bsg_people.age, bsg_planets.name FROM bsg_people INNER JOIN bsg_planets ON bsg_people.homeworld = bsg_planets.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name, $age, $homeworld)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $age . "\n</td>\n<td>\n" . $homeworld . "\n</td>\n</tr>";
}
$stmt->close();
?>
<table>
</div>

</body>
</body>
</html>
