<?php
include("header.php");
include("side.php");
?>
<html>
    <h3>Saving submission...</h3>
</html>
<?php
  $mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_egleyb","oAvEBgaAcd1mbLOk","cs340_egleyb");
  if ($stmt = $mysqli->prepare("insert into user_data(user,first,last,email,pass,age) values(?,?,?,?,?,?)")) {

      $user = $_REQUEST["user"];
      $first = $_REQUEST["first"];
      $last = $_REQUEST["last"];
      $email = $_REQUEST["email"];
      $pass = $_REQUEST["pass"];
      $age = $_REQUEST["age"];

      /* for five params, pass five character types to bind_param with five values */
      $stmt->bind_param("sssssi", $user, $first, $last, $email, $pass, $age);
      $stmt->execute();

    $stmt->close();
  } else {
    printf("Error: %s\n", $mysqli->error);
  }
?>

<h3>View results...<li><a href="http://web.engr.oregonstate.edu/~egleyb/cs340/CS340_GroupProject/project/List_Users.php">List Users</a></li></h3>

<?php include("footer.php");?>
