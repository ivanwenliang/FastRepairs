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
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/machineStatus.php">Machine Status</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/revenue.php">Show Revenue</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/showJobs.php">Show Repair Jobs</a>
                </li>
                </ul>
            </div>
        </nav> 

		<div class="container bill">
			<div class="py-5 text-center">
                <h2>Customer Bill</h2>
                <p class="lead">Easy Data Management for Employees</p>
            </div>

            <div class="row">
               	<div class="card">
            		<div class="card-block">
        				<?php
        				if ($_SERVER["REQUEST_METHOD"] == "POST") {
        					$machineID= $_POST['machineID'];

        					if (isset($_POST['submitForm'])) {
        						showBill($machineID);
        					}
        				}

        				function showBill($machineID) {
    					    //connect to your database
    						$conn=oci_connect('mnaito','Naalii10!', '//dbserver.engr.scu.edu/db11g');
    						if(!$conn) {
    						     print "<br> connection failed:";       
    					        exit;
    						}
    						//$queryString = ;
    						$query = oci_parse($conn, "SELECT * FROM CustomerBill WHERE machineID=:machineID");
    					    // $res =
    						
    						oci_execute($query);
    						$cols = OCINumCols($query);    					        
        					    
    					    OCILogoff($conn);
        				}
        			    
        				
        				?>

		                    <table class="table table-hover">
			                    <thead>
			                        <tr>
			<!--                            <th style="width: 10%">#</th>-->
			                            <th style="width: 10%">Machine ID</th>
			                            <th style="width: 20%">Model</th>
			                            <th style="width: ">First Name</th>
			                            <th style="width: ">Last Name</th>
			                            <th style="width: 10%">Customer Phone</th>
			                            <th style="width: ">Arrival Time</th>
			                            <th style="width: ">Time Out</th>
			                            <th style="width: 20%">Problem</th>
			                            <th style="width: ">Employee Number</th>
			                            <th style="width: ">Labour Hours</th>
			                            <th style="width: 10%">Parts Price</th>
			                            <th style="width: ">Total Cost</th>
			                           
			                            <!-- <th style="width: 10%">Time Out</th>
			                            <th style="width: 10%">Labor Hours</th> -->
			                        </tr>
			                    </thead>
			                    <tbody>
				                    <?php

				                    while (($row = oci_fetch_array($query)) != false) {
				                        echo "<tr>";
				                        //for ($i = 1; $i < $cols + 1; $i ++){
				                            //$val = OCIResult($query, $i);
				                            //echo "<td>&nbsp;$val&nbsp;</td>";
				                        echo "<td>".$row[0]."</td>";  //machineID
				                        echo "<td>".$row[1]."</td>";  //model
				                        echo "<td>".$row[2]."</td>";  //custFirst
				                        echo "<td>".$row[3]."</td>";  //custLast
				                        echo "<td>".$row[4]."</td>";  //custPhoneNo
				                        echo "<td>".$row[5]."</td>";  //arrivalTime
				                        echo "<td>".$row[6]."</td>";  //timeOut
				                        echo "<td>".$row[7]."</td>";  //problemCode
				                        echo "<td>".$row[8]."</td>";  //empNo
				                        echo "<td>".$row[9]."</td>";  //laborHours
				                        echo "<td>".$row[10]."</td>";  //partsPrice
				                        echo "<td>".$row[11]."</td>";  //totalPrice
				                    				 
				                        echo "</tr>";
				                    }

					                OCIFreeStatement($query);
					                OCILogoff($conn);
					                // END PHP
					                ?>
		                        
		                        </tbody>
		                    </table>

            		</div>
            	</div>
            </div>

			
		</div>

		<!-- Bootstrap Javascript -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

		<script src="bootstrap-formhelpers-phone.format.js"></script>
		<script src="bootstrap-formhelpers-phone.js"></script>

	</body>
</html>