<?php
include("header.php");
include("side.php");
?>
<html>
    <h3>Saving submission...</h3>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
  if ($stmt = $mysqli->prepare("INSERT INTO `Group`(size,CourseID,ONID,Name) VALUES(?,?,?,?)")) {
      $size = $_REQUEST["size"];
      $CourseID = $_REQUEST["CourseID"];
      $ONID = $_SESSION["onidid"];
      $Name = $_REQUEST["Name"];

      /* for five params, pass five character types to bind_param with five values */
      $stmt->bind_param("iiss", $size, $CourseID, $ONID, $Name);
      $stmt->execute();

    $stmt->close();
  } else {
    printf("Error: %s\n", $mysqli->error);
  }
?>

<h3>View results...<a id='redir' href=group.php>Groups</a></h3>
<script>
setTimeout(function() {
	document.getElementById("redir").click();
},250);
</script>
<?php include("footer.php");?>
