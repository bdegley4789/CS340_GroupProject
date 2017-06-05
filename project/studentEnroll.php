<?php
include("header.php");
include("side.php");
?>
<html>
    <h3>Saving submission...</h3>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
if($mysqli->connect_errno) {
  printf("Connection failed: %s\n", $mysqli->connect_error);
}
  if ($stmt = $mysqli->prepare("insert into TakingClass(ONID,CourseID) values(?,?)")) {

			$ONID = $_SESSION["onidid"];
      $CourseID = $mysqli->real_escape_string($_REQUEST["CourseID"]);

      //echo "$ONID";
      //echo "$CourseID";

      $stmt->bind_param("ss", $ONID,$CourseID);
      $stmt->execute();

    $stmt->close();
  } else {
    printf("Error: %s\n", $mysqli->error);
  }
?>

<h3>View results...<li><a href="class.php">Your Classes</a></li></h3>

<?php include("footer.php");?>
