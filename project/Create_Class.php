<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<html>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <head>
    <title>Create Class</title>
    <h1>Create Class</h1>

    <form method="post" action='Class_recieve.php' class="inform">
      <ul>
<?php
	echo "<label>Instructor:</label>";
	echo "<select id='ONID'>";
	$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
	if ($result = $mysqli->query("SELECT ONID, firstName, lastName FROM Instructors WHERE 1")) {
		while($obj = $result->fetch_object()) {
			echo "<option value='".htmlspecialchars($obj->ONID)."'>".htmlspecialchars($obj->firstName)." ".htmlspecialchars($obj->lastName)."</option>";
		}
	}
	echo "</select>";
	echo "<br>";
	$mysqli->close();
?>
        <label>Subject:</label> <input type="text" name="Subject" required><br>
        <label>location:</label> <input type="text" name="location" required><br>
        <input type=submit><br>
      </ul>
    </form>

  </head>
</html>
<?php
include("footer.php");
?>
