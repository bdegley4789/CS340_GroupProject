<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
$TopicID = $mysqli->real_escape_string($_POST["TopicID"]);
$message = $mysqli->real_escape_string($_POST["message"]);
$ONID = $mysqli->real_escape_string($_SESSION["onidid"]);

$mysqli->query("INSERT INTO `Messages`(`TopicID`, `ONID`, `Message`, `Time`) VALUES ($TopicID,$message,$ONID,NOW())");

?>
Echo Redirecting back to message:

<?php
include("footer.php");
?>
