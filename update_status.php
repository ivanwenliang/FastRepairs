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

	<body>

		

	<?php
    //connect to your database
	$conn=oci_connect('mnaito','Naalii10!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}
	$queryString = 'Select * from RepairJob';
	$query = oci_parse($conn, $queryString);
	$res = oci_execute($query);
	
	if (!$res) {
		$e = oci_error($query); 
        		echo $e['message']; 
		exit;
	}
        
    // Fetch the results of the query
    print "<table border='1'>\n";
    while ($row = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS)) {
        print "<tr>\n";
        foreach ($row as $item) {
            print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        print "</tr>\n";
    }
        
    print "</table>\n";   
    
	OCILogoff($conn);
	?>

		<!-- Bootstrap Javascript -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

		<script src="bootstrap-formhelpers-phone.format.js"></script>
		<script src="bootstrap-formhelpers-phone.js"></script>

	</body>
</html>