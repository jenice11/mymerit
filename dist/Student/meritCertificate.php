<?php
require_once "../libs/database.php";

    // $matric = $_POST['matrics'];
$studid = "2";
$merit = 50;

// $query = "SELECT * FROM program WHERE progID='$progid'";
// $resultProg = mysqli_query($conn,$query);
// $countProg = mysqli_num_rows($resultProg);

// $sql = "SELECT * FROM student WHERE studMatric ='$matric'";
// $result = mysqli_query($conn,$sql);
// $count = mysqli_num_rows($result);

$sql = "SELECT * FROM attendance INNER JOIN program ON attendance.progID = program.progID  INNER JOIN student on attendance.studID = student.studID WHERE attendance.studID ='$studid' order by program.progDate";
// print_r($sql);
// exit();
$result = mysqli_query($conn,$sql);
$result2 = mysqli_query($conn,$sql);
// $data[] = mysqli_fetch_assoc($result);

while($student = mysqli_fetch_array($result2)) { 
    $studName = $student['studName'];
    $studMatric = $student['studMatric'];
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
    <style type="text/css">
        @media print {
            #button-container{
            display: none;
       }
}
    </style>
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
                                <div class="card-header"><h3 class="text-center font-weight-light my-1">Merit Certificate</h3></div>
                                <div class="card-body mx-4">
                                    <table class="table-borderless mb-2" width="50%" >
                                        <tr>
                                            <td width="5%"><b>Name:</b></td>
                                            <td width="45%"><?php echo $studName ?></td>
                                        </tr>
                                        <tr>
                                            <td width="5%"><b>Matric: </b></td>
                                            <td width="45%"><?php echo $studMatric ?></td>
                                        </tr>
                                        <tr>
                                            <td width="5%"><b>Session: </b></td>
                                            <td width="45%">2019/2020</td>
                                        </tr>
                                    </table>
                                    <table class="table" width="100%"  cellspacing="0">
                                        <tr>
                                            <thead>
                                                <th width="3%">No </th>
                                                <th width="20%">Program Name</th>
                                                <th width="10%">Program Date</th>
                                                <th width="30%">Program Description</th>
                                                <th width="17%">Role</th>
                                                <th width="20%">Program Merit</th>  
                                            </thead>        
                                        </tr>
                                        <?php
                                        $i=1;
                                        $totalmerit = 0;
                                        while($row = mysqli_fetch_array($result)) { ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $row['progName'];?></td>
                                                    <td><?php echo $row['progDate'];?></td>
                                                    <td><?php echo $row['progDesc'];?></td>
                                                    
                                                    <td>
                                                        <?php
                                                        if($row['progChair']==$row['studID']){
                                                            echo "Program chair";
                                                        }
                                                        elseif ($row['progCo']==$row['studID']) {
                                                            echo "Program co-chair";
                                                        }
                                                        elseif ($row['progMain']==$row['studID']) {
                                                            echo "Main committee";
                                                        }
                                                        elseif ($row['progSub']==$row['studID']) {
                                                            echo "Sub committee";
                                                        }
                                                        else{
                                                            echo "Participant";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['merit'];?></td>
                                                </tr>
                                            </tbody>
                                            <?php 
                                            $i++;
                                            $totalmerit = $totalmerit + $row['merit'];
                                        } ?>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" align="right"><b>Total Merit: </b></td>
                                                <td><b><?php echo $totalmerit?></b></td>
                                            </tr>
                                        </tfoot>
                                    </table>                  
                                    <div style="text-align: center">
                                        <button type="submit" name="print" id="button-container" class="btn btn-primary form-group mt-4 mb-0 " onclick="window.print();return false;" />Print</button>
                                    </div>
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
