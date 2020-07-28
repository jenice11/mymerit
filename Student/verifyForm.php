<?php
    require_once "../libs/database.php";
    include("../authenticator.php");

    // forn inputs from attForm
    $progid = $_POST['progid'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $ip = $_POST['ip'];

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


    if (isset($_POST['confirm'])){
        $matric = $_POST['matrics'];
        $password = $_POST['password'];

        
        $sql = "SELECT studID FROM student WHERE studMatric ='$matric' AND studPassword = '$password'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);

        if($count == 1) {
            $studid = mysqli_fetch_row($result)[0];
            $sql = "SELECT studID FROM attendance WHERE studID=$studid AND progid=$progid";
            $result2 = mysqli_query($conn,$sql);
            $count2 = mysqli_num_rows($result2);


            if ($count2 == 1) {
                echo "<script>alert('Already Checked-In!');</script>";
                
            }else if ($count2 == 0){
                $file = $_FILES['attphoto'];
                $file_name = $_FILES['attphoto']['name'];
                $file_tmpname = $_FILES['attphoto']['tmp_name'];
                $file_destination = '../uploads/'. $file_name;
        
                $sql = "INSERT INTO attendance (studID, progID, attPhoto, latitude, longitude, ip) VALUES ($studid, '$progid', '$file_name','$latitude', '$longitude', '$ip')";
                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    if (file_exists($file_destination)) {
                    }else{
                        move_uploaded_file($file_tmpname, $file_destination);
                    }
                    echo "<script>alert('Identification Successful!');</script>";
                    echo "<script>window.location.href = 'meritClaim.php?attid=$last_id&progid=$progid&studid=$studid'</script>";   
                } else {
                    echo "<script>alert('".mysqli_error($conn)."');</script>";       
                }
            }
        }else{
            echo "<script>alert('Identification Failed!');</script>";
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
        <title>Student Identification Form</title>
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
            <?php include("sidebar.php");?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Student Verification Form</h1>

                        <!-- verification form -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="role" value="<?=$role?>">
                                <input type="hidden" name="progid" value="<?=$progid?>">
                                <input type="hidden" name="latitude" value="<?=$latitude?>">
                                <input type="hidden" name="longitude" value="<?=$longitude?>">
                                <input type="hidden" name="ip" value="<?=$ip?>">
                                <label for="matrics">Student Identification Number</label>
                                <input type="text" class="form-control" name="matrics" id="matrics" placeholder="Matrics No." required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="attphoto">Selfie Proof</label>
                                <input type="file" id="attphoto" class="form-control" name="attphoto" required>
                            </div>
                            <button type="submit" name="confirm" class="btn btn-primary">Confirm</button>
                        </form>
                        
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
    </body>
</html>
