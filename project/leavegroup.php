<?php
include("header.php");
include("side.php");
?>
<html>
    <h3>Leaving Group...</h3>
</html>
<?php
	$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
	$ONID = $mysqli->real_escape_string($_SESSION["onidid"]);
	$GroupID = $mysqli->real_escape_string($_REQUEST['GroupID']);
	#echo $ONID;
	#echo $GroupID;
	$mysqli->query("DELETE FROM `GroupMember` WHERE ONID='".$ONID."' AND GroupID='".$GroupID."'");

	echo "<html>";
	echo "<a id='redir' href=\"displayGroup.php?Name=".$_REQUEST['Name']."&GroupID=".$_REQUEST['GroupID']."\">Click here to return</a>";
	echo "</html>";

?>
<script>
setTimeout(function() {
	document.getElementById("redir").click();
},250);
</script>

<?php include("footer.php");?>
