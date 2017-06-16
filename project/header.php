<html>
  <link rel="stylesheet" type="text/css" href="style.css">
  <header class='header'>
     <h1>Group Finder</h1>
     <h3>CS340 Group Project by Bryce Egley, Alessandro Lim, Haoxiang Yang</h3>
  </header>
</html>

<?php
include("static/php/_db_header.php");
session_start();
//if (session_start() == True){
//	echo "Session was successfully started";
//}

function add_to_database() {
	$id = $_SESSION['onidid'];
	$fn = $db->escape_string($_SESSION['firstname']);
	$ln = $db->escape_string($_SESSION['lastname']);
	$data = $db->query("SELECT ONID FROM Students WHERE Students.ONID = '$id'");
	if($data->num_rows == 0) {
		$result = $db->query("INSERT INTO Students(firstName, lastName, ONID) VALUES('$fn', '$ln', '$id')");
		if(!$result) {
			echo $db->error;
		}
	}
}

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
		$pattern2 = '/\\<cas\\:firstname\\>([a-zA-Z0-9]+)\\<\\/cas\\:firstname\\>/';
		$pattern3 = '/\\<cas\\:lastname\\>([a-zA-Z0-9]+)\\<\\/cas\\:lastname\\>/';
		preg_match($pattern, $html, $matches);
		if ($matches && count($matches) > 1) {
			$onidid = $matches[1];
			$_SESSION["onidid"] = $onidid;
			preg_match($pattern2, $html, $matches);
			$_SESSION["firstname"] = $matches[1];
			preg_match($pattern3, $html, $matches);
			$_SESSION["lastname"] = $matches[1];
			$_SESSION["is_student"] = 1;
			add_to_database();
			return $onidid;
		}
	} else if ($doRedirect) {
		$url = "https://login.oregonstate.edu/cas/login?service=".$pageURL;
		echo "<script>location.replace('" . $url . "');</script>";
	}
	return "";
}
include("static/php/_db_footer.php");
?>
