<?php
	$db_host = "classmysql.engr.oregonstate.edu";
	$db_user = "cs340_alessanf";
	$db_pw = "vhwfz4pPVJe4rssw";
	$db_name = "cs340_alessanf";
	$db = new mysqli($db_host, $db_user, $db_pw, $db_name);
	if($db->connect_errno) {
		printf("Connection failed: %s\n", $db->connect_error);
	}
?>