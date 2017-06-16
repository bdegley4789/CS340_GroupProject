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
	<title>Messages</title>
	</head>
	<header class='main'>
    <h1>Messages</h1>
  </header>

<div class='main'>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
$TopicID = $mysqli->real_escape_string($_REQUEST["TopicID"]);
echo "<div>";
if ($result = $mysqli->query("SELECT S.firstName,S.lastName,M.Message,M.Time FROM `Messages`M,`Students`S WHERE S.ONID = M.ONID AND M.TopicID=$TopicID")) {
    while($obj = $result->fetch_object()){
			echo "<div>";
			echo htmlspecialchars($obj->firstName)." ".htmlspecialchars($obj->lastName).": ".htmlspecialchars($obj->Message)."\n";
			echo "</div>";
    }

    $result->close();
}
echo "</div>";
echo "<div class='inputmessage'>";
echo "<form method='post' action='add_message.php' class='inform'>";
echo "<input type='hidden' name = 'TopicID' value = ".htmlspecialchars($TopicID).">";
echo "<textarea name='message' rows='4' cols='50' required>";
echo "</textarea>";
echo "<input type=submit></form>";
echo "</div>";
?>
</div>
</html>
<?php
include("footer.php");
?>

