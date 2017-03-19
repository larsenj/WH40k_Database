<!-- main.php -->

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
if(!($stmt = $mysqli->prepare("SELECT chapterName, chapterPrimarch, loyalty FROM chapters"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
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
<table>
</div>

<h3>Filter by Combat Zone</h3>
<div>
	<form method="post" action="filter.php">
		<fieldset>
			<legend>Filter By Combat Zone</legend>
				<select name="areaName">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, areaName FROM areas"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($a_id, $areaName)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $a_id . ' "> ' . $areaName . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
		</fieldset>
		<input type="submit" value="Run Filter" />
	</form>
</div>



<h3>Add a Space Marine Chapter</h3>
<div id='AddChapter'>
	<form method="post" action="addchapter.php"> 
		<fieldset>
			<legend>Chapter Name</legend>
			<input type="text" name="chapterName" /></p>
		</fieldset>

		<fieldset>
			<legend>Primarch</legend>
			<input type="text" name="primarchName" /></p>
		</fieldset>

		<fieldset>
			<legend>Loyalty</legend>
			<select name="Loyalty">
<?php
if(!($stmt = $mysqli->prepare("SELECT loyalty FROM loyalty"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($loyalty)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	//echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
	echo '<option value=" '. $loyalty . ' "> ' . $loyalty . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<h3>Add a Combat Zone</h3>
<div id='AddArea'>
	<form method="post" action="addarea.php"> 
		<fieldset>
			<legend>Area Name</legend>
			<input type="text" name="areaName" /></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<h3>Add a Space Marine Chapter to an Area of Fighting</h3>
<div id='AddTOO'>
	<form method="post" action="addtoo.php"> 
		<fieldset>
			<legend>Area</legend>
			<select name="areaName">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, areaName FROM areas"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($a_id, $areaName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	//echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
	echo '<option value=" '. $a_id . ' "> ' . $areaName . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		<fieldset>
			<legend>Space Marine Chapter</legend>
			<select name="chapterName">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, chapterName FROM chapters"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($c_id, $chapterName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	//echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
	echo '<option value=" '. $c_id . ' "> ' . $chapterName . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<h3>Add a Primarch</h3>
<h5>Be advised: this is heresy</h5>
<div id='AddPrimarch'>
	<form method="post" action="addprimarch.php"> 
		<fieldset>
			<legend>Primarch Name</legend>
			<input type="text" name="primarchName" /></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<h3>Add a Loyalty</h3>
<h5>Be advised: this is also heresy</h5>
<div id='AddLoyalty'>
	<form method="post" action="addloyalty.php"> 
		<fieldset>
			<legend>Loyalty</legend>
			<input type="text" name="loyalty" /></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

</body>
</body>
</html>
