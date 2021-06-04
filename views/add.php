<?php

require '../database/connection.php';
require '../functions/validate.php';

if (isset($_POST['guest_name']) && isset($_POST['phone']) && isset($_POST['amount'])) {

	$guest_name = validateInput($_POST['guest_name']);
	$phone = validateInput($_POST['phone']);
	$amount = validateInput($_POST['amount']);

	if (!empty($guest_name) || !empty($phone) || !empty($amount)) {

		$guest_name = mysqli_real_escape_string($conn, $guest_name);
		$phone = mysqli_real_escape_string($conn, $phone);
		$amount = mysqli_real_escape_string($conn, $amount);

		$insert = "INSERT INTO `guests` ( `guest_name`, `phone`, `amount`) VALUES ('$guest_name', '$phone', '$amount')";
		if (!mysqli_query($conn, $insert)) {
			echo '<p>guest already contributed</p>';
		}
	}
}