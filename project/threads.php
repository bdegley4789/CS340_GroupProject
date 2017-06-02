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
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Threads'><tr><th> First Name  <th> Last Name <th> Thread Title <th> Group </tr>";
if ($result = $mysqli->query("SELECT S.firstName,S.lastName,T.Title,T.GroupID FROM `Threads`T,`Students`S WHERE S.ONID = T.ONID")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->firstName)."</td>";
            echo "<td>".htmlspecialchars($obj->lastName)."</td>";
            echo "<td>".htmlspecialchars($obj->Title)."</td>";
						echo "<td>".htmlspecialchars($obj->GroupID)."</td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";
?>
<?php
include("footer.php");
?>
