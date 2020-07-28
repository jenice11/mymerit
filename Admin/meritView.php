<?php
include("../authenticator.php");
require_once "../libs/database.php";

$meritID = $_GET['meritID'];
$sql = "SELECT * FROM merit WHERE meritID='$meritID'";
$result = mysqli_query($conn,$sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $meritPosition = $row['meritPosition'];
        $meritAmount = $row['meritAmount'];
        $meritPicture = $row['meritPicture'];
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
    <title>View Merit Detail</title>
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<?php include("sidebar.php"); ?>
        <div id="layoutSidenav_content">
        <main class="mb-3">
            <div class="container-fluid">
                <div class="row justify-content-center m-5">
                    <div class="col-lg-10">
                        <div class="card shadow-lg border-0 rounded-lg mt-4">
                            <div class="card-header"><h3 class="text-center font-weight-light my-1">View Merit</h3></div>
                            <div class="card-body mx-4" >
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="50%">Committee Position</th>
                                            <th scope="col" width="20%">Merit</th>
                                            <th scope="col" width="30%">Picture</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $meritPosition;?></td>
                                            <td><?php echo $meritAmount;?></td>
                                            <td>
                                                <div style="width: 200px">
                                                    <img src="<?php echo $meritPicture; ?>" width="100%"></td>
                                                </div>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary btn-block" type="submit" name="update" onclick="location.href='meritUpdate.php?meritID=<?=$meritID?>'">Update</button>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="meritList.php">View Merit List</a></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/datatables-demo.js"></script>
</body>
</html>
