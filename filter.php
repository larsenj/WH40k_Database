<!--
filtered by Theatre of Operation
-->

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
    <title>Space Marine Chapters Database</title>
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
		<th>Loyalty</th>
	</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT chapters.chapterName, chapters.chapterPrimarch, chapters.loyalty FROM chapters INNER JOIN theatreOfOperations ON chapters.id = theatreOfOperations.chapter_id WHERE theatreOfOperations.area_id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['areaName']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name, $primarch, $loyalty)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $primarch . "\n</td>\n<td>\n" . $loyalty . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

</body>
</html>
