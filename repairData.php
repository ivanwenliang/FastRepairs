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
	$machineID2= $_POST['machineID2'];
	$model2= $_POST['model2'];
	$price2= $_POST['price2'];
	$contractID= $_POST['contractID'];
	$empNo= $_POST['empNo'];

	//More info
	$arrivalTime= "CURRENT_TIMESTAMP";
	$problemCode= $_POST['problemCode'];
	$problemCode2= $_POST['problemCode2'];

	if (isset($_POST['submitForm'])) {
		insertIntoCustomers($firstName,$lastName,$phoneNo,$email);
		insertIntoRepairItems($machineId,$model,$price,$problemCode,$MachineID2,$model2,$price2,$problemCode2);
		insertIntoRepairJobs($machineID,$machineID2,$contractID,$arrivalTime,$phoneNo,$empNo);
	}

}

function insertIntoCustomers($firstName, $lastName, $phoneNo, $email) {
	$conn=oci_connect('iliang','Guld123098!','//dbserver.engr.scu.edu/db11g');
	if (!conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn, "INSERT INTO Customers(firstName,lastName,phoneNo,custEmail) VALUES(:firstName,:lastName,:phoneNo,:email)");

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
function insertIntoRepairItems($machineID, $model, $price, $problemCode, $machineID2, $model2, $price2, $problemCode2) {
	$conn=oci_connect('iliang','Guld123098!','//dbserver.engr.scu.edu/db11g');
	if (!conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn, "INSERT INTO RepairItems(machineID,model,price,problemCode) VALUES(:machineID,:model,:price,:problemCode)");

	oci_bind_by_name($query, ':machineID', $machineID);
	oci_bind_by_name($query, ':model', $model);
	oci_bind_by_name($query, ':price', $price);
	oci_bind_by_name($query, ':problemCode', $problemCode);

	$res = oci_execute($query);
	if ($res)
		echo '<br><br> <p style="color:green;font-size:20px">Data successfully inserted</p>';
	else{
		$e = oci_error($query); 
        	echo $e['message']; 
    }

	if ($machineID2 != '' && $model2 != '' && $price2 != '') {
		$query2 = oci_parse($conn, "INSERT INTO RepairItems(machineID,model,price,problemCode) VALUES(:machineID2,:model2,:price2,:problemCode2)");

		oci_bind_by_name($query2, ':machineID2', $machineID2);
		oci_bind_by_name($query2, ':model2', $model2);
		oci_bind_by_name($query2, ':price2', $price2);
		oci_bind_by_name($query2, ':problemCode2', $problemCode2);

		$res2 = oci_execute($query2);
		if ($res2)
			echo '<br><br> <p style="color:green;font-size:20px">Data successfully inserted</p>';
		else{
			$e = oci_error($query2); 
	        	echo $e['message']; 
	    }
	    ocilogoff($conn);
	}
}

//insert default under repair status
function insertIntoRepairJobs($machineID,$machineID2,$contractID,$arrivalTime,$phoneNo,$empNo) {
	$conn=oci_connect('iliang','Guld123098!','//dbserver.engr.scu.edu/db11g');
	if (!conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn, "INSERT INTO RepairJob(machineID,machineID2,contractID,arrivalTime,custPhoneNo,jobstat,employeeNo) VALUES (:machineID,:machineID2,:contractID,CURRENT_TIMESTAMP,:phoneNo,'UNDER_REPAIR',:empNo)");

	oci_bind_by_name($query, ":machineID", $machineID);
	oci_bind_by_name($query, ":machineID2", $machineID2);
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