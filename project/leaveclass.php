<?php
include("header.php");
include("side.php");
?>
<html>
    <h3>Leaving Class...</h3>
</html>
<?php
	$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
	$ONID = $mysqli->real_escape_string($_SESSION["onidid"]);
	$CourseID = $mysqli->real_escape_string($_REQUEST['CourseID']);
	echo $ONID;
	echo $CourseID;
	$mysqli->query("DELETE FROM `TakingClass` WHERE ONID='".$ONID."' AND CourseID='".$CourseID."'");

?>
<h3>View results...<a href="class.php">Classes</a></h3>

<?php include("footer.php");?>
