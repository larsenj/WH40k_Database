<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database

//strip leading and trailing whitespaces, otherwise a foreign key error is generated
$trimmed = ltrim($_POST['Loyalty']);
$loyal = rtrim($trimmed);

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","larsenjo-db","BiAYDWCjLQmUGtwv","larsenjo-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
if(!($stmt = $mysqli->prepare("INSERT INTO chapters(chapterName, chapterPrimarch, loyalty) VALUES (?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sss",$_POST['chapterName'],$_POST['primarchName'], $loyal))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to chapters.";
}
?>

