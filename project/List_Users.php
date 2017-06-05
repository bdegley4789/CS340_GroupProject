<?php
include("header.php");
include("side.php");
?>
<html>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <head>
    <title>List_Users</title>
    <h1>List Users</h1>
  </head>
</html>
<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_egleyb","oAvEBgaAcd1mbLOk","cs340_egleyb");
echo "<table class='user_data'><tr><th> UserName  <th> First Name <th>  Email </tr>";
if ($result = $mysqli->query("select user,first,last,email,pass,age from user_data")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->user)."</td>";
            echo "<td>".htmlspecialchars($obj->first)."</td>";
            echo "<td>".htmlspecialchars($obj->email)."</td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";
?>
<?php
include("footer.php");
?>
