<?php
$mysqli = new mysqli("classmysql.engr.oregonstate.edu","cs340_egleyb","oAvEBgaAcd1mbLOk","cs340_egleyb");

!$mysqli->query("drop table user_data");
if (!$mysqli->query("create table user_data(user varchar(40), first varchar(40), last varchar(40), email varchar(40), pass varchar(40), age int(150))")
 ) {
    printf("Cannot create table(s).\n");
}

$mysqli->query("insert into user_data(user,first,last,email,pass,age) values('toms54','Tom','Smith','tomsmith@gmail.com','passord',41)");
$mysqli->query("insert into user_data(user,first,last,email,pass,age) values('007','James','Bond','jamesbond007@gmail.com','secret',32)");

echo "<table>";
if ($result = $mysqli->query("select user,first,last,email,pass,age from user_data")) {
    while($obj = $result->fetch_object()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($obj->user)."</td>";
            echo "<td>".htmlspecialchars($obj->first)."</td>";
            echo "<td>".htmlspecialchars($obj->last)."</td>";
            echo "<td>".htmlspecialchars($obj->email)."</td>";
            echo "<td>".htmlspecialchars($obj->pass)."</td>";
            echo "<td>".htmlspecialchars($obj->age)."</td>";
            echo "</tr>";
    }

    $result->close();
}
echo "</table>";


$mysqli->close();
?>
