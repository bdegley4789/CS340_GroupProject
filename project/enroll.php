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
  <title>Enroll</title>
  </head>
  <header class='main'>
    <h1>All Courses</h1>
  </header>
<div class='main'>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Name'><tr><th> Name <th> Location <th> Enroll </tr>";
if ($result = $mysqli->query("select CourseID,subject,location from Class")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->subject)."</td>";
            echo "<td>".htmlspecialchars($obj->location)."</td>";
						echo "<td><form action='studentEnroll.php' method='post'>";
						echo "<input type='hidden' name = 'CourseID' value = ".htmlspecialchars($obj->CourseID).">";
						echo "<input type='submit' value='Submit'>";
						echo "</form></td>";
		}
echo "</table>";
}
?>
</div>
</html>
<?php
include("footer.php");
?>
