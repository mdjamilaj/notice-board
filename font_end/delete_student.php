<?php


$link = mysqli_connect("localhost", "root", "", "adminlte");

$id =  base64_decode($_GET['id']);

mysqli_query($link, "DELETE FROM student_info WHERE id = '$id'");

header('Location: main.php');

?>