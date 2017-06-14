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
    <h1>Messages</h1>
  </head>

<body>
</div>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
$TopicID = $mysqli->real_escape_string($_POST["TopicID"]);
echo "<table class='Messages'><tr><th> First Name  <th> Last Name <th> Message <th> Time </tr>";
if ($result = $mysqli->query("SELECT S.firstName,S.lastName,M.Message,M.Time FROM `Messages`M,`Students`S WHERE S.ONID = M.ONID AND M.TopicID=$TopicID")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->firstName)."</td>";
            echo "<td>".htmlspecialchars($obj->lastName)."</td>";
            echo "<td>".htmlspecialchars($obj->Message)."</td>";
						echo "<td>".htmlspecialchars($obj->Time)."</td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";
?>
</div>
</body>
<?php
include("footer.php");
?>
</html>
