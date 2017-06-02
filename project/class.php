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
echo "<table class='Name'><tr><th> Name  <th> Time <th> Location</tr>";
//$stid = $_SESSION["osuuid"];
if ($result = $mysqli->query("SELECT C.subject,C.time,C.location FROM `Class`C, `TakingClass`T, `Students`S WHERE T.CourseID = C.CourseID AND S.ONID = T.ONID AND S.ONID='".$_SESSION['ONID']."'")) {
		while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->subject)."</td>";
            echo "<td>".htmlspecialchars($obj->time)."</td>";
            echo "<td>".htmlspecialchars($obj->location)."</td>";
						echo "</tr>";
		}
echo "</table>";
}
?>
<?php
include("footer.php");
?>
