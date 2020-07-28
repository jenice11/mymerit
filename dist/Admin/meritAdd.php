<?php
require_once "../libs/database.php";

if (isset($_POST['addMerit'])){
    $fileinfo=PATHINFO($_FILES['meritPicture']['name']);
    if(empty($fileinfo['filename'])){
        $location="";
    }
    else{
        $newFilename=$fileinfo['filename'] . "." . $fileinfo['extension'];
        move_uploaded_file($_FILES["meritPicture"]["tmp_name"],"meritPicture/" . $newFilename);
        $location="meritPicture/" . $newFilename;
    }

    $sql = "INSERT INTO merit (meritPosition, meritAmount, meritPicture) VALUES ('$_POST[position]', '$_POST[amount]', '$location')";
    // print_r($sql);
    // exit();
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Committee Merit Added Successful!')</script>";
        echo "<script type= 'text/javascript'> window.location='meritList.php'</script>";
    } else {
        echo "<script>alert('".mysqli_error($conn)."')</script>";       
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Add Merit</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">                
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logou</a>
                </li>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Merit List</div>
                        <a class="nav-link" href="meritList.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Merit List
                        </a>
                        <a class="nav-link" href="meritAdd.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Add Merit
                        </a>
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
                    <div class="row justify-content-center mt-4">
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-1">
                                <div class="card-header"><h3 class="text-center font-weight-light my-1">Add Merit</h3></div>
                                <div class="card-body mx-4" >
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="Position">Position</label>
                                                    <input class="form-control py-4" name="position" id="Position" type="text" placeholder="Enter Committee Position" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="Merit">Merit</label>
                                                    <input class="form-control py-4" name="amount" id="amount" type="number" placeholder="Enter Merit Amount" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label"><b>Add merit image here:</b></label><br>
                                                <input type="file" name="meritPicture" onchange="loadFile(event)" accept="image/*">
                                                <br><br>
                                                <img  id="output" width="300px"/>
                                                <script>
                                                    var loadFile = function(event) {
                                                      var output = document.getElementById('output');
                                                      output.src = URL.createObjectURL(event.target.files[0]);
                                                  };
                                              </script>
                                          </div>
                                          <br>
                                      </div>
                                      <button class="btn btn-primary btn-block" type="submit" name="addMerit">Add</button>
                                  </form>
                              </div>
                              <div class="card-footer text-center">
                                <div class="small"><a href="meritList.php">View Merit List</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; MyMerit 2020</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/datatables-demo.js"></script>
</body>
</html>
