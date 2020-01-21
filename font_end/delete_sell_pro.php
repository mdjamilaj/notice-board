<?php


$link = mysqli_connect("localhost", "root", "", "adminlte");

$id =  base64_decode($_GET['id']);

mysqli_query($link, "DELETE FROM `sell` WHERE `product_id` = '$id'");



header('Location: sell.php');

?>