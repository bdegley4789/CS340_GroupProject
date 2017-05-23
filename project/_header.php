<?php
session_start();
//if (session_start() == True){
//	echo "Session was successfully started";
//}


function checkAuth($doRedirect) {
	if (isset($_SESSION["onidid"]) && $_SESSION["onidid"] != "") return $_SESSION["onidid"];

	 $pageURL = 'http';
	 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
	 }

	$ticket = isset($_REQUEST["ticket"]) ? $_REQUEST["ticket"] : "";

	if ($ticket != "") {
		$url = "https://login.oregonstate.edu/cas/serviceValidate?ticket=".$ticket."&service=".$pageURL;
		$html = file_get_contents($url);
		$pattern = '/\\<cas\\:user\\>([a-zA-Z0-9]+)\\<\\/cas\\:user\\>/';
		preg_match($pattern, $html, $matches);
		if ($matches && count($matches) > 1) {
			$onidid = $matches[1];
			$_SESSION["onidid"] = $onidid;
			return $onidid;
		}
	} else if ($doRedirect) {
		$url = "https://login.oregonstate.edu/cas/login?service=".$pageURL;
		echo "<script>location.replace('" . $url . "');</script>";
	}
	return "";
}




?>

<html>


<head>
<title>TextBooks</title>
<link rel="stylesheet" type="text/css" href="style.css">


</head>
<body>


<nav>

	<li> <a href="intro.php">Home</a> </li>
	<li> <a href="index.php">Listings</a> </li>
	<li> <a href="add_course.php">Create Listing</a> </li>
	<li> <a href="login.php">Login</a> </li>
	<li> <a href="user_listings.php">Your Listings</a> </li>
	<li> <a href="user_interested.php">Interested In</a> </li>
	<li> <a href="theThirdWeb.html">Show DATA</a> </li>
</nav>

<!--function-->

<?php

function tablinter(){
	echo"Interested Table Test<br><br>";

	echo "<table class='interestedNew'><tr><th>Title</tr>";
	/*if $result = $mysqli->query("select title from interestedNew"){
		while($obj=$result->fetch_object()){
		echo "<td>".htmlspecialchars($obj->title)."</td>";

		}
	}
	$result->close();
	*/
	echo "</table>";


}

function getoutofhere(){
	//echo .htmlspecialchars(checkAuth(false)).;

}

?>

<div class="topright">
	<?php
		if(checkAuth(false)==""){
		?>
		<li><a href="login.php">Sign In</a></li>
		<?php
		}
		else{
			echo "<b>Current User:</b> ".htmlspecialchars(checkAuth(false))."";

			echo "<p>Throw link in here for logout<br>";
			?>
			<li><a href="logout.php">Logout</a></li>
			<?php
			tablinter();
		}
	?>
  <!--<p><b>Current User: ".htmlspecialchars(checkAuth(false)).</b></p>-->
</div>


<!--<iframe src="user_listings.php" width="400" height="400" align="right" margin-left="-120">
</iframe>-->
<main>



<?php
ini_set('display_errors', 'On');
define('WP_MEMORY_LIMIT', '64M');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","egleyb-db","wtkfdhdis","egleyb-db");
?>
