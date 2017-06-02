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
		$pattern4 = '/\\<cas\\:osuuid\\>([a-zA-Z0-9]+)\\<\\/cas\\:osuuid\\>/';
		preg_match($pattern, $html, $matches);
		if ($matches && count($matches) > 1) {
			$onidid = $matches[1];
			$_SESSION["onidid"] = $onidid;
			preg_match($pattern2, $html, $matches);
			$_SESSION["firstname"] = $matches[1];
			preg_match($pattern3, $html, $matches);
			$_SESSION["lastname"] = $matches[1];
			preg_match($pattern4, $html, $matches);
			$_SESSION["osuuid"] = $matches[1];
			return $onidid;
		}
	} else if ($doRedirect) {
		$url = "https://login.oregonstate.edu/cas/login?service=".$pageURL;
		echo "<script>location.replace('" . $url . "');</script>";
	}
	return "";
}
function getFirstName($doRedirect){
  if (isset($_SESSION["firstname"]) && $_SESSION["firstname"] != "") return $_SESSION["firstname"];

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
		$pattern = '/\\<cas\\:firstname\\>([a-zA-Z0-9]+)\\<\\/cas\\:firstname\\>/';
		echo $html;
		preg_match($pattern, $html, $matches);
		if ($matches && count($matches) > 1) {
			$firstname = $matches[1];
      $_SESSION["firstname"] = $firstname;
			return $firstname;
		}
	} else if ($doRedirect) {
		$url = "https://login.oregonstate.edu/cas/login?service=".$pageURL;
		echo "<script>location.replace('" . $url . "');</script>";
	}
	return "";
}

?>
