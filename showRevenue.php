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

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$targetDateBegin= $_POST['targetDateBegin'];
				$targetDateEnd= $_POST['targetDateEnd'];
				$revenueDate= date('Y-m-d');
				$revenueDate= date('Y-m-d', strtotime($revenueDate));
				


			}
		?>

		<!-- Bootstrap Javascript -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

		<script src="bootstrap-formhelpers-phone.format.js"></script>
		<script src="bootstrap-formhelpers-phone.js"></script>

	</body>
</html>