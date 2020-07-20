<?php
require_once "../libs/database.php";


function get_client_ip() {
$ipaddress = '';
if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
else if(isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
else
    $ipaddress = 'UNKNOWN';
return $ipaddress;
} 
$ip = get_client_ip();

// $progid= $_GET['progid'];
$progid= 1;


$sql = "SELECT progDesc FROM program where progID=$progid";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $description = $row["progDesc"];
  }
} 

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
        <title>Participant Attendance Form</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            #map {
                width: 100%;
                height: 400px;
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
                        <h1 class="mt-4">Participant Attendance Form</h1>

                        <!-- google map geolocation -->
                        <div id="map"></div>
                        <label>Event Description</label>
                        <p class="prog-details"><?=$description?></p>

                        <!-- attendance form -->
                        <form action="verifyForm.php" method="POST">
                            <input type="hidden" name="role" id="role" value="participant">
                            <input type="hidden" name="progid" id="progid" value="<?=$progid?>">
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <div class="form-group">
                                <label for="ip">IP Address</label>
                                <input type="text" class="form-control" name="ip" id="ip" value="<?php echo $ip;?>" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Check In</button>
                        </form>
                        
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
        <script>
            // =========================== static map google api ===========================
            // getLocation();
            // function getLocation() {
            //     if (navigator.geolocation) {
            //         navigator.geolocation.getCurrentPosition(showPosition);
            //     } else {
            //         x.innerHTML = "Geolocation is not supported by this browser.";
            //     }
            // }

            // function showPosition(position) {
            //     var latlon = position.coords.latitude + "," + position.coords.longitude;
            //     console.log(latlon)
            //     var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="+latlon+"&zoom=17&size=400x300&sensor=false&key=AIzaSyCEvSkndyPZ29wZFJzDXKK3HYBoiPby5-M";

            //     document.getElementById("map").innerHTML = "<img src='"+img_url+"'>";
            // }
            // =========================== static map google api ===========================




            // =========================== embed map google api ===========================
            var map, infoWindow;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 17
                });
                infoWindow = new google.maps.InfoWindow;

                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                    // set hidden input values to POST
                    $('#latitude').attr('value', position.coords.latitude);
                    $('#longitude').attr('value', position.coords.longitude);

                    var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                    };

                    infoWindow.setPosition(pos);
                    infoWindow.setContent('You are here!');
                    infoWindow.open(map);
                    map.setCenter(pos);
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
                } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
                }
            }

            // =========================== embed map google api ===========================
            // api key = AIzaSyA00miDLH3z5Q9sAd9PWq-e_K0rU33Z6OA
            // static map api key = AIzaSyCEvSkndyPZ29wZFJzDXKK3HYBoiPby5-M

            
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA00miDLH3z5Q9sAd9PWq-e_K0rU33Z6OA&callback=initMap"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    </body>
</html>
