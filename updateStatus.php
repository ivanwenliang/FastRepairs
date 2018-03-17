<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$machineID= $_POST['machineID'];
	$jobstat= $_POST['jobstat'];
	$timeOut= $_POST['timeOut'];
	$laborHours= $_POST['laborHours'];

	if (isset($_POST['submitForm'])) {
		updateRepairItems($machineID,$jobstat);
		insertHoursTime($machineID,$timeOut,$laborHours);
        
        if($jobstat == 'DONE'){
            insertTotalCost($machineID,$laborHours);
        }
	}
    

}

function insertTotalCost($machineID,$laborHours){
    	$conn=oci_connect('mnaito','Naalii10!','//dbserver.engr.scu.edu/db11g');
	if (!$conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn,"UPDATE CustomerBill SET totalCost= (totalCost + 50 + :laborHours * 20 + partsUsedCost) WHERE machineID=:machineID AND serviceContractType='NONE'"); 
    
//    AND serviceContractType='NONE' ");

	oci_bind_by_name($query, ':machineID', $machineID);
	oci_bind_by_name($query, ':laborHours', $laborHours);
	
	$res = oci_execute($query);
	if ($res)
		echo '<br><br> <p style="color:green;font-size:20px">Total Cost: Data successfully inserted</p>';
	else{
		$e = oci_error($query); 
        	echo $e['message']; 
    }
	ocilogoff($conn);
    
}


function updateRepairItems($machineID,$jobstat) {
	$conn=oci_connect('mnaito','Naalii10!','//dbserver.engr.scu.edu/db11g');
	if (!$conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn,"UPDATE RepairJob SET jobstat=:jobstat WHERE machineID=:machineID");

	oci_bind_by_name($query, ':jobstat', $jobstat);
	oci_bind_by_name($query, ':machineID', $machineID);

	$res = oci_execute($query);
	if ($res)
		echo '<br><br> <p style="color:green;font-size:20px">Data successfully inserted</p>';
	else{
		$e = oci_error($query); 
        	echo $e['message']; 
    }
	ocilogoff($conn);
}

function insertHoursTime($machineID,$timeOut,$laborHours) {
	$conn=oci_connect('mnaito','Naalii10!','//dbserver.engr.scu.edu/db11g');
	if (!$conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn,"UPDATE CustomerBill SET timeOut=:timeOut, laborHours=:laborHours WHERE machineID=:machineID");

	oci_bind_by_name($query, ':machineID', $machineID);
	oci_bind_by_name($query, ':timeOut', $timeOut);
	oci_bind_by_name($query, ':laborHours', $laborHours);
	
	$res = oci_execute($query);
	if ($res)
		echo '<br><br> <p style="color:green;font-size:20px">Data successfully inserted</p>';
	else{
		$e = oci_error($query); 
        	echo $e['message']; 
    }
	ocilogoff($conn);
}
?>