<?php
require_once "../libs/database.php";
    // forn inputs from attForm
    // $role = $_POST['role'];
    // $progid = $_POST['progid'];
    // $latitude = $_POST['latitude'];
    // $longitude = $_POST['longitude'];
    // $ip = $_POST['ip'];
$progid = $_GET['progid'];
$role = "2";

    // $matric = $_POST['matrics'];
$matric = "CB18174";
$merit = 50;

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
} 
$ip = get_client_ip();

$query = "SELECT * FROM program WHERE progID='$progid'";
$resultProg = mysqli_query($conn,$query);
$countProg = mysqli_num_rows($resultProg);

$sql = "SELECT * FROM student WHERE studMatric ='$matric'";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

if (isset($_POST['claim'])){
    if($countProg == 1) 
    {
        $sql = "INSERT INTO attendance (studID, progID, latitude, longitude, ip) VALUES (2, '$progid', '$latitude', '$longitude', '$ip')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Identification Successful!')</script>";
        } else {
            echo "<script>alert('".mysqli_error($conn)."')</script>";       
        }
    } 
    else {
        echo "<script>alert('Identification Failed!')</script>";
    }
    $conn->close();
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
    <title>Student Identification Form</title>
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
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Event List
                        </a>
                        <a class="nav-link" href="attForm.php?progid=1">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Attendance
                        </a>
                        <a class="nav-link" href="verifyForm.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Verification
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
            <main>
                <div class="container-fluid">
                    <?php 
                    while($row = mysqli_fetch_assoc($resultProg)){
                        $progID = $row["progID"];
                        $progName = $row["progName"];
                        $progDate = $row["progDate"];
                        $progLocation = $row["progLocation"];
                        $progDesc = $row["progDesc"];
                    }

                    while($row2 = mysqli_fetch_assoc($result)){
                        $studName = $row2["studName"];
                        $studMatric = $row2["studMatric"];
                        $studPhone = $row2["studPhone"];
                    }
                    ?>
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-1">
                                <div class="card-header"><h3 class="text-center font-weight-light my-1">Claim Merit</h3></div>
                                <div class="card-body mx-4" >
                                    <!-- verification form -->
                                    <form action="" method="POST">
                                        <input type="hidden" name="role" value="<?=$role?>">
                                        <input type="hidden" name="progid" value="<?=$progid?>">
                                        <input type="hidden" name="latitude" value="<?=$latitude?>">
                                        <input type="hidden" name="longitude" value="<?=$longitude?>">
                                        <input type="hidden" name="ip" value="<?=$ip?>">

                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <tr>
                                                <th>Program Name</th>
                                                <th>Program Date</th>
                                                <th>Program Location</th>
                                                <th>Program Description</th>
                                            </tr>
                                            <tr>
                                                <td><?php echo $progName ?></td>
                                                <td><?php echo $progDate ?></td>
                                                <td><?php echo $progLocation ?></td>
                                                <td><?php echo $progDesc ?></td>
                                            </tr>
                                        </table>
                                        <br>

                                        <?php
                                        $comRole = "Chair";
                                        if($comRole == "Chair")
                                        {
                                            $comMerit = 500;
                                        }

                                        if($role == "1")
                                        { 
                                            ?>
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <tr>
                                                    <th>Commitee Role</th>
                                                    <th>Commitee Merit</th>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $comRole ?></td>
                                                    <td><?php echo $comMerit ?></td>
                                                </tr>
                                            </table>
                                            <?php 
                                        }
                                        else
                                        { 
                                            ?>
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <tr>
                                                    <th>Participant's Name</th>
                                                    <th>Participant's Matric</th>
                                                    <th>Participant's Phone</th>
                                                    <th>Event Merit</th>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $studName ?></td>
                                                    <td><?php echo $studMatric ?></td>
                                                    <td><?php echo $studPhone ?></td>
                                                    <td><?php echo $merit ?></td>
                                                </tr>
                                            </table>
                                            <?php 
                                        } ?>
                                        <div style="text-align: center">
                                            <button type="submit" name="claim" class="btn btn-primary form-group mt-4 mb-0 ">Claim</button>
                                        </div>
                                    </form>
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
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>
</html>
