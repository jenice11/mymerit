<?php
require_once "../libs/database.php";
include("../authenticator.php");

$studID = $_SESSION['studID'];

$totalmerit = 0;
$pMerit = 0;
$cMerit = 0;

$sql = "SELECT * FROM attendance INNER JOIN program ON attendance.progID = program.progID  RIGHT JOIN student on attendance.studID = student.studID   LEFT OUTER JOIN merit ON merit.meritID = attendance.meritID  WHERE attendance.studID ='$studID' order by program.progDate ";

$result = mysqli_query($conn,$sql);
$result2 = mysqli_query($conn,$sql);

while($student = mysqli_fetch_array($result2)) {
    $studName = $student['studName'];
    $studMatric = $student['studMatric'];
    $progID = $student['progID'];
    $meritID = $student['meritID'];
    $meritPosition = $student['meritPosition'];
    if($meritID == 0)
    {
        $query = "SELECT SUM(progMerit) as pMerit FROM program INNER JOIN attendance ON attendance.progID = program.progID  WHERE attendance.studID = '$studID' AND meritID=0";
        
        $data = mysqli_query($conn,$query);
        while($row = mysqli_fetch_array($data)) {
            $pMerit = $row['pMerit'];
        }
    }
    else{
        $query = "SELECT SUM(meritAmount) as cMerit FROM merit INNER JOIN attendance ON attendance.meritID = merit.meritID  WHERE attendance.studID = '$studID'";
        $data = mysqli_query($conn,$query);
        while($row = mysqli_fetch_array($data)) {
            $cMerit = $row['cMerit'];
        }
    }
}

$countSQL = "SELECT COUNT(studID) as count FROM attendance WHERE studID ='$studID'";
$resultCount = mysqli_query($conn,$countSQL);
$count = mysqli_fetch_assoc($resultCount);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Student Merit Certificate</title>
    <link href="../assets/css/styles.css" rel="stylesheet" />
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
<?php include("sidebar.php"); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-1">
                                <div class="card-header"><h3 class="text-center font-weight-light my-1">Merit Certificate</h3></div>
                                <div class="card-body mx-4">
                                    <table class="table-borderless mb-2" width="60%" >
                                        <tr>
                                            <td width="15%"><b>Name:</b></td>
                                            <td width="45%"><?php echo $studName ?></td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><b>Matric: </b></td>
                                            <td width="45%"><?php echo $studMatric ?></td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><b>Session: </b></td>
                                            <td width="45%">2019/2020</td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><b>Program Participated: </b></td>
                                            <td width="45%"><?php echo implode($count)?></td>
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
                                        while($row = mysqli_fetch_array($result)) { ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $row['progName'];?></td>
                                                    <td><?php echo $row['progDate'];?></td>
                                                    <td><?php echo $row['progDesc'];?></td>
                                                    
                                                    <td>
                                                        <?php 
                                                        if($row['meritPosition'] == null){
                                                            echo "Participant";
                                                        }else{
                                                           echo $row['meritPosition'];
                                                       } ?> 
                                                   </td>
                                                   <td>
                                                    <?php 
                                                    if($row['meritPosition'] == null){
                                                        echo $row['progMerit'];
                                                    }else{
                                                       echo $row['meritAmount'];
                                                   } ?> 
                                               </td>
                                           </tr>
                                       </tbody>
                                       <?php 
                                       $i++;
                                   } ?>
                                   <tfoot>
                                    <tr>
                                        <td colspan="5" align="right"><b>Total Merit: </b></td>
                                        <td><b>
                                            <?php 
                                            $totalmerit = $cMerit + $pMerit;
                                            echo $totalmerit;
                                            ?>
                                        </b></td>
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
    <?php include("footer.php"); ?>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>
</html>
