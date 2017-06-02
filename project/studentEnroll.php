<?php
include("header.php");
include("side.php");
?>
<html>
    <h3>Saving submission...</h3>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
  if ($stmt = $mysqli->prepare("insert into TakingClass(ONID,CourseID) values(?,?)")) {

			$ONID = $_SESSION["onidid"];
      $CourseID = $_REQUEST["CourseID"];


      $stmt->bind_param("is", $ONID,$CourseID);
      $stmt->execute();

    $stmt->close();
  } else {
    printf("Error: %s\n", $mysqli->error);
  }
?>

<h3>View results...<li><a href="class.php">Your Classes</a></li></h3>

<?php include("footer.php");?>
