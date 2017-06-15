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
    <title>Create Group</title>
    <h1>Create Group</h1>
    <form method="post" action='Class_recieve.php' class="inform">
      <ul>
				<input type="hidden" name="CourseID" value= <?php echo htmlspecialchars($_GET["CourseID"]); ?>required><br>
        <label>Name:</label> <input type="text" name="name" required><br>
        <label>Size:</label> <input type="number" name="size" required><br>
        <input type=submit><br>
      </ul>
    </form>
  </head>
</html>
<?php
include("footer.php");
?>
