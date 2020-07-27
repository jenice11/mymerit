<?php
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
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
               
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
                                            $meritPosition[] = $row['meritPosition'];
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
                                <div class="card-header"><h3 class="text-center font-weight-light my-1">Merit List</h3></div>
                                <div class="card-body">
                                 <canvas id="myChart" width="400" height="100"></canvas>
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


<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    // Configuration options go here
    options: {}
});
</script>

<!--     <script>
var itemCount = <?php echo $itemCount; ?>;
var colors = [];
for (var i = 0; i < itemCount; i++){
    colors[i] = getRandomColor();
}
//generate rgba colors
function getRandomColor(){
        
        var color = 'rgba('+(Math.floor(Math.random() * 256))+','+(Math.floor(Math.random() * 256))+','+(Math.floor(Math.random() * 256))+','+'0.6)';

        return color;
    }



var meritPosition = <?php echo json_encode($meritPosition) ?>;
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: chartData,
        datasets: [
            {
                type: 'doughnut',
                label: "Sales Report",
                fill: false,
                lineTension: 0.1,
                //backgroundColor: "rgba(75,192,192,0.4)",
                backgroundColor: colors,
                //borderColor: "rgba(75,192,192,1)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: quantity,
                spanGaps: false,
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script> -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#tableList').DataTable();
    } );
    </script>


</body>
</html>
