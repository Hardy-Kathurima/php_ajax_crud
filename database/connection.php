<?php

$conn = mysqli_connect('localhost', 'root', '', 'contribution');

if (!$conn) {
	die('cannot connect to the database');
}