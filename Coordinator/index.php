<?php require_once '../libs/database.php';
include("../authenticator.php");
$id = $_SESSION['coordID'];

$count = "SELECT COUNT(progID) AS countApp FROM program WHERE progApproval = '1' and coordID='$id'";
$resultCount = mysqli_query($conn,$count);
$countApp = mysqli_fetch_assoc($resultCount);


$count2 = "SELECT COUNT(progID) AS countNApp FROM program WHERE progApproval = '2' and coordID='$id'";
$resultCount2 = mysqli_query($conn,$count2);
$countNApp = mysqli_fetch_assoc($resultCount2);

$app = implode($countApp);
$napp = implode($countNApp);



$prog = "SELECT COUNT(*) AS total FROM program GROUP BY MONTH(progDate)";
$result = mysqli_query($conn,$prog);
$total = mysqli_fetch_assoc($result);
$total = array();
foreach ($result as $row) {
  $total[] = $row;

}


$data = "SELECT MONTH(progDate) FROM program GROUP BY MONTH(progDate)";
$result2 = mysqli_query($conn,$data);

$month = array();
foreach ($result2 as $row2) {
  $month[] = $row2;
 
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
        <title>Static Navigation - SB Admin</title>
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>


    </head>
    <body>
        
        <?php include("sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                       <!--  -->
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Pie Chart of Event Approval Status
                                    </div>
                                    <div class="card-body"><canvas id="pie" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">

                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Bar Chart of Event Approval Status
                                    </div>
                                    <div class="card-body"><canvas id="bar" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <canvas id="myChart" width="400" height="400"></canvas>

                                </div>
                            </div>
                        </div> -->
                    </div>
                </main>
                <?php include("footer.php"); ?>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <!-- <script src="path/to/chartjs/dist/Chart.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <script>

          var approve = <?php echo json_encode($app)?> ;
          var notapp = <?php echo json_encode($napp)?> ;

            var ctx = document.getElementById("bar");
            var myLineChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ["Approved", "Rejected"],
                datasets: [{
                  label: "Count",
                  backgroundColor: "rgba(2,117,216,1)",
                  borderColor: "rgba(2,117,216,1)",
                  data: [approve, notapp],
                  // data: [3, 3],
                }],
              },
              options: {
                scales: {
                  xAxes: [{
                    time: {
                      unit: ''
                    },
                    gridLines: {
                      display: false
                    },
                    ticks: {
                      maxTicksLimit: 6
                    }
                  }],
                  yAxes: [{
                    ticks: {
                      min: 0,
                      max: 15,
                      maxTicksLimit: 5
                    },
                    gridLines: {
                      display: true
                    }
                  }],
                },
                legend: {
                  display: false
                }
              }
            });


</script>

<script type="text/javascript">                                 
        
   
    var approve = <?php echo json_encode($app)?> ;
    var notapp = <?php echo json_encode($napp)?> ;


   var ctx = document.getElementById("pie");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Approved","Rejected"],
    datasets: [{
     data: [approve, notapp],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});

</script>
    </body>
</html>
.