<?php 
require_once '../libs/database.php';
include("../authenticator.php");

// session_start();
$data = "SELECT * FROM program WHERE progApproval=0 ";
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
    $delete = "DELETE FROM program WHERE progID=$progID";
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
                                        <table class="table table-bordered" id="example">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Event Name</th>
                                            <th scope="col">Event Status</th>
                                            <th scope="col">Action</th>
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
                                               
                                                    <!-- <td> <img src="<?="../GoodsView/Goods/".$row['image']?>" alt="no_image" width="100" height="105" border="2"></td> -->
                                                    <!-- <?php 
                                                                                        ?> -->
                                    <td><form action="" method="POST">
                                    
                                    <input type="button" class="btn btn-primary" onclick="location.href='adminView.php?progID=<?=$row['progID']?>'" value="VIEW EVENT DETAILS">&nbsp;
                                    
                                    <input type="hidden" name="progID" value="<?=$row['progID']?>">
                                   
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
