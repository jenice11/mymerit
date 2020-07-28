S<?php 

require_once '../libs/database.php';
include("../authenticator.php");
if($_GET['progID']) {
    $id = $_GET['progID'];
    
    $sql = "SELECT * FROM program WHERE progID = {$id}";
    $result = mysqli_query($conn,$sql);

    $data = $result->fetch_assoc();}
    
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
    </head>
        <?php include("sidebar.php"); ?>
            <div id="layoutSidenav_content">
               <main class="mb-3">
                    <div class="container-fluid">
                        <h1 class="mt-4">EVENT DETAILS</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Event Details</li>
                        </ol>
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-1">
                                    <!-- <div class="card-header"><h3 class="text-center font-weight-light my-4">Event Details</h3></div> -->
                                    <div class="card-body">
                                        <form method="POST" action="update.php">
                                            <div class="form-group">
                                                <label class="small mb-1" for="eventname">Event Name</label>
                                                <input class="form-control py-4" id="eventname" name="eventname" value="<?php echo $data['progName'] ?>" type="text" readonly placeholder="Enter event name" />
                                                <input class="input" type="text" id="progID" name="progID" value="<?php echo $data['progID'] ?>" hidden="true">
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="eventDesc">Event Description</label>
                                                <input class="form-control py-4" id="eventDesc" type="text" name="eventDesc" value="<?php echo $data['progDesc'] ?>" readonly placeholder="Enter event description" />
                                            </div>
                                             <div class="form-group">
                                                <label class="small mb-1" for="eventDesc">Event Location</label>
                                                <input class="form-control py-4" id="eventDesc" type="text" name="eventDesc" value="<?php echo $data['progLocation'] ?>" readonly placeholder="Enter event description" />
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="date">Date & Time</label>
                                                        <input class="form-control py-4" id="date"  value="<?php echo $data['progDate'] ?>" type="text" name="date" readonly placeholder="Enter program date & time" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="merit">Merit</label>
                                                        <input class="form-control py-4" id="merit" type="number" name="merit" value="<?php echo $data['progMerit'] ?>" onkeypress="return isNumberKey(event)" readonly placeholder="Enter total merit" />
                                                    </div>
                                                </div>
                                            </div>
                                          
                                        <!-- <input type="hidden" name="approval" id="approval" value="0"> -->
                                       
                                         <!-- <a href="programList.php"><button type="button">Home</button></a> -->
                                            <div class="form-group mt-4 mb-0"><!-- <a class="btn btn-primary btn-block" href="login.html">Create Event</a> --></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="studentEventList.php">Back</a></div>
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
        <script>
        function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
         return false;
         return true;
          }
        </script>
        	<script>

  var fileName,input;
  var input = document.getElementById( 'fileName' );
  input.addEventListener( 'change', showFileName );

  function showFileName( event ) {
        // the change event gives us the input it occurred in
       input = event.srcElement;
       // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
       fileName = input.files[0].name;

      document.getElementById( 'photoname' ).value = fileName ;
  }


  $("#uploadFile").change(function() {
  readURL(input);
  });

    function readURL() {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

      reader.onload = function(e) {
        $('#proof').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
      }

  </script>
    </body>
</html> 
