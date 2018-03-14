<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	//Customer Info
	$firstName= $_POST['firstName'];
	$lastName= $_POST['lastName'];
	$phoneNo= $_POST['phoneNo'];
	$email= $_POST['email'];

	//Repair Item Info
	$machineID= $_POST['machineID'];
	$model= $_POST['model'];
	$price= $_POST['price'];

	//More info
	$arrivalTime= $_POST['arrivalTime'];
	$timeOut= $_POST['timeOut'];
	$problemCodes= $_POST['problemCodes'];
	$empNo= $_POST['empNo'];
	$laborHours= $_POST['laborHours'];


	if ($valid) {
		echo "The form has been submitted."
	}

	function insertIntoCustomers($firstName, $lastName, $phoneNo, $email) {
		$conn=oci_connect('username','password','//dbserver.engr.scu.edu/db11g');
		if (!conn) {
			print "<br> connection failed:";
			exit;
		}
		$query = oci_parse($conn, "INSERT INTO Customers(firstName,lastName,phoneNo,email) VALUES(:firstName,:lastName,:phoneNo,:email)");

		oci_bind_by_name($query, ':firstName', $firstName);
		oci_bind_by_name($query, ':lastName', $lastName);
		oci_bind_by_name($query, ':phoneNo', $phoneNo);
		oci_bind_by_name($query, ':email', $email);

		$res = oci_execute($query);
	}

	function insertIntoRepairItems($machineID, $model, $price) {
		$conn=oci_connect('username','password','//dbserver.engr.scu.edu/db11g');
		if (!conn) {
			print "<br> connection failed:";
			exit;
		}
		$query = oci_parse($conn, "INSERT INTO RepairItems(machineID,model,price) VALUES(:machineID,:model,:price)");

		oci_bind_by_name($query, ':machineID', $machineID);
		oci_bind_by_name($query, ':model', $model);
		oci_bind_by_name($query, ':price', $price);

		$res = oci_execute($query);
	}

	function insertIntoBill($machineID,$model,$firstName,$lastName,$phoneNo,$arrivalTime,$timeOut,$problemCodes,$empNo,$laborHours) {

	}
}

?>