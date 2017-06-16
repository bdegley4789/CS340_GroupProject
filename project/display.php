<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<html>
  <link rel="stylesheet" type="text/css" href="style.css">
  <head>
    <h1>
			<?php
				echo "<td>".htmlspecialchars($_GET["subject"])."</td>";
			?>
		</h1>
  </head>
  <header class='main'>
	<h2>Assignments</h2>
	</header>
<div class='main'>
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
	<h2>Groups</h2>
<div>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table id='Group'><tr><th> Name  <th> Size <th>  GroupID </tr>";
if ($result = $mysqli->query("SELECT Name,size,GroupID FROM `Group`G,`Class`C WHERE G.CourseID = C.CourseID AND C.subject = '".$_GET["subject"]."'")) {
	echo "<tbody>";
    while($obj = $result->fetch_object()){
            echo "<tr class='Groupshown'>";
						echo "<td>"."<a href=\"./displayGroup.php?Name=$obj->Name&GroupID=$obj->GroupID\">$obj->Name</a>"."</td>";
            echo "<td>".htmlspecialchars($obj->size)."</td>";
            echo "<td>".htmlspecialchars($obj->GroupID)."</td>";
            echo "</tr>";
    }
    $result->close();
	echo "</tbody>";
}
echo "</table>";
echo "</div>";
echo "<td><form action='Create_Group.php' method='get'>";
echo "<input type='hidden' name = 'CourseID' value = ".htmlspecialchars($_GET['CourseID']).">";
echo "<input type='submit' value='New Group'>";
echo "</form>";
?>

	<h2>Students</h2>
	
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
</div>
</html>
<?php
include("footer.php");
?>
