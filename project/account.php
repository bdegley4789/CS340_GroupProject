<?php session_start();?>
<?php
include("static/php/_db_header.php");
include("header.php");
include("side.php");
?>
<!--<?php
	//if (isset($_SESSION['loggedin'])/*checkAuth(true) != FALSE*/) {
?>
<h1>Not logged in</h1>
-->
<?php


if (checkAuth(true)){
	?>
	<h1>Your Account:</h1>
<?php echo "<p>ONID User Name: ".$_SESSION['onidid']."</p>"; ?>
<?php echo "<p>First Name: ".$_SESSION['firstname']."</p>"; ?>
<?php echo "<p>Last Name: ".$_SESSION['lastname']."</p>"; ?>
<?php echo "<p>ID: ".htmlspecialchars($_SESSION['osuuid'])."</p>"; ?>

<?php
	$id = htmlspecialchars($_SESSION['osuuid']);
	$fn = $db->escape_string($_SESSION['firstname']);
	$ln = $db->escape_string($_SESSION['lastname']);
	$data = $db->query("SELECT ONID FROM Students WHERE Students.ONID = '$id'");
	if($data->num_rows == 0) {
		echo "hello world!";
		if(!$db->query("INSERT INTO Students(firstName, lastName, ONID) VALUES('$fn', '$ln', '$id')")) {
			echo "$db->error";
			echo $db->error;
		}
	}
?>
<?php
}



if (isset($_SESSION['loggedin'])) { ?>
<h1>Login Successful</h1>
<?php } ?>
<?php include("static/php/_db_footer.php"); ?>
<?php include("footer.php");?>
