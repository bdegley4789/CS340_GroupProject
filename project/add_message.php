<?php
include("header.php");
include("side.php");
?>
<?php
	checkAuth(true)
?>
<h1>New Message</h1>

<form method="post" action='index.php' class="inform">
<ul>
	<label>Message:</label>
	<textarea rows="4" cols="50" required>
	</textarea>
	<input type=submit>
</ul>
</form>
<?php
include("footer.php");
?>
