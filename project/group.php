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
    <h1>Groups</h1>
  </head>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Group'><tr><th> Group Name  <th> Group Number <th> Size <th> Course </tr>";
//$stid = $_SESSION["osuuid"];

if ($result = $mysqli->query("SELECT G.Name, G.GroupID, G.size, C.subject FROM `Group`G,`Class`C,`GroupMember`M WHERE C.CourseID = G.CourseID AND M.GroupID = G.GroupID AND M.ONID='".$_SESSION['onidid']."'")) {
		while($obj = $result->fetch_object()){
            echo "<tr>";
						echo "<td>"."<a href=\"./displayGroup.php?Name=$obj->Name&GroupID=$obj->GroupID\">$obj->Name</a>"."</td>";
            echo "<td>".htmlspecialchars($obj->GroupID)."</td>";
            echo "<td>".htmlspecialchars($obj->size)."</td>";
						echo "<td>".htmlspecialchars($obj->subject)."</td>";
						echo "</tr>";
		}
echo "</table>";
}
?>
<?php
include("footer.php");
?>
