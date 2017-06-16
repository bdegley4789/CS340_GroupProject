<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="style.css">
    <title>Create thread</title>
	</head>
	<header class='main'>
		<h1>Create a new thread </h1>
	</header>
<div class='main'>

<?php
	echo "<form action='threadReceive.php' method='post'>";
	echo "<input type='hidden' name='GroupID' value='".$_REQUEST["GroupID"]."'>";
	echo "<label>Thread Name:</label><input type='text' name='threadname' required><br>";
	echo "<label>Message:</label>";
	echo "<textarea name='message' rows='4' cols='50' required>";
	echo "<input type='submit' value='Create thread'>";





?>
</div>
</html>
<?php
include("footer.php");
?>
