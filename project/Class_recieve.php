<?php
include("header.php");
include("side.php");
?>
<html>
    <h3>Saving submission...</h3>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
  if ($stmt = $mysqli->prepare("INSERT INTO Class(CourseID,ONID,subject,time,location) VALUES(?,?,?,?,?)")) {
      $CourseID = $_REQUEST["CourseID"];
      $ONID = $_REQUEST["ONID"];
      $subject = $_REQUEST["subject"];
      $time = $_REQUEST["time"];
      $location = $_REQUEST["location"];

      /* for five params, pass five character types to bind_param with five values */
      $stmt->bind_param("issts", $CourseID, $ONID, $subject, $time, $location);
      $stmt->execute();

    $stmt->close();
  } else {
    printf("Error: %s\n", $mysqli->error);
  }
?>

<h3>View results...<li><a href="class.php">Classes</a></li></h3>

<?php include("footer.php");?>
