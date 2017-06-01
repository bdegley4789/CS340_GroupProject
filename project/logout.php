<?php
include("header.php");
include("side.php");
?>

<?php
	session_destroy();
	session_unset();

	checkAuth(false);
	//header('Location: https://login.oregonstate.edu/cas/logout');
	if (isset($_SESSION['loggedin']) ) {
		unset($_SESSION['loggedin']);     // unset $_SESSION variable for the run-time
		$_SESSION['loggedin'] = "false";
		?>
		<h1>Logged out...</h1>
		<?php
	}
	//header('Location: https://login.oregonstate.edu/cas/logout');
?>

<meta http-equiv="refresh" content="0; url=https://login.oregonstate.edu/cas/logout" />
<?php include("_footer.php");?>
