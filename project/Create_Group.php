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

    <form method="post" action='class_recieve.php' class="inform">
      <ul>
        <label>CourseID:</label> <input type="text" name="CourseID" required><br>
        <label>Subject:</label> <input type="text" name="Subject" required><br>
        <label>time:</label> <input type="text" name="time" required><br>
        <label>location:</label> <input type="text" name="location" required><br>
        <input type=submit><br>
      </ul>
    </form>

  </head>
</html>
<?php
include("footer.php");
?>
