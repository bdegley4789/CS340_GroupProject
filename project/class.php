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
<body>
</div>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Name'><tr><th> Name <th> Location</tr>";
//$stid = $_SESSION["osuuid"];
if ($result = $mysqli->query("SELECT C.subject,C.location FROM `Class`C, `TakingClass`T, `Students`S WHERE T.CourseID = C.CourseID AND S.ONID = T.ONID AND S.ONID='".$_SESSION['onidid']."'")) {
		while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>"."<a href=\"./display.php?subject=$obj->subject\">$obj->subject</a>"."</td>";
            echo "<td>".htmlspecialchars($obj->location)."</td>";
						echo "</tr>";
		}
echo "</table>";
}
?>
</div>
</body>
<?php
include("footer.php");
?>
