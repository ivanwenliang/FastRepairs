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
                    <a class="nav-link" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/Users/IvanLiang/FastRepairs/machineStatus.html">Machine Status</a>
                  </li>
                  <li class="nav-item active">
                  	<a class="nav-link" href="#">Show Revenue <span class="sr-only">(current)</span></a>
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
				$begin= $_POST['startdate'];
				$end= $_POST['enddate'];
                $startdate = date('d-m-Y', $begin);
                $enddate = date('d-m-Y', $end);
//				$revenueDate= date('Y-m-d');
//				$revenueDate= date('Y-m-d', strtotime($revenueDate));
            }
            
            if (isset($_POST['submitForm'])) {
                showRevenue($startdate,$enddate);
            }


            function showRevenue($startdate,$enddate){
                $conn=oci_connect('mnaito', 'Naalii10!', '//dbserver.engr.scu.edu/db11g');
                    if(!$conn) {
                         print "<br> connection failed:";
                        exit;
                    }
                    $query = oci_parse($conn, "SELECT SUM(price) FROM CustomerBill WHERE jobstat > :startdate AND jobstat < :enddate ");
                
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
                            <th style="width: 30%">Revenue</th>
                            <!-- <th style="width: 10%">Time Out</th>
                            <th style="width: 10%">Labor Hours</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php
                    while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {
                        echo "<tr>";
                        //for ($i = 1; $i < $cols + 1; $i ++){
                            //$val = OCIResult($query, $i);
                            //echo "<td>&nbsp;$val&nbsp;</td>";
                        echo "<td>".$startdate."</td>";  //machineID
                        echo "<td>".$enddate."</td>";  //model
                        echo "<td>"."$".$row[0]."</td>";  //price
//                        echo "<td>".$row[3]."</td>";  //custPhone
//                        echo "<td>".$row[4]."</td>";  //prob
//                        echo "<td>".$row[5]."</td>";  //contract
//                        if(empty ($row[6])) echo"<td>  </td>"; 
//                        else echo "<td>".$row[6]."</td>";  //cont ID
//                        echo "<td>".$row[11]."</td>";  //status
                        
                        
                        //echo "<td>".$row[7]."</td>";  //
                        // echo "<td><input type=\"text\" class=\"form-control resize\" id=\"timeOut\" name=\"timeOut\" placeholder=\"00:00\"></td>";
                        // echo "<td><input type=\"text\" class=\"form-control resize\" id=\"laborHours\" name=\"laborHours\" placeholder=\"0\"></td>";
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

