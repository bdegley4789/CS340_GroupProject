<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<html>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <head>
    <h1>Current Courses</h1>
  </head>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Group'><tr><th> Group Name  <th> Group Number <th> Size <th> Course <th> Join </tr>";
if ($result = $mysqli->query("SELECT G.Name,G.GroupID,G.size,C.subject FROM `Class`C, `Group`G WHERE C.CourseID = G.CourseID")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->Name)."</td>";
            echo "<td>".htmlspecialchars($obj->GroupID)."</td>";
            echo "<td>".htmlspecialchars($obj->size)."</td>";
						echo "<td>".htmlspecialchars($obj->subject)."</td>";
						echo "<td><form action='index.php'>";
						echo "<name = 'classid' value = ".htmlspecialchars($obj->GroupID).">";
						echo "<input type='submit' value='Submit'>";
						echo "</form></td>";
		}
echo "</table>";
}
?>
<?php
include("footer.php");
?>
