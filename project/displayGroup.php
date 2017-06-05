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
				echo "<td>".htmlspecialchars($_GET["Name"])."</td>";
			?>
		</h1>
  </head>
</html>
<html>
<h2>Threads from course:
<?php
	$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
	$name = $mysqli->query("SELECT C.subject FROM `Group`G,`Class`C WHERE G.Name = '".$_GET["Name"]."' AND G.CourseID = C.CourseID")->fetch_row()[0];
	echo "<td>"."<a href=\"./display.php?subject=$name\">$name</a>"."</td>";
?>
</h2>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Thress'><tr><th> First Name  <th> Last Name <th>  Title </tr>";
if ($result = $mysqli->query("SELECT S.firstName,S.lastName,T.Title FROM `Threads`T,`Students`S,`Group`G WHERE S.ONID = T.ONID AND G.GroupID = T.GroupID AND G.Name = '".$_GET["Name"]."'")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->firstName)."</td>";
            echo "<td>".htmlspecialchars($obj->lastName)."</td>";
            echo "<td>".htmlspecialchars($obj->Title)."</td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";
?>
<html>
	<h2>Group Members</h2>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Students'><tr><th> First Name  <th> Last Name </tr>";
if ($result = $mysqli->query("SELECT firstName,lastName FROM `Students`S,`GroupMember`M,`Group`G WHERE G.Name = '".$_GET["Name"]."' AND G.GroupID = M.GroupID AND M.ONID = S.ONID")) {
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