<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kezdőlap</title>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Üdvözöllek: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
    </div>
    <p>
		<button class="home"><a href="upload.php">Feltöltés</a></button>
		<button class="home"><a href="reset-password.php">Jelszó megváltoztatása</a></button>
		<button class="home"><a href="logout.php">Kijelentkezés</a></button>
	</p>
	<p>
		<h1>Válassz tantárgyat:</h1>
		<form method="POST" action="downloads.php" enctype="multipart/form-data">
		<select name="tantargy">
		<option value="Történelem">Történelem</option>
		<option value="Matematika">Matematika</option>
		<option value="Fizika">Fizika</option>
		</select>
		<br>
		<input type="submit" name="uploadBtn" value="Kiválasztás"></input>
    </p>
	<div id="calendar"></div>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
</body>
</html>