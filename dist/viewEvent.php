<?php 

require_once '../db_connect.php';

if($_GET['progID']) {
    $id = $_GET['progID'];
    $studMatric = explode(",", $_GET['studMatric']);

        // print_r($key);}
        // exit();    
    $sql = "SELECT * FROM program WHERE progID = {$id}";
    $result = $link->query($sql);
    $data = $result->fetch_assoc();

    foreach ($studMatric as $key ) {

        $sql2 = "SELECT * FROM program RIGHT JOIN student ON program.studMatric = student.studMatric WHERE student.studMatric='$key' ";
   
        // $sql2 = "SELECT * FROM student WHERE studMatric={$studMatric}";
        // $result2 = $link->query($sql2);
        $result2 = mysqli_query($link, $sql2);

        if(mysqli_query($link, $sql2)){
            $data2[] = $result2->fetch_assoc();
        }
    }
}
else  
{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

  // exit();
    // $title =explode(",",$data['title']);
    // $hobby =explode(",",$data['Hobby']);
$link->close();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Static Navigation - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Event</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Manage Event
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                   <!--  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div> -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Event
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="programList.php">Event List</a>
                                            <a class="nav-link" href="addForm.php">Add Event</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                           <!--  <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
             <main class="mb-3">
                <div class="container-fluid">
                    <h1 class="mt-4">Home</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-1">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Event Details</h3></div>
                                <div class="card-body">
                                    <form method="POST" action="update.php">
                                        <div class="form-group">
                                            <label class="small mb-1" for="eventname">Event Name</label>
                                            <input class="form-control py-4" id="eventname" name="eventname" value="<?php echo $data['progName'] ?>" type="text" readonly placeholder="Enter event name" />
                                            <input class="input" type="text" id="progID" name="progID" value="<?php echo $data['progID'] ?>" hidden="true">
                                        </div>


                                        <div class="form-group">
                                            <table>
                                                <tr>
                                                    <th class="small mb-1">Name</th>
                                                    <th class="small mb-1">Phone</th>
                                                    <th class="small mb-1">Matric</th>
                                                </tr>
                                                <?php

                                                if ($result2->num_rows > 0) { 
                                                    foreach ($data2 as $row) {

                                                        ?>

                                                        <tr>
                                                            <td> <input class="form-control py-3" id="studName" name="studName" value="<?php echo $row['studName']?>" type="text" readonly placeholder="Enter comitte name" /></td>
                                                            <td><input class="form-control py-3" id="studPhone" name="studPhone" value="<?php echo $row['studPhone']?>" type="text" readonly placeholder="Enter comitte phone" /></td>
                                                            <td><input class="form-control py-3" id="studMatric" name="studMatric" value="<?php echo $row['studMatric']?>" type="text" readonly placeholder="Enter comitte matric" /></td>
                                                        </tr>

                                                    <?php } 

                                                }
                                                ?>
                                            </div>
                                        </table>
                                        <div class="form-group">
                                            <label class="small mb-1" for="eventDesc">Event Description</label>
                                            <input class="form-control py-4" id="eventDesc" type="text" name="eventDesc" value="<?php echo $data['progDesc'] ?>" readonly placeholder="Enter event description" />
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="date">Date & Time</label>
                                                    <input class="form-control py-4" id="date"  value="<?php echo $data['progDate'] ?>" type="text" name="date" readonly placeholder="Enter program date & time" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="merit">Merit Total</label>
                                                    <input class="form-control py-4" id="merit" type="number" name="merit" value="<?php echo $data['progMerit'] ?>" onkeypress="return isNumberKey(event)" readonly placeholder="Enter total merit" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="location">Event Location</label>
                                                    <input class="form-control py-4" id="location" type="text" name="location" value="<?php echo $data['progLocation'] ?>" readonly placeholder="Enter event location" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="participants">Expected No.of Participants</label>
                                                    <input class="form-control py-4" id="participants" name="participants" value="<?php echo $data['progExpected'] ?>" type="text" readonly placeholder="Participants number" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                           <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="proof">Event Proof</label>
                                                <!-- <input class="form-control py-5" id="proof" name="proof" value="<?php echo $data['progProof'] ?>" type="file" placeholder="Participants number" /> -->

                                                <img src="<?="../proof/".$data['progProof']?>" id="proof" name="proof" alt="no_doc" width="100" height="105" border="2" overflow:hidden;>
                                                <input type="text" id="photoname" value="<?=$data['progProof']?>" size="10" readonly>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- <input type="hidden" name="approval" id="approval" value="0"> -->

                                    <!-- <a href="programList.php"><button type="button">Home</button></a> -->
                                    <div class="form-group mt-4 mb-0"><!-- <a class="btn btn-primary btn-block" href="login.html">Create Event</a> --></div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="programList.php">Back</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script>
    function isNumberKey(evt){
       var charCode = (evt.which) ? evt.which : evt.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
           return false;
       return true;
   }
</script>
<script>

  var fileName,input;
  var input = document.getElementById( 'fileName' );
  input.addEventListener( 'change', showFileName );

  function showFileName( event ) {
        // the change event gives us the input it occurred in
        input = event.srcElement;
       // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
       fileName = input.files[0].name;

       document.getElementById( 'photoname' ).value = fileName ;
   }


   $("#uploadFile").change(function() {
      readURL(input);
  });

   function readURL() {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#proof').attr('src', e.target.result);
        }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

</script>
</body>
</html> 