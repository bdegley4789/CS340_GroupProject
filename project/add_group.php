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
echo "<table class='Group'><tr><th> Group Name  <th> Group Number <th> Current Size <th> Max Size <th> Course <th> Join </tr>";
if ($result = $mysqli->query("SELECT G.Name,G.GroupID,G.size,C.subject FROM `Class`C, `Group`G WHERE C.CourseID = G.CourseID AND C.CourseID in (SELECT CourseID FROM TakingClass WHERE ONID='".$_SESSION["onidid"]."')")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->Name)."</td>";
            echo "<td>".htmlspecialchars($obj->GroupID)."</td>";
						if ($current = $mysqli->query("SELECT COUNT(GroupID) g FROM `GroupMember` WHERE GroupID = ".htmlspecialchars($obj->GroupID)."")) {
							while($temp = $current->fetch_object()){
								echo "<td>".htmlspecialchars($temp->g)."</td>";
							}
						}
            echo "<td>".htmlspecialchars($obj->size)."</td>";
						echo "<td>".htmlspecialchars($obj->subject)."</td>";
						echo "<td><form action='groupRecieve.php'>";
						echo "<input type='hidden' name = 'GroupID' value = ".htmlspecialchars($obj->GroupID).">";
						echo "<input type='submit' value='Submit'>";
						echo "</form></td>";
		}
echo "</table>";
}
?>
<?php
include("footer.php");
?>
