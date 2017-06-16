<?php
include("header.php");
include("side.php");
?>
<html>
    <h3>Saving submission...</h3>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
  if ($stmt = $mysqli->prepare("INSERT INTO Assignment(CourseID,Name,DueDate,Description) VALUES(?,?,?,?)")) {
      $CourseID = $_REQUEST["CourseID"];
      $Name = $_REQUEST["Name"];
      $DueDate = $_REQUEST["DueDate"];
      $Description = $_REQUEST["Description"];

      /* for five params, pass five character types to bind_param with five values */
      $stmt->bind_param("isss", $CourseID, $Name, $DueDate, $Description);
      $stmt->execute();
    $stmt->close();
  } else {
    printf("Error: %s\n", $mysqli->error);
  }
?>

<?php
$subject = $_REQUEST['subject'];
$CourseID = $_REQUEST['CourseID'];
echo "<td>"."<a id='redir' href=\"./display.php?subject=$subject&CourseID=$CourseID\">$subject</a>"."</td>";
?>
<script>
setTimeout(function() {
	document.getElementById("redir").click();
},250);
</script>
<?php include("footer.php");?>
