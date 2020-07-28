<?php require_once '../libs/database.php';
include("../authenticator.php");
$id = $_SESSION['coordID'];

$count = "SELECT COUNT(progID) AS countApp FROM program WHERE progApproval = '1' and coordID='$id'";
$resultCount = mysqli_query($conn,$count);
$countApp = mysqli_fetch_assoc($resultCount);


$count2 = "SELECT COUNT(progID) AS countNApp FROM program WHERE progApproval = '0' OR progApproval = '2' and coordID='$id'";
$resultCount2 = mysqli_query($conn,$count2);
$countNApp = mysqli_fetch_assoc($resultCount2);


$data = "SELECT * FROM program WHERE coordID='$id'";
$result = mysqli_query($conn,$data);

if(mysqli_query($conn, $data)){
    echo "<script type='text/javascript'>
      </script>";
}
else  {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

if(isset($_POST['delete'])){
    $progID = $_POST['progID'];
    $delete = "DELETE FROM program WHERE progID=$progID ";
    $result = mysqli_query($conn,$delete);
    if(mysqli_query($conn, $delete)){
    $message = "Event deleted";
    echo "<script type='text/javascript'>alert('$message');
        window.location = 'programList.php';</script>";
}
else  {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
}

// Close connection
mysqli_close($conn);
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
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>


    </head>
   <?php include("sidebar.php"); ?>
            <div id="layoutSidenav_content">
               <main class="mb-3">
                    <div class="container-fluid">
                        <h1 class="mt-4">EVENT LIST</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Event List</li>
                        </ol>
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-1">
                                    <div class="card-body">
                                         <strong>Approved Events &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </strong><?php echo implode($countApp)?> event(s)<br>
                                         <strong>Non Approved Events : </strong><?php echo implode($countNApp)?> event(s)<br><br>
                                        <table class="table table-bordered" id="example">
                                           
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Event Name</th>
                                            <th scope="col">Approval Status</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Attendence</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i = 1;
                                        if ($result->num_rows > 0) {

                                           while($row = $result->fetch_assoc()) {
                                                    echo "<tr>"
                                                        . "<td>".$i.".</td>"
                                             
                                                    . "<td>". $row['progName']."</td>" ?>
                                                   

                                                    <td> <?php

                                                        if($row['progApproval']=="0")
                                                        {
                                                           echo "IN PROCESS";
                                                        }
                                                        elseif($row['progApproval']=="1")
                                                        {
                                                            echo "APPROVED";
                                                        }
                                                        elseif ($row['progApproval']=="2") {
                                                            echo "REJECTED";
                                                        }
                                                       
                                            
                                                    ?>
                                    <td><form action="" method="POST">
                                    <input type="button" class="btn btn-info" onclick="location.href='editEvent.php?progid=<?=$row['progID']?>&progChair=<?=$row['progChair']?>&progCoChair=<?=$row['progCo']?>&progMain=<?=$row['progMain']?>&progSub=<?=$row['progSub']?>'" value="EDIT">&nbsp;
                                    <input type="button" class="btn btn-success" onclick="location.href='viewEvent.php?progID=<?=$row['progID']?>&progChair=<?=$row['progChair']?>&progCoChair=<?=$row['progCo']?>&progMain=<?=$row['progMain']?>&progSub=<?=$row['progSub']?>'" value="VIEW">&nbsp;
                                   
                                    <input type="hidden" name="progID" value="<?=$row['progID']?>">
                                    <?php if ($row['progApproval']=="0") { ?>
                                         <input class="btn btn-danger" type="submit" name="delete" value="DELETE">
                                   <?php }
                                    ?>

                                    </form></td>
                                   <td><form action="" method="POST">
                                    <?php if($row['progApproval']==1){ ?>
                                      <input type="button" class="btn btn-info" onclick="location.href='stdQR.php?progid=<?=$row['progID']?>'" value="STUDENT QR">&nbsp;
                                  <input type="button" class="btn btn-info" onclick="location.href='commQR.php?progid=<?=$row['progID']?>'" value="COMMITTE QR">&nbsp;
                                  <input type="button" class="btn btn-info" onclick="location.href='attList.php?progid=<?=$row['progID']?>'" value="Attendence">&nbsp;

                            <?php   } ?>
                                   </form></td>
                               

                                    <?php
                                            $i++;
                                            echo "</tr>";
                                            }
                                              }
                                            
                                    ?>

                                </tbody>
                                
                                </table>    
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="addForm.php">Add Event</a></div>
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
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script>
        function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
         return false;
         return true;
          }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
            $('#example').DataTable();
            } );
        </script>
    </body>
</html>