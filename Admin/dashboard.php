<?php
include("../authenticator.php");

  // connect to database
  $conn = mysqli_connect('localhost', 'root', '', 'mymerit');

  // Check connection
  if($conn === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }

      // check if user select month & year or not
      if(isset($_GET['month'])){
        $year = $_GET['year'];
        $month = $_GET['month'];
      } else {
        // if user not select month & year
        $year = 0;
        $month = 0;
      }

    // if user choose month & year
    if($month != 0 && $year != 0){
    // select all program based on month and year
    $program_query = "SELECT * from program WHERE YEAR(progDate) =" .$year." AND MONTH(progDate) =".$month."";
    $program_result = mysqli_query($conn, $program_query);
      if(mysqli_num_rows($program_result) <= 0){
        $program_query = "SELECT * from program WHERE YEAR(progDate) =" .$year."";
        $program_result = mysqli_query($conn, $program_query);
        $month = '';
      }

    // if user choose month but not year
  } else if($year == 0 && $month != 0) {
    // select all program based on month only
    $program_query = "SELECT * from program WHERE YEAR(progDate) ='2020' AND MONTH(progDate) =".$month."";
    $program_result = mysqli_query($conn, $program_query);
    $year = '2020';
    if(mysqli_num_rows($program_result) <= 0){
      $program_query = "SELECT * from program WHERE YEAR(progDate) =" .$year."";
      $program_result = mysqli_query($conn, $program_query);
      $month = '';
    }

    // if user choose year but not month
  } else if($year != 0 && $month == 0) {
    // select all program based on year only
    $program_query = "SELECT * from program WHERE YEAR(progDate) =" .$year."";
    $program_result = mysqli_query($conn, $program_query);
    $month = '';
    
  } else {

    // if user not choose month & year, select all program from year 2020
    $program_query = "select * from program WHERE YEAR(progDate)='2020'";
    $program_result = mysqli_query($conn, $program_query);
    $year = '2020';
    $month = '';
   

  }
        // if user choose year, select program based on year
        if($year !=0){
            $program_year = "SELECT * from program WHERE YEAR(progDate) =" .$year."";
            $year_result = mysqli_query($conn, $program_year);
          } else {
            $program_year = "SELECT * from program WHERE YEAR(progDate) ='2020'";
            $year_result = mysqli_query($conn, $program_year);
          }


      // get merit amount
      $r = 0;
      $meritID = array();
      $meritAmmount = array();
      $merit_query = "select * from merit";
      $merit_result = mysqli_query($conn, $merit_query);
      while($row = mysqli_fetch_array($merit_result)){
        $meritID[$r] = $row['meritID'];
        $meritAmount[$r] = $row['meritAmount'];
        $r++;
      }

      $totalMerit = [];
      $maxMerit = [];$minMerit = [];
      for($z = 1; $z<=12; $z++){
      $stud_program_query = "SELECT * from program WHERE YEAR(progDate) = " .$year." AND MONTH(progDate) =".$z."";
      $stud_program_result = mysqli_query($conn, $stud_program_query);
      $stud_prog_id = array();$progMerit = array();$studID = array();
      $x = 0;
      while($rowss = mysqli_fetch_array($stud_program_result)){
          $stud_prog_id[$x] = $rowss['progID'];
          $progMerit[$x] = $rowss['progMerit'];
          $progName[$x] = $rowss['progName'];
          // echo'<br><br> '.$progName[$x];

          $all_stud_query = "select * from student where studPassword != ''";
          $all_stud_result = mysqli_query($conn, $all_stud_query);

          $studMeritID =  array();
          $s = 0;$m = 0;
            while($row = mysqli_fetch_array($all_stud_result)){

              $studID[$s] = $row['studID'];

              if(!isset($totalMerit[$s])){
                $totalMerit[$s] =0;
              }

              // echo '<br><br><br><br>'.$studID[$s];
              $stud_attendance_query = "select * from attendance where studID =".$studID[$s]." AND progID =".$stud_prog_id[$x]."";
              $stud_attendance_result = mysqli_query($conn, $stud_attendance_query);
              while($rows = mysqli_fetch_array($stud_attendance_result)){
                $studMeritID[$m] = $rows['meritID'];

                $meritValue[$m] = 0;
               

                if($studMeritID[$m] == 0){
                  $meritValue[$m] = $progMerit[$x];
                  $minMerit[$z] =  $progMerit[$x];
                } else if($studMeritID[$m] == null){
                  $meritValue[$m] = 0;
                }
                for($c = 0; $c < count($meritID); $c++){
                 if($studMeritID[$m] == $meritID[$c]){
                    $meritValue[$m] = $meritAmount[$c];

                  }
                }
                    $totalMerit[$s] += $meritValue[$m];

                    // echo'<br>'.$m.') Student ID: '.$studID[$s].' MeritID: '.$studMeritID[$m].' Merit Value: '.$meritValue[$m].' Total Merit:'.$totalMerit[$s];
                    $m++;
                }
              $s++;
            }
          $x++;
          $maxMerit[$z] = max($totalMerit);
          // echo 'This max value'.$maxMerit[$z];
          // echo 'This min value'.$minMerit[$z];
      }

    }



      // select all program
      $all_program_query = "select * from program";
      $all_program_result = mysqli_query($conn, $all_program_query);

      // create array for all programs
      $allPrograms = array();
      // create array for coordinator name
      $coordName = array();

      // assign array to all programs
      while($rows = mysqli_fetch_array($all_program_result)){
      $allPrograms [] = $rows;
      }

      foreach ($allPrograms as $key => $value) {
        $coordID[$key] = $value['coordID'];

        // select coordinator name based on coordinator id
        $coord_query = "SELECT * FROM coordinator INNER JOIN program ON program.coordID = coordinator.coordID
        WHERE coordinator.coordID ='{$coordID[$key]}'";
        $coord_results = mysqli_query($conn, $coord_query);
        $rows = mysqli_fetch_array($coord_results);
        $coordName[$key] = $rows['coordName'];

      }


      // create array for program
      $program_results = array();
      while($row = mysqli_fetch_array($program_result)){
      $program_results[] = $row;
      }


      // create array of total_attendance
      $total_attendance = array();

      foreach($program_results as $k => $row){
      $progID[$k] = $row['progID'];
      $progName[$k] = $row['progName'];

      // select attendance based on program id
      $attendance_query = "select * from attendance where progID = '".$progID[$k]."' ";
      $attendance_results = mysqli_query($conn, $attendance_query);
      $total_attendance[$k] = mysqli_num_rows($attendance_results);


      $month_name = ['','January','February','March','April','May','Jun',
      'July','August','September','October','November','December'];

      $j = $k;
      }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <title>Dashboard</title>
    </head>
   
    <?php include("sidebar.php"); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>


                            <div style="padding-left:40%">
                                 <select class="browser-default custom-select mb-3 w-auto"
                                 id="year" name="year">
                                   <option value="0">Select Year</option>
                                 </select>

                                 <select class="browser-default custom-select mb-3 w-auto"
                                 id="month" name="month">
                                 <option value="0">Select Month</option>
                                 </select>

                                 <button class="btn btn-md btn-info mb-3" type="button" onclick="getValue()" >Seacrh</button>
                              </div>


                    <div class="row justify-content-center">

                        <div class="col-xl-10">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Programs In <?php echo $year ?> (Annualy)
                                </div>
                                <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>


                            <div class="col-xl-10">
                                <div class="card mb-5">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Maximum and Minimum Merit Obtained by Student (<?php echo $year?>)
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>

                            <div class="col-xl-10">
                                <div class="card mb-5">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Programs In <?php echo $month_name[intval($month)].' '.  $year?> (Monthly)
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>

                          </div>


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                All Programs
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Location</th>
                                                <th>Approval</th>
                                                <th>Coordinator</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                              <th>No</th>
                                              <th>Name</th>
                                              <th>Date</th>
                                              <th>Location</th>
                                              <th>Approval</th>
                                              <th>Coordinator</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                            $i = 1;
                                                  foreach($all_program_result as $key => $row){
                                               echo "<tr>"
                                                . "<td>".$i."</td>"
                                                       . "<td>" .$row['progName']."</td>"
                                                       . "<td>". $row['progDate']. "</td>"
                                                       . "<td>". $row['progLocation']. "</td>"
                                                       . "<td>". $row['progApproval']. "</td>"
                                                       . "<td>". $coordName[$key]. "</td>"
                                                       ."</tr>";
                                                       $i++;
                                                  }
                                              ?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include("footer.php"); ?>
            </div>
        </div>
        <script type="text/javascript">

        let month_name = ['','January','February','March','April','May','Jun',
      'July','August','September','October','November','December'];


        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // random color generator
        var o = Math.round, r = Math.random, s = 255;

        // Bar Chart
        let barChart = document.getElementById('myBarChart').getContext('2d');
        let myBarChart = new Chart(barChart, {
          type:'bar', //bar, horizontalBar, pie, line, doughtnut, radar, polarArea
          data:{
            labels:['Program'],
            datasets:[
              <?php for($i = 0; $i<=$j; $i++){ ?>
              {
              label:<?php echo "'".$progName[$i]."'" ?>,
              data:[<?php echo "".$total_attendance[$i].""; ?>],

              // display color based on rgba format rgba(255, 99, 132, 0.6)
              backgroundColor:['rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')'],

              borderWidth:1,
              borderColor:'#777',
              hoverBorderWidth:3,
              hoverBorderColor:'#000',
            }
              <?php
                if($i == $j){
                  echo "";
                } else {
                  echo ",";
                }

                } ?>
            ]
          },
              options:{
                title:{
                  display:true,
                  text:'Program in '+month_name[<?php echo intval($month) ?>]+' '+<?php echo $year ?>,
                  fontSize:15
                },
                scales: {
                  yAxes: [{
                    scaleLabel: {
                      display: true,
                      labelString: 'Total Attendance'
                    },
                    ticks: {
                        beginAtZero: true   // minimum value will be 0.
                      }
                  }],
                },
                legend:{
                  display:'false',
                  position:'right',
                  labels:{
                    fontColor:'#000'
                  }
                },
                layout:{
                  padding:{
                    left:50,
                    right:0,
                    bottom:0,
                    top:0
                    }
                  },
                  tooltips:{
                    enabled:true
                }
              }
        })


        // Pie Chart
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: [<?php $t_attd = array(); $count = 0;
              while($row = mysqli_fetch_array($year_result)){
              $attd_query = "select * from attendance where progID = '".$row['progID']."' ";
              $attd_results = mysqli_query($conn, $attd_query);
              $t_attd[$count] = mysqli_num_rows($attd_results);
              echo "'".$row['progName']."',"; $count++; }?>
              ],
            datasets: [{
              data: [ <?php for($i = 0; $i<$count; $i++){
                echo "'".$t_attd[$i]."',";
              }?>
            ],
              backgroundColor: [<?php for($i = 0; $i<$count; $i++){ ?>
                'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')',
              <?php }?>
              ],
            }],
          },
        });


        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
            datasets: [{
              label: "Max Merit",
              lineTension: 0.3,
              backgroundColor: "rgba(2,117,216,0.2)",
              borderColor: "rgba(2,117,216,1)",
              pointRadius: 5,
              pointBackgroundColor: "rgba(2,117,216,1)",
              pointBorderColor: "rgba(255,255,255,0.8)",
              pointHoverRadius: 5,
              pointHoverBackgroundColor: "rgba(2,117,216,1)",
              pointHitRadius: 50,
              pointBorderWidth: 2,
              data: [<?php for($y = 1; $y<=12; $y++){
                if(!isset($maxMerit[$y])){
                  echo "'0',";
                } else {
                echo "'".$maxMerit[$y]."',";
              }
              }?>],
            },
            {
              label: "Min Merit",
              lineTension: 0.3,
              backgroundColor: "rgba(242, 38, 19, 0.2)",
              borderColor: "rgba(242, 38, 19, 1)",
              pointRadius: 5,
              pointBackgroundColor: "rgba(242, 38, 19, 1)",
              pointBorderColor: "rgba(255,255,255,0.8)",
              pointHoverRadius: 5,
              pointHoverBackgroundColor: "rgba(242, 38, 19, 1)",
              pointHitRadius: 50,
              pointBorderWidth: 2,
              data: [<?php for($y = 1; $y<=12; $y++){
                if(!isset($minMerit[$y])){
                  echo "'0',";
                } else {
                echo "'".$minMerit[$y]."',";
              }
              }?>],
            }],

          },
          options: {
            scales: {
              xAxes: [{
                time: {
                  unit: 'date'
                },
                gridLines: {
                  display: false
                },
                ticks: {
                  maxTicksLimit: 7
                }
              }],
              yAxes: [{
                ticks: {
                  min: 0,
                  max: <?php echo (max($maxMerit) + 100)?>,
                  maxTicksLimit: 5
                },
                gridLines: {
                  color: "rgba(0, 0, 0, .125)",
                }
              }],
            },
            legend: {
              display: false
            }
          }
        });



      </script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/main.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    </body>
</html>
