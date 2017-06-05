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
    <h1>
			<?php
				echo "<td>".htmlspecialchars($_GET["subject"])."</td>";
			?>
		</h1>
  </head>
</html>
<html>
	<h2>Assignments</h2>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Assignment'><tr><th> Name  <th> Description <th>  Due Date </tr>";
if ($result = $mysqli->query("SELECT Name,Description,DueDate FROM `Assignment`A,`Class`C WHERE C.CourseID = A.CourseID AND C.subject = '".$_GET["subject"]."'")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->Name)."</td>";
            echo "<td>".htmlspecialchars($obj->Description)."</td>";
            echo "<td>".htmlspecialchars($obj->DueDate)."</td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";
?>
<html>
	<h2>Groups</h2>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Assignment'><tr><th> Name  <th> Size <th>  GroupID </tr>";
if ($result = $mysqli->query("SELECT Name,size,GroupID FROM `Group`G,`Class`C WHERE G.CourseID = C.CourseID AND C.subject = '".$_GET["subject"]."'")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->Name)."</td>";
            echo "<td>".htmlspecialchars($obj->size)."</td>";
            echo "<td>".htmlspecialchars($obj->GroupID)."</td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";
?>
<html>
	<h2>Students</h2>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Students'><tr><th> First Name  <th> Last Name </tr>";
if ($result = $mysqli->query("SELECT firstName,lastName FROM `Students`S,`TakingClass`T,`Class`C WHERE C.subject = '".$_GET["subject"]."' AND C.CourseID = T.CourseID AND T.ONID = S.ONID")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->firstName)."</td>";
            echo "<td>".htmlspecialchars($obj->lastName)."</td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";
?>
<?php
include("footer.php");
?>
