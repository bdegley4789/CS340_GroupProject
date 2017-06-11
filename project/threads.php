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
    <h1>Threads</h1>
  </head>
</html>
<?php
echo "<div>";
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Threads'><tr><th> Poster <th> Thread Title <th> Group <th> Messages</tr>";
if ($result = $mysqli->query("SELECT S.ONID,T.Title,T.GroupID,T.TopicID FROM `Threads`T,`Students`S WHERE S.ONID = T.ONID")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->ONID)."</td>";
            echo "<td>".htmlspecialchars($obj->Title)."</td>";
			echo "<td>".htmlspecialchars($obj->GroupID)."</td>";
			echo "<td><form action='messages.php'>";
			echo "<input type='hidden' name = 'CourseID' value = ".htmlspecialchars($obj->TopicID).">";
			echo "<input type='submit' value='Go'>";
			echo "</form></td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";
echo "</div>";
?>
<?php
include("footer.php");
?>
