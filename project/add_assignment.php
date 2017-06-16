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
    <title>Create Assignment</title>
    <h1>Create Assignment</h1>

    <form method="post" action='Assignment_recieve.php' class="inform">
      <ul>
				<input type="hidden" name="CourseID" value= <?php echo "'".htmlspecialchars($_GET['CourseID'])."'"; ?>required><br>
				<input type="hidden" name="subject" value= <?php echo "'".htmlspecialchars($_GET['subject'])."'"; ?>required><br>
        <label>Name:</label> <input type="text" name="Name" required><br>
        <label>Description:</label> <textarea name='Description' rows='4' cols='50' required></textarea><br>
				<label>Due Date:</label> <input type="date" name="DueDate" required><br>
        <input type=submit><br>
      </ul>
    </form>

  </head>
</html>

<?php
include("footer.php");
?>
