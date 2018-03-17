<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>FastRepairs</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

        <!-- JQuery CDN -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


        <!-- Link to stylesheet -->
        <link href="style.css" rel="stylesheet">
    </head>

    <body class="bg-light">

        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="http://students.engr.scu.edu/~mnaito/itemInputForm.html">FastRepair</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/machineStatus.php">Machine Status</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/Users/IvanLiang/FastRepairs/showRevenue.php">Show Revenue</a>
                </li>
                </ul>
            </div>
        </nav> 


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
		insertIntoRepairJobs($machineID,$contractID,$arrivalTime,$phoneNo,$empNo); insertIntoBill($machineID,$model,$firstName,$lastName,$phoneNo, $serviceContractType, $arrivalTime,$problemCode,$empNo,$price);
	}

}

function insertIntoCustomers($firstName, $lastName, $phoneNo, $email) {
	$conn=oci_connect('mnaito','Naalii10!','//dbserver.engr.scu.edu/db11g');
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
	$conn=oci_connect('mnaito','Naalii10!','//dbserver.engr.scu.edu/db11g');
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
	$conn=oci_connect('mnaito','Naalii10!','//dbserver.engr.scu.edu/db11g');
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

function insertIntoBill($machineID,$model,$firstName,$lastName,$phoneNo,$serviceContractType,$arrivalTime,$problemCode,$empNo,$price) {
    $conn=oci_connect('mnaito','Naalii10!','//dbserver.engr.scu.edu/db11g');
	if (!$conn) {
		print "<br> connection failed:";
		exit;
	}
	$query = oci_parse($conn, "INSERT INTO CustomerBill(machineID,model,custFirst,custLast,custPhoneNo, serviceContractType,arrivalTime,problemCode,repair_personID,partsUsedCost) VALUES (:machineID,:model,:firstName,:lastName,:phoneNo,:serviceContractType,CURRENT_TIMESTAMP,:problemCode,:empNo,:price)");

	oci_bind_by_name($query, ":machineID", $machineID);
    oci_bind_by_name($query, ":model", $model);
    oci_bind_by_name($query, ':firstName', $firstName);
	oci_bind_by_name($query, ':lastName', $lastName);
	oci_bind_by_name($query, ':phoneNo', $phoneNo);
    oci_bind_by_name($query, ':serviceContractType', $serviceContractType);
    oci_bind_by_name($query, ':problemCode', $problemCode);
	oci_bind_by_name($query, ":empNo", $empNo);
	oci_bind_by_name($query, ":price", $price);
    
	$res = oci_execute($query);
	if ($res)
		echo '<br><br> <p style="color:green;font-size:20px">Insert Bill: Data successfully inserted</p>';
	else{
		$e = oci_error($query); 
        	echo $e['message']; 
    }
    
    ocilogoff($conn);

}

?>
        
<footer class="my-5 pt-5 text-muted text-center text-small">
              <p class="mb-1">&copy; 2018 Gang Gang</p>
              <ul class="list-inline">
                <li class="list-inline-item"><a href="#">L</a></li>
                <li class="list-inline-item"><a href="#">O</a></li>
                <li class="list-inline-item"><a href="#">L</a></li>
              </ul>
        </footer>


        <!-- Bootstrap Javascript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

        <!-- <script src="bootstrap-formhelpers-phone.format.js"></script>
        <script src="bootstrap-formhelpers-phone.js"></script> -->

        <script src="calc.js"></script>

        <script>
          // Example starter JavaScript for disabling form submissions if there are invalid fields
          (function() {
            'use strict';

            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');

              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
        </script>
    </body>
</html>
