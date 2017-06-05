<?php
include("header.php");
include("side.php");
?>
<html>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <head>
    <title>Sign-Up</title>
    <h1>Sign-Up</h1>

    <form method="post" action='user_recieve.php' class="inform">
      <ul>
        <label>Username:</label> <input type="text" name="user" required><br>
        <label>First Name:</label> <input type="text" name="first" required><br>
        <label>Last Name:</label> <input type="text" name="last" required><br>
        <label>Email Address:</label> <input type="text" name="email" required><br>
        <label>Password:</label> <input type="password" name="pass" required><br>
        <label>Age:</label> <input type="number" name="age" optional><br>
        <input type=submit><br>
      </ul>
    </form>

  </head>
</html>
<?php
include("footer.php");
?>
