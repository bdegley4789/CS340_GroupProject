<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<html>
	<head>
		<h1>Create a new thread </h1>
	</head>


<?php
	echo "<form action='threadReceive.php' method='post'>";
	echo "<input type='hidden' name='GroupID' value='".$_REQUEST["GroupID"]."'>";
	echo "<label>Thread Name:</label><input type='text' name='threadname' required><br>";
	echo "<label>Message:</label>";
	echo "<textarea name='message' rows='4' cols='50' required>";
	echo "<input type='submit' value='Create thread'>";






</html>
<?php
include("footer.php");
?>
