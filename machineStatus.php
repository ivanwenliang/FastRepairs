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
                  <li class="nav-item">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/itemInputForm.html">Home</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/machineStatus.php">Machine Status <span class="sr-only">(current)</span></a>
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

		<div class="container resize">
			<div class="py-5 text-center">
                <h2>Machine Status</h2>
                <p class="lead">Easy Data Management for Employees</p>
            </div>

            

            
            
            <div class="row">
               	<div class="card">
            		<div class="card-block">
                        
                    <?php
//                    if (isset($_GET['show'])) {
//                    showItems();
//                    }
//
//                    function showItems(){

                    //connect to your database. Type in your username, password and the DB path
                    $conn=oci_connect('username', 'password', '//dbserver.engr.scu.edu/db11g');
                    if(!$conn) {
                         print "<br> connection failed:";
                        exit;
                    }
                    $query = oci_parse($conn, "SELECT * FROM RepairItems LEFT JOIN RepairJob ON RepairItems.machineID = RepairJob.machineID");

                    // Execute the query
                    oci_execute($query);
                    $cols = OCINumCols($query);
                    ?>
                        
                        
                    <table class="table table-hover">
                    <thead>
                        <tr>
<!--                            <th style="width: 10%">#</th>-->
                            <th style="width: 10%">Machine ID</th>
                            <th style="width: 20%">Model</th>
                            <th style="width: 10%">Price</th>
                            <th style="width: 10%">Customer Phone</th>
                            <th style="width: 20%">Problem</th>
                            <th style="width: 10%">Contract</th>
                            <th style="width: 10%">Contract ID</th>
                            <th style= "width:10%">Status</th>
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
                        echo "<td>".$row[0]."</td>";  //machineID
                        echo "<td>".$row[1]."</td>";  //model
                        echo "<td>"."$".$row[2]."</td>";  //price
                        echo "<td>".$row[3]."</td>";  //custPhone
                        echo "<td>".$row[4]."</td>";  //prob
                        echo "<td>".$row[5]."</td>";  //contract
                        if(empty ($row[6])) echo"<td>  </td>"; 
                        else echo "<td>".$row[6]."</td>";  //cont ID
                        echo "<td>".$row[11]."</td>";  //status
                        
                        
                        //echo "<td>".$row[7]."</td>";  //
                        // echo "<td><input type=\"text\" class=\"form-control resize\" id=\"timeOut\" name=\"timeOut\" placeholder=\"00:00\"></td>";
                        // echo "<td><input type=\"text\" class=\"form-control resize\" id=\"laborHours\" name=\"laborHours\" placeholder=\"0\"></td>";
                        echo "</tr>";
                    }

                OCIFreeStatement($query);
                OCILogoff($conn);
                // END PHP
                ?>
                        
                        </tbody></table>
                        

                    </div>
		      </div>
            </div>

        <form method="post" action="http://students.engr.scu.edu/~mnaito/updateStatus.php">
        <div class="col-md-12 order-md-3 mb-4">
            <hr class="mb-4">
            <h4 class="mb-3">Update Information</h4>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="machineID">Machine ID</label>
                     <input type="text" class="form-control" id="machineID" name="machineID" placeholder="" value="">
                     <small class="text-muted">Serial number of your machine</small>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="jobstat">Job Status</label>
                    <select class="custom-select d-block w-100" id="jobstat" name="jobstat">
                        <option value="">Choose...</option>
                        <option>UNDER_REPAIR</option>
                        <option>READY</option>
                        <option>DONE</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="timeOut">Time Out</label>
                     <input type="text" class="form-control" id="timeOut" name="timeOut" placeholder="" value="">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="laborHours">Labor Hours</label>
                    <input type="text" class="form-control" id="laborHours" name="laborHours" placeholder="" value="">
                </div>
            </div>

            <input type="submit" class="btn btn-primary btn-lg btn-block" name="submitForm" value="Update">
        </div>
        </form>

        <hr class="mb-4">

        <form method="post" action="http://students.engr.scu.edu/~mnaito/showData.php">
            <h4 class="mb-3">Show Bill</h4>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="col-md-3 mb-3">
                        <label for="machineID">Machine ID</label>
                        <input type="text" class="form-control" id="machineID" name="machineID" placeholder="" value="">
                    </div>
                </div>
            </div>

            <input type="submit" class="btn btn-primary btn-lg btn-block" name="submitForm" value="Submit">
        </form>
    </div>

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

