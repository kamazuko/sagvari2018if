<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<?php
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'file-management');
mysqli_set_charset($conn,"utf8");

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
	$cim = $_POST['cim'];
	$evfolyam = $_POST['evfolyam'];
	$tantargy = $_POST['tantargy'];
	$leiras = $_POST['leiras'];

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "Csak .zip, .pdf vagy .docx formátumú fájlok engedélyezettek";
    } elseif ($_FILES['myfile']['size'] > 1000000000) { // file shouldn't be larger than 1Megabyte
        echo "Túl nagy fájl!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO files (name, size, downloads, cim, evfolyam, tantargy, leiras) VALUES ('$filename', $size, 0, '$cim', '$evfolyam', '$tantargy', '$leiras')";
            if (mysqli_query($conn, $sql)) {
                echo "Fájl sikeresen feltöltve!";
            }
        } else {
            echo "Sikertelen feltöltés!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="styles.css">
    <title>Tananyag Feltöltése</title>
  </head>
  <body>
  <button class="home"><a href="welcome.php">Kezdőlap</a></button>
    <div class="container">
      <div class="row">
        <form action="upload.php" method="post" enctype="multipart/form-data" >
          <h3>Fájl feltöltése</h3>
          <input type="file" name="myfile"> <br>
		  <select name='evfolyam'><br>
		<option value="9.">9</option>
		<option value="10.">10</option>
		<option value="11.">11</option>
		<option value="12.">12</option>
	  </select><br>
	  <select name='tantargy'><br>
		<option value="Történelem">Történelem</option>
		<option value="Matematika">Matematika</option>
		<option value="Fizika">Fizika</option>
	  </select><br>
	  <input type='text' name='cim' placeholder='cím' /><br>
	  <input type='text' name='leiras' placeholder='leiras' /><br>
          <button type="submit" name="save">upload</button>
        </form>
      </div>
    </div>
  </body>
</html>