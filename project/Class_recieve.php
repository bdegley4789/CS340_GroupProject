<?php
include("header.php");
include("side.php");
?>
<html>
    <h3>Saving submission...</h3>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
  if ($stmt = $mysqli->prepare("INSERT INTO Class(ONID,subject,location) VALUES(?,?,?)")) {
      $ONID = $_REQUEST["ONID"];
      $subject = $_REQUEST["subject"];
      $location = $_REQUEST["location"];
      echo $ONID;
      echo $subject;
      echo $location ;

      /* for five params, pass five character types to bind_param with five values */
      $stmt->bind_param("iss", $ONID, $subject, $location);
      $stmt->execute();

    $stmt->close();
  } else {
    printf("Error: %s\n", $mysqli->error);
  }
?>

<h3>View results...<a href="enroll.php">Courses</a></h3>

<?php include("footer.php");?>
