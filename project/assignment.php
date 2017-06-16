<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Assignment</title>
	</head>
	<header class='main'>
    <h1>Assignments</h1>
  </header>
<div class='main'>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Assignment'><tr><th> Name  <th> Description <th>  Due Date </tr>";
if ($result = $mysqli->query("SELECT Name,Description,DueDate FROM Assignment")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->Name)."</td>";
            echo "<td>".htmlspecialchars($obj->Description)."</td>";
            echo "<td>".htmlspecialchars($obj->DueDate)."</td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";
?>
</div>
</html>
<?php
include("footer.php");
?>
