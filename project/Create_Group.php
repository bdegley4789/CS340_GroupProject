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
    <title>Create Group</title>
	</head>
	<header class='main'>
    <h1>Create Group</h1>
	</header>
	<div class='main'>
    <form method="post" action='Group_recieve.php' class="inform">
      <ul>
				<input type="hidden" name="CourseID" value= <?php echo htmlspecialchars($_GET["CourseID"]); ?>required><br>
        <label>Name:</label> <input type="text" name="Name" required><br>
        <label>Size:</label> <input type="number" name="size" required><br>
        <input type=submit><br>
      </ul>
    </form>
  </div>
</html>
<?php
include("footer.php");
?>
