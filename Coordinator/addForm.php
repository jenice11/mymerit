<?php require_once '../libs/database.php';
include("../authenticator.php");
$id = $_SESSION['coordID'];
// session_start();

  $sql = "SELECT * FROM student";
  $result = mysqli_query($conn,$sql);
  // mysqli_close($conn);

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
                        <h1 class="mt-4">NEW EVENT</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Add Event</li>
                        </ol>
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-1">
                                    <!-- <div class="card-header"><h3 class="text-center font-weight-light my-4">Program Details</h3></div> -->
                                    <div class="card-body">
                                        <form method="POST" enctype='multipart/form-data' action="add.php" onsubmit = "return(validate());">
                                            <div class="form-group">
                                                <label class="small mb-1" for="eventname">Event Name</label>
                                                <input class="form-control py-4" id="eventname" name="eventname" type="text" placeholder="Enter event name" required="true" />
                                                <input class="input" type="text" id="progID" name="progID" hidden="true">
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="eventDesc">Event Description</label>
                                                <input class="form-control py-4" id="eventDesc" type="text" name="eventDesc" placeholder="Enter event description" required="true" />
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="date">Date & Time</label>
                                                        <input class="form-control py-4" id="date" type="datetime-local" name="date" placeholder="Enter program date & time" required="true" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="merit">Merit Total</label>
                                                        <input class="form-control py-4" id="merit" type="number" name="merit" onkeypress="return isNumberKey(event)" placeholder="Enter total merit" required="true" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="location">Event Location</label>
                                                        <input class="form-control py-4" id="location" type="text" name="location" placeholder="Enter event location" required="true" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="participants">Expected No.of Participants</label>
                                                        <input class="form-control py-4" id="participants" name="participants" type="text" placeholder="Participants number" required="true" />
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="progChair">Program Chair</label>
                                                        <select  id="progChair" name="progChair" required="true">
                                                             <option value="" selected="selected">Please Select</option>            
                                                            <?php  if ($result->num_rows > 0) {

                                                     while($row = $result->fetch_assoc())  {
                                                        
                                                        ?>


                                                       
                                                <option id="progChair" name="progChair" value="<?php echo $row["studID"]; ?>" ><?php echo $row["studMatric"];?></option>                        
                                                <?php  }  
                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="progCoChair">Program Co Chair</label>
                                                        <select  id="progCoChair" name="progCoChair"  required="true">
                                                              <option value="" selected="selected">Please Select</option>        
                                                            <?php 
                                                            $sql = "SELECT * FROM student";
                                                            $result = mysqli_query($conn,$sql);
                                                            if ($result->num_rows > 0) {

                                                     while($row = $result->fetch_assoc())  {
                                                        
                                                        ?>

                                                <option id="progCoChair" name="progCoChair" value="<?php echo $row["studID"]; ?>" ><?php echo $row["studMatric"];?></option>                        
                                                <?php  }  
                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="progMain">Program Main</label>
                                                        <select  id="progMain" name="progMain"  required="true">
                                                              <option value="" selected="true">Please Select</option>        
                                                            <?php 
                                                            $sql = "SELECT * FROM student";
                                                            $result = mysqli_query($conn,$sql);
                                                             if ($result->num_rows > 0) {

                                                     while($row = $result->fetch_assoc())  {
                                                        
                                                        ?>

                                                <option id="progMain" name="progMain" value="<?php echo $row["studID"]; ?>" ><?php echo $row["studMatric"];?></option>                        
                                                <?php  }  
                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="progSub">Program Sub</label>
                                                        <select  id="progSub" name="progSub"  required="true">
                                                              <option value="" selected="true">Please Select</option>        
                                                            <?php  
                                                            $sql = "SELECT * FROM student";
                                                            $result = mysqli_query($conn,$sql);
                                                            if ($result->num_rows > 0) {

                                                     while($row = $result->fetch_assoc())  {
                                                        
                                                        ?>

                                                <option  id="progSub" name="progSub" value="<?php echo $row["studID"]; ?>" ><?php echo $row["studMatric"];?></option>                        
                                                <?php  }  
                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>





                                                </div>
                                              
                                
                                             <div class="form-row">
                                             <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="proofLabel">Upload Event Proof</label>
                                                        <!-- <input class="form-control py-5" id="proof" name="proof" type="file" onclick="document.getElementById('fileName').click()" required="true" /> -->
                                                        <img src="../no_image.png" id="proof" name="proof" alt="no_doc" width="100" height="105" border="2" overflow:hidden;>
                                                         <input type="text" id="photoname" value="" size="10" readonly >
                                         
                                                    
                                                        <button type="button"  name="button" onclick="document.getElementById('fileName').click()">Select a file</button>
                                                        
                                                        <input type='file' name="photofile" id="fileName" style="display:none">

                                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                        <button type="button"  name="button" onclick="document.getElementById('uploadFile').click()">Upload Photo</button>
                                                        <input type='button' id="uploadFile" style="display:none" onclick="return readURL();">

                                                  
                                             </div>
                                                    </div>
                                            </div>
                                        </div>
                                        </div>
                                        <input type="hidden" name="approval" id="approval" value="0">
                                         <input type="hidden" name="coord" id="coord" value="<?php echo $id ?>">
                                        <input type="submit" name="Submit" value="Add" class="btn btn-primary btn-block">
                                         <!-- <a href="programList.php"><button type="button">Home</button></a> -->
                                            <div class="form-group mt-4 mb-0"><!-- <a class="btn btn-primary btn-block" href="login.html">Create Event</a> --></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="programList.php">Back</a></div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
        <script src="../assets/js/scripts.js"></script>
        <script>
        function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
         return false;
         return true;
          }
        </script>
        <!-- <script type="text/javascript">
            $(document).ready(function() {       
        $('#committee').multiselect({       
        nonSelectedText: 'Select Student'             
    });
});
        </script> -->
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


        function readURL() {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#proof').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        function validate(){
            var nme = document.getElementById("fileName");
            if(nme.value.length < 4) {
                alert('Must Select a EVENT PROOF for upload!');
                nme.focus();
                return false;
            }
        }

    </script>
       

    </body>
</html> 
