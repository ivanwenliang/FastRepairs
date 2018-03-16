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
                  <li class="nav-item active">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/revenue.php">Show Revenue</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://students.engr.scu.edu/~mnaito/showJobs.php">Show Repair Jobs</a>
                </li>
                </ul>
            </div>
        </nav> 

<div>
        <form method="post" action="http://students.engr.scu.edu/~mnaito/showRevenue.php">
        <div class="col-md-12 order-md-3 mb-4">
            <hr class="mb-4">
            <h4 class="mb-3">Show Revenue Between Dates</h4>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="startdate">Start Date</label>
                     <input type="text" class="form-control" id="startdate" name="startdate" placeholder="" value="">
                     <small class="text-muted">DD-MON-YYYY</small>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="enddate">End Date</label>
                     <input type="text" class="form-control" id="enddate" name="enddate" placeholder="" value="">
                     <small class="text-muted">DD-MON-YYYY</small>
                </div>
            </div>

            <input type="submit" class="btn btn-primary btn-lg btn-block" name="submitForm" value="Dates">
        </div>
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
