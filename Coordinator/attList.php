<?php
require_once "../libs/database.php";
include("../authenticator.php");

// $progid= 1;
$progid= $_GET['progid'];

if(isset($_POST['edit'])){
    $attid = $_POST['attid'];
    $ip = $_POST['ip'];
    $sql = "UPDATE attendance SET ip='$ip' WHERE attID=$attid";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Updated successfully!');</script>";
    } else {
        echo "<script>alert('Update failed!');</script>";
    }
}


if(isset($_POST['delete'])){
    $attid = $_POST['attid'];
    $sql = "DELETE FROM attendance WHERE attID=$attid";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Deleted successfully!');</script>";
    } else {
        echo "<script>alert('Delete failed!');</script>";
    }
}



$sql = "SELECT COUNT(attID) as AttendNum FROM attendance WHERE progID=$progid";
$result = mysqli_query($conn, $sql);
$attendNum = mysqli_fetch_row($result)[0];


$sql = "SELECT progExpected FROM program WHERE progID=$progid";
$result = mysqli_query($conn, $sql);
$expectedNum = mysqli_fetch_row($result)[0];

$sql = "SELECT progMerit FROM program WHERE progID=$progid";
$result = mysqli_query($conn, $sql);
$meritAmount = mysqli_fetch_row($result)[0];


?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Program Attendance List</title>
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .delete_form{
                float: left;
                margin-right: 1rem;
            }
            .program-graph{
                position: relative;
                width: 50%;
                margin: 0 auto;
            }

            .selfie {
                width: 100px;
            }
            
        </style>

    </head>
            <?php include("sidebar.php");?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Program Attendance List</h1>
                        <table class="table" id="program-attendance">
                            <thead class="thead-dark">
                                <tr>
                                <th>No. </th>
                                <th>Selfie</th>
                                <th>Name</th>
                                <th>Geolocation</th>
                                <th>Merit</th>
                                <th>IP</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    // $sql = "SELECT a.attPhoto, s.studName, a.attID, a.latitude, a.longitude, a.ip, m.meritAmount FROM attendance as a, student as s, merit as m where a.progID=$progid and a.studID=s.studID and a.meritID=m.meritID";
                                    $sql = "SELECT a.attPhoto, s.studName, a.attID, a.latitude, a.longitude, a.ip, a.meritID FROM attendance as a, student as s where a.progID=$progid and a.studID=s.studID";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        
                                        $i = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $attid = $row['attID'];
                                            $meritid = $row['meritID'];

                                            if ($meritid != 0){
                                                $sql = "SELECT meritAmount FROM merit WHERE meritID=$meritid";
                                                $result2 = mysqli_query($conn, $sql);
                                                $meritAmount = mysqli_fetch_row($result2)[0];
                                            }
                                            
                                            


                                          echo 
                                          "<tr>
                                            <td>". $i . "</td>
                                            <td>"?><img class='selfie' src="../uploads/<?=$row['attPhoto']?>" onerror="this.src='../uploads/default.png';"><?php echo "</td>
                                            <td>" . $row['studName'] . "</td>
                                            <td>" . $row['latitude'] . ", " .$row['longitude'] . "</td>
                                            <form action='' method='POST'>
                                            <td>".$meritAmount."</td>
                                            <td><input type='text' name='ip' value=" . $row['ip'] . "></td>
                                            ";
                                ?>

                                <td>
                                        <input type="hidden" name="attid" value="<?= $attid?>"> 
                                        <input type="submit" value="Edit" name="edit" class="btn btn-success">
                                    </form>
                                    <form class="delete_form" action="" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                        <input type="hidden" name="attid" value="<?= $attid?>">
                                        <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                                    </form>
                                </td>


                                <?php                        
                                          "</tr>";
                                          $i++;
                                        }
                                    }     
                                      
                                    mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                        
                        <h1 class="mt-4" style="text-align: center;">Program Attendance Graph</h1>
                        <div class="card-body program-graph"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                        
                    </div>
                </main>
                <?php include("footer.php"); ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/main.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script>
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Bar Chart Example
            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Expected", "Actual"],
                datasets: [{
                label: "Number of Attendees",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: [<?=$expectedNum?>, <?=$attendNum?>],
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 6
                    },
                    scaleLabel: {
                    display: true,
                    labelString: 'Attendees'
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: Math.max(<?=$expectedNum?>, <?=$attendNum?>),
                    maxTicksLimit: 5
                    },
                    gridLines: {
                    display: true
                    },
                    scaleLabel: {
                    display: true,
                    labelString: 'No. of Attendees'
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });


            $(document).ready( function () {
                $('#program-attendance').DataTable();
            } );
        </script>

    </body>
</html>
