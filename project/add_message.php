<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<header class='main'>
Redirecting back to message:
</header>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
$TopicID = $mysqli->real_escape_string($_POST["TopicID"]);
$message = $mysqli->real_escape_string($_POST["message"]);
$ONID = $mysqli->real_escape_string($_SESSION["onidid"]);

$mysqli->query("INSERT INTO `Messages`(`TopicID`, `ONID`, `Message`, `Time`) VALUES ('$TopicID','$ONID','$message',NOW())");
echo "<td><form action='messages.php' method='post'>";
echo "<input type='hidden' name = 'TopicID' value = ".htmlspecialchars($TopicID).">";
echo "<input id='redir' type='submit' value='Back'>";
?>

<script>
setTimeout(function() {
	document.getElementById("redir").click();
},250);
</script>
</html>
<?php
include("footer.php");
?>
