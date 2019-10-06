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
// connect to database
$conn = mysqli_connect('localhost', 'root', '', 'file-management');
mysqli_set_charset($conn,"utf8");
$tantargy = $_POST['tantargy'];
$sql = "SELECT * FROM files WHERE tantargy='$tantargy' ORDER BY evfolyam";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php
// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="styles.css">
  <title>Tananyag Letöltése</title>
</head>
<body>
<center>
<h1><?php echo $tantargy; ?></h1>
</center>
<button class="home"><a href="welcome.php">Kezdőlap</a></button>
<table>
<thead>
	<th>Évfolyam</th>
	<th>Cím</th>
	<th>Tartalom</th>
    <th>Méret</th>
    <th>Letöltések</th>
    <th>Művelet</th>
</thead>
<tbody>
  <?php foreach ($files as $file): ?>
    <tr>
	  <td><?php echo $file['evfolyam']; ?></td>
	  <td><?php echo $file['cim']; ?></td>
	  <td><?php echo $file['leiras']; ?></td>
      <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
      <td><?php echo $file['downloads']; ?></td>
      <td><a href="downloads.php?file_id=<?php echo $file['id'] ?>">Letöltés</a></td>
    </tr>
  <?php endforeach;?>

</tbody>
</table>

</body>
</html>