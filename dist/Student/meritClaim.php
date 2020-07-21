<?php
require_once "../libs/database.php";

$merit = 0;
$rolechk = false;
$role = "Participant";


//need get variable here (static so far)
$matric = "CB18188";
$progid = "1";
$attID = "14";

//committee sql check
//chair
$sqlChair = "SELECT * FROM program RIGHT JOIN student ON student.studID = program.progChair WHERE program.progID='$progid' AND student.studMatric = '$matric'";
$resultChair = mysqli_query($conn,$sqlChair);
$countChair = mysqli_num_rows($resultChair);

//co-chair
$sqlCo = "SELECT * FROM program RIGHT JOIN student ON student.studID = program.progCo WHERE program.progID='$progid' AND student.studMatric = '$matric'";
$resultCo = mysqli_query($conn,$sqlCo);
$countCo = mysqli_num_rows($resultCo);

//main
$sqlMain = "SELECT * FROM program RIGHT JOIN student ON student.studID = program.progCo WHERE program.progID='$progid' AND student.studMatric = '$matric'";
$resultMain = mysqli_query($conn,$sqlMain);
$countMain = mysqli_num_rows($resultMain);

//sub
$sqlSub = "SELECT * FROM program RIGHT JOIN student ON student.studID = program.progCo WHERE program.progID='$progid' AND student.studMatric = '$matric'";
$resultSub = mysqli_query($conn,$sqlSub);
$countSub = mysqli_num_rows($resultSub);

$query = "SELECT * FROM program WHERE progID='$progid'";
$resultProg = mysqli_query($conn,$query);
$countProg = mysqli_num_rows($resultProg);

if ($countChair == 1) {
    $merit = 500;
    $role = "Program chair";
    $rolechk = true;
} elseif ($countCo == 1) {
    $merit = 450;
    $role = "Program co-chair";
    $rolechk = true;
} elseif ($countMain == 1) {
    $merit = 300;
    $role = "Main committee";
    $rolechk = true;
} elseif ($countSub == 1) {
    $merit = 200;
    $role = "Sub committee";
    $rolechk = true;
}

$sql = "SELECT * FROM student WHERE studMatric ='$matric'";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);


while($row = mysqli_fetch_assoc($resultProg)){
    $progID = $row["progID"];
    $progName = $row["progName"];
    $progDate = $row["progDate"];
    $progLocation = $row["progLocation"];
    $progDesc = $row["progDesc"];
    $merit = $row['progMerit'];
    $progProof = $row['progProof'];
}

while($row2 = mysqli_fetch_assoc($result)){
    $studName = $row2["studName"];
    $studMatric = $row2["studMatric"];
    $studPhone = $row2["studPhone"];
}

if (isset($_POST['claim'])){
    if($countProg == 1) 
    {
        $sql = "UPDATE attendance SET merit ='$merit' WHERE attID = '$attID'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Merit Claimed Successfully!')</script>";
        } else {
            echo "<script>alert('".mysqli_error($conn)."')</script>";       
        }
    } 
    else {
        echo "<script>alert('Merit Claim Failed!')</script>";
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
    <title>Student Claim</title>
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
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-1">
                                <div class="card-header"><h3 class="text-center font-weight-light my-1">Claim Merit</h3></div>
                                <div class="card-body mx-4" >
                                    <!-- verification form -->
                                    <form action="" method="POST">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <tr>
                                                <th>Program Name</th>
                                                <th>Program Date</th>
                                                <th>Program Location</th>
                                                <th>Program Description</th>
                                                <th>Program Proof</th>
                                            </tr>
                                            <tr>
                                                <td><?php echo $progName ?></td>
                                                <td><?php echo $progDate ?></td>
                                                <td><?php echo $progLocation ?></td>
                                                <td><?php echo $progDesc ?></td>
                                                <td>
                                                    <img src="<?="../proof/".$progProof?>" id="proof" name="proof" alt="no_doc" width="100" height="105" border="2" overflow:hidden;>
                                                </td>
                                            </tr>
                                        </table>
                                        <br>

                                        <?php
                                        if($rolechk == true)
                                        { 
                                            ?>
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <tr>
                                                    <th>Commitee's Name</th>
                                                    <th>Commitee's Matric</th>
                                                    <th>Commitee's Phone</th>
                                                    <th>Commitee Role</th>
                                                    <th>Commitee Merit</th>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $studName ?></td>
                                                    <td><?php echo $studMatric ?></td>
                                                    <td><?php echo $studPhone ?></td>
                                                    <td><?php echo $role ?></td>
                                                    <td><?php echo $merit ?></td>
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
