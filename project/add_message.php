<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
Redirecting back to message:
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
<?php
include("footer.php");
?>
