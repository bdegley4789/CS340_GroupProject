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
if ($result = $mysqli->query("SELECT ONID, Title, GroupID, TopicID FROM `Threads` WHERE `Threads`.`GroupID` in(SELECT `GroupMember`.`GroupID` FROM `GroupMember`, `Students` WHERE `Students`.`ONID`='".$_SESSION['onidid']."' AND `GroupMember`.`ONID`=`Students`.`ONID`)")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->ONID)."</td>";
            echo "<td>".htmlspecialchars($obj->Title)."</td>";
			echo "<td>".htmlspecialchars($obj->GroupID)."</td>";
			echo "<td><form action='messages.php' method='post'>";
			echo "<input type='hidden' name = 'TopicID' value = ".htmlspecialchars($obj->TopicID).">";
			echo "<input type='submit' value='View'>";
			echo "</form></td>";
            echo "</tr>";
    }

    $result->close();
$mysqli->close();
}
echo "</table>";
echo "</div>";
?>
<?php
include("footer.php");
?>
