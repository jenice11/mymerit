<?php
require_once "../libs/database.php";

include("../authenticator.php");
$rolechk = false;
$role = "Participant";


//need get variable here (static so far)
// $matric = "CB18188";

$attdid = $_GET['attid'];
$studID = $_GET['studid'];
$progid = $_GET['progid'];

//committee sql check
//chair
$sqlChair = "SELECT * FROM program RIGHT JOIN student ON student.studID = program.progChair WHERE program.progID='$progid' AND student.studID = '$studID'";
$resultChair = mysqli_query($conn,$sqlChair);
$countChair = mysqli_num_rows($resultChair);

//co-chair
$sqlCo = "SELECT * FROM program RIGHT JOIN student ON student.studID = program.progCo WHERE program.progID='$progid' AND student.studID = '$studID'";
$resultCo = mysqli_query($conn,$sqlCo);
$countCo = mysqli_num_rows($resultCo);

//main
$sqlMain = "SELECT * FROM program RIGHT JOIN student ON student.studID = program.progMain WHERE program.progID='$progid' AND student.studID = '$studID'";
$resultMain = mysqli_query($conn,$sqlMain);
$countMain = mysqli_num_rows($resultMain);

//sub
$sqlSub = "SELECT * FROM program RIGHT JOIN student ON student.studID = program.progSub WHERE program.progID='$progid' AND student.studID = '$studID'";
$resultSub = mysqli_query($conn,$sqlSub);
$countSub = mysqli_num_rows($resultSub);

if ($countChair == 1) {
    $role = "1";   
    $queryMerit = "SELECT *,merit.meritID as keyID FROM attendance INNER JOIN merit WHERE merit.meritID ='$role' AND attendance.studID='$studID' AND attendance.progID = '$progid'";
    $data = mysqli_query($conn,$queryMerit);
    while($v = mysqli_fetch_assoc($data)){
        $attID = $v["attID"];
        $meritFID = $v["keyID"];
        $meritPosition = $v["meritPosition"];
        $meritAmount = $v["meritAmount"];
    }
    $rolechk = true;
} elseif ($countCo == 1) {
    $role = "2";   
    $queryMerit = "SELECT * FROM attendance INNER JOIN merit on attendance.meritID = merit.meritID  WHERE merit.meritID ='$role' AND attendance.studID='$studID' AND attendance.progID = '$progid'";
    $data = mysqli_query($conn,$queryMerit);
    while($v = mysqli_fetch_assoc($data)){
        $attID = $v["attID"];
        $meritID = $v["meritID"];
        $meritPosition = $v["meritPosition"];
        $meritAmount = $v["meritAmount"];
    }
    $rolechk = true;
} elseif ($countMain == 1) {
    $role = "3";   
    $queryMerit = "SELECT * FROM attendance INNER JOIN merit on attendance.meritID = merit.meritID  WHERE merit.meritID ='$role' AND attendance.studID='$studID' AND attendance.progID = '$progid'";
    $data = mysqli_query($conn,$queryMerit);
    while($v = mysqli_fetch_assoc($data)){
        $attID = $v["attID"];
        $meritID = $v["meritID"];
        $meritPosition = $v["meritPosition"];
        $meritAmount = $v["meritAmount"];
    }
    $rolechk = true;
} elseif ($countSub == 1) {
    $role = "4";   
    $queryMerit = "SELECT * FROM attendance INNER JOIN merit on attendance.meritID = merit.meritID  WHERE merit.meritID ='$role' AND attendance.studID='$studID' AND attendance.progID = '$progid'";

    $data = mysqli_query($conn,$queryMerit);
    while($v = mysqli_fetch_assoc($data)){
        $attID = $v["attID"];
        $meritID = $v["meritID"];
        $meritPosition = $v["meritPosition"];
        $meritAmount = $v["meritAmount"];
    }
    $rolechk = true;
}

$sql = "SELECT * FROM student INNER JOIN program INNER JOIN attendance ON attendance.studID = student.studID AND attendance.progID = program.progID WHERE attendance.studID ='$studID' AND  attendance.progID='$progid'";

$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

while($row = mysqli_fetch_assoc($result)){
    $studName = $row["studName"];
    $studMatric = $row["studMatric"];
    $studPhone = $row["studPhone"];
    $progID = $row["progID"];
    $progName = $row["progName"];
    $progDate = $row["progDate"];
    $progLocation = $row["progLocation"];
    $progDesc = $row["progDesc"];
    $merit = $row['progMerit'];
    $progProof = $row['progProof'];
    $attID = $row["attID"];
}

if (isset($_POST['claim'])){
    if($count > 0) 
    {
        if($rolechk == true)
        {
            $sql = "UPDATE attendance SET meritID ='$meritFID' WHERE attID = '$attID'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Committee Merit Claimed Successfully!')</script>";
                echo "<script type= 'text/javascript'> window.location='meritCertificate.php'</script>";
            } else {
                echo "<script>alert('".mysqli_error($conn)."')</script>";       
            }
        }
        else{
            $sql = "UPDATE attendance SET meritID ='0' WHERE attID = '$attID'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Participant Merit Claimed Successfully!')</script>";
                echo "<script type= 'text/javascript'> window.location='meritCertificate.php'</script>";
            } else {
                echo "<script>alert('".mysqli_error($conn)."')</script>";       
            }
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
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
    <?php include("sidebar.php"); ?>
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
                                                    <td><?php echo $meritPosition ?></td>
                                                    <td><?php echo $meritAmount ?></td>
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
            <?php include("footer.php"); ?>
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
