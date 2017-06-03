<html>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <header>
     <h1>CS340 Group Project by Bryce Egley, Alessandro Lim, Haoxiang Yang</h1>
  </header>
</html>

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
		$pattern2 = '/\\<cas\\:firstname\\>([a-zA-Z0-9]+)\\<\\/cas\\:firstname\\>/';
		$pattern3 = '/\\<cas\\:lastname\\>([a-zA-Z0-9]+)\\<\\/cas\\:lastname\\>/';
		preg_match($pattern, $html, $matches);
		if ($matches && count($matches) > 1) {
			$onidid = $matches[1];
			$_SESSION["onidid"] = $onidid;
			preg_match($pattern2, $html, $matches);
			$_SESSION["firstname"] = $matches[1];
			$fn = $matches[1];
			preg_match($pattern3, $html, $matches);
			$_SESSION["lastname"] = $matches[1];
			$ln = $matches[1];
			$_SESSION["is_student"] = 1;
			$db_host = "classmysql.engr.oregonstate.edu";
			$db_user = "cs340_alessanf";
			$db_pw = "vhwfz4pPVJe4rssw";
			$db_name = "cs340_alessanf";
			$db = new mysqli($db_host, $db_user, $db_pw, $db_name);
			$data = $db->query("SELECT ONID FROM Students WHERE Students.ONID = '$onidid'");
			if($data->num_rows == 0) {
				$result = $db->query("INSERT INTO Students(firstName, lastName, ONID) VALUES('$fn', '$ln', '$onidid')");
				if(!$result) {
					echo $db->error;
				}
			}
			$db->close($db);
			return $onidid;
		}
	} else if ($doRedirect) {
		$url = "https://login.oregonstate.edu/cas/login?service=".$pageURL;
		echo "<script>location.replace('" . $url . "');</script>";
	}
	return "";
}
?>
