<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<html>
<?php
	$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
	$ONID= $_SESSION["onidid"];
	$GroupID = $_REQUEST["GroupID"];
	$threadname = $_REQUEST['threadname'];
	$message = $_REQUEST["message"];
	$mysqli->query("INSERT INTO `Threads`(`title`, `GroupID`, `ONID`) VALUES('".$threadname."','".$GroupID."','".$ONID."')");
	$used_id = $mysqli->insert_id;
	$mysqli->query("INSERT INTO `Messages`(`TopicID`, `ONID`, `Message`, `Time`) VALUES('$used_id', '$ONID', '$message',NOW())");
	echo "<h3>Insert Successful, redirecting to the <a href=\"messages.php?TopicID=$used_id\"> message</a></h3>";
?>
</html>
<script>
setTimeout(function() {
	document.getElementById("redir").click();
},250);
</script>
<?php
include("footer.php");
?>