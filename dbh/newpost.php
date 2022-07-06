<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}

   /* if (!isset($_POST['des']) || !isset($_POST['image'])) {
    header('Location:../home.php');
    die();
}*/


include('dbdata.php');

$con = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

$target = 'images/' . basename($_FILES['image']['name']);
$from=$_FILES['image']['tmp_name'];

$email = $_SESSION['user'];
$description = $con->real_escape_string($_POST['des']);
$image = $_FILES['image']['name'];

$sql = "INSERT INTO masks(description,email,image) VALUES ('$description','$email','$image')";

$result = $con->query($sql);

move_uploaded_file($from, $target);

if ($result == TRUE) {
    header("Location:../home.php");
} else {
    header("Location:../home.php?failed");
}
$con->close();
?>