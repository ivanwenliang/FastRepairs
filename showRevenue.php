<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Customer Bill</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

		<!-- JQuery CDN -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Link to stylesheet -->
		<link href="style.css" rel="stylesheet">
	</head>

	<body class="bg-light">

		<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="/Users/IvanLiang/FastRepairs/itemInputForm.html">FastRepair</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/itemInputForm.html">Home </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/machineStatus.php">Machine Status</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/revenue.php">Show Revenue<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/showJobs.php">Show Repair Jobs</a>
                </li>
                </ul>
            </div>
        </nav> 
        
		<div class="container resize">
			<div class="py-5 text-center">
                <h2>Revenue</h2>
                <p class="lead">Easy Data Management for Employees</p>
            </div>
        
        <div>
            
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$startdate= $_POST['startdate'];
				$enddate= $_POST['enddate'];
                //$startdate = date('d-m-y', strtotime($begin));
                //$enddate = date('d-m-y', strtotime($end));
                
//				$revenueDate= date('Y-m-d');
//				$revenueDate= date('Y-m-d', strtotime($revenueDate));
            }
            
            if (isset($_POST['submitForm'])) {
                showRevenue($startdate,$enddate);
                //showActual($startdate,$enddate);
            }


            function showRevenue($startdate,$enddate){
                $conn=oci_connect('mnaito', 'Naalii10!', '//dbserver.engr.scu.edu/db11g');
                    if(!$conn) {
                         print "<br> connection failed:";
                        exit;
                    }
                    $query = oci_parse($conn, "SELECT SUM(totalCost) FROM CustomerBill WHERE timeOut >= TO_DATE(:startdate, 'DD-MON-RR') AND timeOut <= TO_DATE(:enddate, 'DD-MON-RR')");
                   oci_bind_by_name($query, ':startdate', $startdate);
	               oci_bind_by_name($query, ':enddate', $enddate);
                   
                    // Execute the query
                    oci_execute($query);
                    ?>
                        
                        
                    <table class="table table-hover">
                    <thead>
                        <tr>
<!--                            <th style="width: 10%">#</th>-->
                            <th style="width: 35%">Start Date</th>
                            <th style="width: 35%">End Date</th>
                            <th style="width: 30%">Possible Revenue</th>
                            <!-- <th style="width: 10%">Time Out</th>
                            <th style="width: 10%">Labor Hours</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php
                    while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {
                        echo "<tr>";
                        echo "<td>".$startdate."</td>";  //machineID
                        echo "<td>".$enddate."</td>";  //model
                        echo "<td>"."$".$row[0]."</td>";  //price
                        echo "</tr>";
                    }

                OCIFreeStatement($query);
                OCILogoff($conn);
                // END PHP
                
            }
            ?>
                        
            </tbody></table>
                        
            
            </div>

        
        <div>
            
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$startdate= $_POST['startdate'];
				$enddate= $_POST['enddate'];
                //$startdate = date('d-m-y', strtotime($begin));
                //$enddate = date('d-m-y', strtotime($end));
                
//				$revenueDate= date('Y-m-d');
//				$revenueDate= date('Y-m-d', strtotime($revenueDate));
            }
            
            if (isset($_POST['submitForm'])) {
                showActual($startdate,$enddate);
            }    
            
            function showActual($startdate,$enddate){
                $conn=oci_connect('mnaito', 'Naalii10!', '//dbserver.engr.scu.edu/db11g');
                    if(!$conn) {
                         print "<br> connection failed:";
                        exit;
                    }
                    $query = oci_parse($conn, "SELECT SUM(totalCost), serviceContractType FROM CustomerBill WHERE timeOut >= TO_DATE(:startdate, 'DD-MON-RR') AND timeOut <= TO_DATE(:enddate, 'DD-MON-RR') GROUP BY serviceContractType HAVING serviceContractType = 'NONE'");
                   oci_bind_by_name($query, ':startdate', $startdate);
	               oci_bind_by_name($query, ':enddate', $enddate);
                   
                    // Execute the query
                    oci_execute($query);
                    ?>
                        
                        
                    <table class="table table-hover">
                    <thead>
                        <tr>
<!--                            <th style="width: 10%">#</th>-->
                            <th style="width: 35%">Start Date</th>
                            <th style="width: 35%">End Date</th>
                            <th style="width: 30%">Actual Revenue</th>
                            <!-- <th style="width: 10%">Time Out</th>
                            <th style="width: 10%">Labor Hours</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php
                    while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {
                        echo "<tr>";
                        echo "<td>".$startdate."</td>";  //machineID
                        echo "<td>".$enddate."</td>";  //model
                        echo "<td>"."$".$row[0]."</td>";  //price
                        echo "</tr>";
                    }

                OCIFreeStatement($query);
                OCILogoff($conn);
                // END PHP
            }
            
                ?>
                        
            </tbody></table>
                        

        </div>
            
        </div>
            
            
            
		<!-- Bootstrap Javascript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

        <script src="bootstrap-formhelpers-phone.format.js"></script>
        <script src="bootstrap-formhelpers-phone.js"></script>

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

