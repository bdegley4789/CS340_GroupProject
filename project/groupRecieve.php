<?php
include("header.php");
include("side.php");
?>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<div class='main'>
    <h3>Saving submission...</h3>

<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
if($mysqli->connect_errno) {
  printf("Connection failed: %s\n", $mysqli->connect_error);
}
  if ($stmt = $mysqli->prepare("insert into GroupMember(ONID,GroupID) values(?,?)")) {

			$ONID = $_SESSION["onidid"];
      $GroupID = $mysqli->real_escape_string($_REQUEST["GroupID"]);

      //echo "$ONID";
      //echo "$GroupID";

      $stmt->bind_param("ss", $ONID,$GroupID);
      $stmt->execute();

    $stmt->close();
  } else {
    printf("Error: %s\n", $mysqli->error);
  }
?>

<h3>View results...<a href="group.php">Your Groups</a></h3>
</div>
</html>
<?php include("footer.php");?>
