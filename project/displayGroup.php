<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<div>
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
<div>
<h2>Group from course:
<?php
	$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
	$name = $mysqli->query("SELECT C.subject FROM `Group`G,`Class`C WHERE G.GroupID = '".$_GET["GroupID"]."' AND G.CourseID = C.CourseID")->fetch_row()[0];
	echo "<td>"."<a href=\"./display.php?subject=$name\">$name</a>"."</td>";
?>
</h2>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Thress'><tr><th> Poster <th>  Title <th> Messages </tr>";
if ($result = $mysqli->query("SELECT S.firstName,S.lastName,T.Title,T.TopicID FROM `Threads`T,`Students`S,`Group`G WHERE S.ONID = T.ONID AND G.GroupID = T.GroupID AND G.GroupID = '".$_GET["GroupID"]."'")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->firstName)." ".htmlspecialchars($obj->lastName)."</td>";
            echo "<td>".htmlspecialchars($obj->Title)."</td>";
						echo "<td><form action='messages.php' method='post'>";
						echo "<input type='hidden' name = 'TopicID' value = ".htmlspecialchars($obj->TopicID).">";
						echo "<input type='submit' value='View'>";
						echo "</form></td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";
?>
</div>
<div>
<html>
	<h2>Group Members</h2>
</html>
<?php
$ingroup = 0;
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_alessanf","vhwfz4pPVJe4rssw","cs340_alessanf");
echo "<table class='Students'><tr><th> First Name  <th> Last Name </tr>";
if ($result = $mysqli->query("SELECT S.ONID, firstName,lastName FROM `Students`S,`GroupMember`M,`Group`G WHERE G.GroupID = '".$_GET["GroupID"]."' AND G.GroupID = M.GroupID AND M.ONID = S.ONID")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->firstName)."</td>";
            echo "<td>".htmlspecialchars($obj->lastName)."</td>";
            echo "</tr>";
			if($obj->ONID == $_SESSION['onidid']) {
				$ingroup = 1;
			}
    }
	echo "</table>";
	if($ingroup == 0) {
		echo "<form action='groupRecieve.php' method='post'>";
		echo "<input type='hidden' name = 'GroupID' value = ".htmlspecialchars($_REQUEST['GroupID']).">";
		echo "<input type='submit' value='Join group'>";
	}
	else {
		echo "<form action='leavegroup.php' method='post'>";
		echo "<input type='hidden' name = 'GroupID' value = ".htmlspecialchars($_REQUEST['GroupID']).">";
		echo "<input type='hidden' name = 'Name' value = ".htmlspecialchars($_REQUEST['Name']).">";
		echo "<input type='submit' value='Leave group'></form><br>";
		echo "<form action='add_thread.php' method='post'>";
		echo "<input type='hidden' name = 'GroupID' value = ".htmlspecialchars($_REQUEST['GroupID']).">";
		echo "<input type='submit' value='Create a new thread'></form>";
	}
    $result->close();
}

?>
</div>
</div>
<?php
include("footer.php");
?>
