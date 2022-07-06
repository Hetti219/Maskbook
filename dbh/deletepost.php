<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
}

if(!isset($_POST['id'])){
    header('Location:../myposts.php');
    die();
}


$id=$_POST['id'];



include('dbdata.php');

$con=new mysqli($dbservername,$dbusername,$dbpassword,$dbname);

$email=$_SESSION['user'];



$sql = "DELETE FROM masks WHERE id=$id";

$result = $con->query($sql);

if ($result == TRUE) {
    header("Location:../myposts.php");
} else {
    header("Location:../myposts.php?failed");
}
$con->close();
?>