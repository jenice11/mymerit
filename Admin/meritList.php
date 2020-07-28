<?php
include("../authenticator.php");
require_once "../libs/database.php";

$sql = "SELECT * FROM merit";
$result = mysqli_query($conn,$sql);

if(isset($_POST['delete'])){
    $query = "DELETE from merit where meritID='$_POST[meritID]'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Committee Merit Deleted Successful!'); </script>";
        echo "<script type= 'text/javascript'> window.location='meritList.php'</script>";
    } else {
        echo "<script>alert('".mysqli_error($conn)."')</script>";       
    }
}

$sql2 = "SELECT merit.meritPosition,COUNT(attendance.meritID) as count FROM attendance INNER JOIN merit ON merit.meritID = attendance.meritID GROUP BY attendance.meritID";
$result2 = mysqli_query($conn,$sql2);
while($v = $result2->fetch_assoc()) {
    $meritPosition[] = $v['meritPosition'];
    $positionCount[] = $v['count'];
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
    <title>Merit List</title>
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>

    <?php include("sidebar.php"); ?>
        <div id="layoutSidenav_content">
            <main class="mb-3">
                <div class="container-fluid">
                    <div class="row justify-content-center mt-4">
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-1">
                                <div class="card-header"><h3 class="text-center font-weight-light my-1">Merit List</h3></div>
                                <div class="card-body">
                                    <table class="table table-bordered" id="tableList">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Committee Position</th>
                                                <th scope="col">Merit</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $i = 1;
                                        if ($result->num_rows > 0) {
                                           while($row = $result->fetch_assoc()) {
                                            echo "<tr>"
                                            . "<td>".$i.".</td>"
                                            . "<td>". $row['meritPosition']."</td>" 
                                            . "<td>". $row['meritAmount']."</td>" ;
                                            ?>

                                            <td>
                                                <form action="" method="POST" onsubmit="return confirm('Are you sure to delete?');">
                                                    <button class="btn btn-info" onclick="location.href='meritView.php?meritID=<?=$row['meritID']?>'" type="button"><i class="fas fa-folder"></i> &nbsp;View</button>
                                                    <button class="btn btn-warning" onclick="location.href='meritUpdate.php?meritID=<?=$row['meritID']?>'" type="button"><i class="fas fa-pencil-alt"></i> &nbsp;Edit</button> 
                                                    <button class="btn btn-danger" value="DELETE" name="delete" type="submit"><i class="fas fa-trash"></i> &nbsp;Delete</button>
                                                    <input type="hidden" name="meritID" value="<?php echo $row['meritID'] ?>">
                                                    
                                                </form>
                                            </td>
                                            <?php
                                            $i++;
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </table>  
                                <br>
                                <button class="btn btn-primary btn-block" type="submit" name="add" onclick="location.href='meritAdd.php'">Add New Committee Merit</button>
                            </div>

                            <div class="card-header"><h3 class="text-center font-weight-light my-1">Chart</h3></div>
                            <div class="card-body" style="text-align: center;">
                                <div class="row justify-content-md-center">
                                    <canvas id="myChart" width="400" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        <?php include("footer.php"); ?>
        </div>
    </div>


    <script>
        var meritPosition = <?php echo json_encode($meritPosition) ?>;
        var positionCount = <?php echo json_encode($positionCount) ?>;

        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: meritPosition,
        datasets: [{
            label: 'Frequency',
            backgroundColor: 'rgb(99, 172, 255)',
            borderColor: 'rgb(99, 172, 255)',
            data: positionCount
        }]
    },

    // Configuration options go here
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    min: 0, // it is for ignoring negative step.
                    beginAtZero: true,
                    callback: function(value, index, values) {
                        if (Math.floor(value) === value) {
                            return value;
                        }
                    }

                }
            }]
        }
    }
});
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="../assets/demo/chart-area-demo.js"></script>
<script src="../assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="../assets/demo/datatables-demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableList').DataTable();
    } );
</script>


</body>
</html>
