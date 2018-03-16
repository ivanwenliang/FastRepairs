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
	$contractID= $_POST['contractID'];
	$empNo= $_POST['empNo'];
	$serviceContractType= $_POST['serviceContractType'];

	//More info
	$arrivalTime= "CURRENT_TIMESTAMP";
	$problemCode= $_POST['problemCode'];

	if (isset($_POST['submitForm'])) {
		insertIntoCustomers($firstName,$lastName,$phoneNo,$email);
		insertIntoRepairItems($machineID,$model,$price,$phoneNo,$problemCode,$serviceContractType,$contractID);
		insertIntoRepairJobs($machineID,$contractID,$arrivalTime,$phoneNo,$empNo);
	}

}

function insertIntoCustomers($firstName, $lastName, $phoneNo, $email) {
	$conn=oci_connect('iliang','Guld123098!','//dbserver.engr.scu.edu/db11g');
	if (!$conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn, "INSERT INTO Customers(custFirst,custLast,custPhoneNo,custEmail) VALUES(:firstName,:lastName,:phoneNo,:email)");

	oci_bind_by_name($query, ':firstName', $firstName);
	oci_bind_by_name($query, ':lastName', $lastName);
	oci_bind_by_name($query, ':phoneNo', $phoneNo);
	oci_bind_by_name($query, ':email', $email);

	$res = oci_execute($query);
	if ($res)
		echo '<br><br> <p style="color:green;font-size:20px">Data successfully inserted</p>';
	else{
		$e = oci_error($query); 
        	echo $e['message']; 
    }
    ocilogoff($conn);
}


//add service contract type
function insertIntoRepairItems($machineID, $model, $price, $phoneNo, $problemCode,$serviceContractType,$contractID) {
	$conn=oci_connect('iliang','Guld123098!','//dbserver.engr.scu.edu/db11g');
	if (!$conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn, "INSERT INTO RepairItems(machineID,model,price,custPhoneNo,problemCode,serviceContractType,contractID) VALUES(:machineID,:model,:price,:phoneNo,:problemCode,:serviceContractType,:contractID)");

	oci_bind_by_name($query, ':machineID', $machineID);
	oci_bind_by_name($query, ':model', $model);
	oci_bind_by_name($query, ':price', $price);
	oci_bind_by_name($query, ':problemCode', $problemCode);
	oci_bind_by_name($query, ':serviceContractType', $serviceContractType);
	oci_bind_by_name($query, ':contractID', $contractID);
	oci_bind_by_name($query, ':phoneNo', $phoneNo);


	$res = oci_execute($query);
	if ($res)
		echo '<br><br> <p style="color:green;font-size:20px">Data successfully inserted</p>';
	else{
		$e = oci_error($query); 
        	echo $e['message']; 
    }
    ocilogoff($conn);

}

//insert default under repair status
function insertIntoRepairJobs($machineID,$contractID,$arrivalTime,$phoneNo,$empNo) {
	$conn=oci_connect('iliang','Guld123098!','//dbserver.engr.scu.edu/db11g');
	if (!$conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn, "INSERT INTO RepairJob(machineID,contractID,arrivalTime,custPhoneNo,employeeNo) VALUES (:machineID,:contractID,CURRENT_TIMESTAMP,:phoneNo,:empNo)");

	oci_bind_by_name($query, ":machineID", $machineID);
	oci_bind_by_name($query, ":contractID", $contractID);
	//oci_bind_by_name($query, ":arrivalTime", $arrivalTime);
	oci_bind_by_name($query, ":phoneNo", $phoneNo);
	oci_bind_by_name($query, ":empNo", $empNo);
	
	$res = oci_execute($query);
	if ($res)
		echo '<br><br> <p style="color:green;font-size:20px">Data successfully inserted</p>';
	else{
		$e = oci_error($query); 
        	echo $e['message']; 
    }
    ocilogoff($conn);
}


	//function insertIntoProblemReport()

	// function insertIntoBill($machineID,$model,$firstName,$lastName,$phoneNo,$arrivalTime,$timeOut,$problemCode,$repair_personID,$laborHours) {

	// }

?>