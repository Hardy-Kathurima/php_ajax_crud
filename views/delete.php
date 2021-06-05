<?php
require '../database/connection.php';

$id = htmlspecialchars($_GET['id']);
echo $id;

$delete = "DELETE FROM guests WHERE id = $id ";

if (mysqli_query($conn, $delete)) {
	header("Location:../index.php");
}