<?php 

require_once '../libs/database.php';
include("../authenticator.php");

if($_GET['progID']) {
    $id = $_GET['progID'];
    $progChair = $_GET['progChair'];
    $progCoChair = $_GET['progCoChair'];
    $progMain = $_GET['progMain'];
    $progSub = $_GET['progSub'];
    
    $sql = "SELECT * FROM program WHERE progID = {$id}";
    $result = mysqli_query($conn,$sql);

    $data = $result->fetch_assoc();
    $sql2 = "SELECT * FROM student";
    $result2 = mysqli_query($conn,$sql2);
}
        // $sql2 = "SELECT * FROM program RIGHT JOIN student ON program.progChair = student.studID WHERE student.studID='$progChair'";
        // $sql3 = "SELECT * FROM program RIGHT JOIN student ON program.progCo = student.studID WHERE  student.studID='$progCoChair'";
        // $sql4 = "SELECT * FROM program RIGHT JOIN student ON program.progMain = student.studID WHERE student.studID='$progMain'";
        // $sql5 = "SELECT * FROM program RIGHT JOIN student ON program.progSub = student.studID WHERE student.studID='$progSub' ";
       
 
//         $result2 = mysqli_query($conn, $sql2);
//         $result3 = mysqli_query($conn, $sql3);
//         $result4 = mysqli_query($conn, $sql4);
//         $result5 = mysqli_query($conn, $sql5);
     
//         if ($result2->num_rows > 0) {
//             $data2[]= $result2->fetch_assoc();
//     }
//      if ($result3->num_rows > 0) {
//             $data3[]= $result3->fetch_assoc();
//     }
//      if ($result4->num_rows > 0) {
//             $data4[]= $result4->fetch_assoc();
//     }
//      if ($result5->num_rows > 0) {
      
//             $data5[]= $result5->fetch_assoc();
//     }
//     else  
// {
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
// }

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
    <body>
        
        <?php include("sidebar.php"); ?>
            <div id="layoutSidenav_content">
               <main class="mb-3">
                    <div class="container-fluid">
                        <h1 class="mt-4">EDIT EVENT</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Edit Event</li>
                        </ol>
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-1">
                                    <!-- <div class="card-header"><h3 class="text-center font-weight-light my-4">Event Details</h3></div> -->
                                    <div class="card-body">
                                        <form method="POST" action="update.php" enctype='multipart/form-data'>
                                            <div class="form-group">
                                                <label class="small mb-1" for="eventname">Event Name</label>
                                                <input class="form-control py-4" id="eventname" name="eventname" value="<?php echo $data['progName'] ?>" type="text" placeholder="Enter event name" />
                                                <input class="input" type="text" id="progID" name="progID" value="<?php echo $data['progID'] ?>" hidden="true">
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="eventDesc">Event Description</label>
                                                <input class="form-control py-4" id="eventDesc" type="text" name="eventDesc" value="<?php echo $data['progDesc'] ?>" readonly placeholder="Enter event description" />
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
                                                        <label class="small mb-1" for="merit">Merit Total</label>
                                                        <input class="form-control py-4" id="merit" type="number" name="merit" value="<?php echo $data['progMerit'] ?>" onkeypress="return isNumberKey(event)" placeholder="Enter total merit" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="location">Event Location</label>
                                                        <input class="form-control py-4" id="location" type="text" name="location" value="<?php echo $data['progLocation'] ?>" placeholder="Enter event location" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="participants">Expected No.of Participants</label>
                                                        <input class="form-control py-4" id="participants" name="participants" value="<?php echo $data['progExpected'] ?>" type="text" placeholder="Participants number" />
                                                    </div>
                                                </div>
                                                  <div class="form-group">
                                           <!--  <table>
                                                <tr>
                                                    <th class="small mb-1">Program Chair Name</th>
                                                    <th class="small mb-1">Program Chair Phone No.</th>
                                                    <th class="small mb-1">Program Chair Matric ID</th>
                                                </tr>
                                                <?php

                                                if ($result2->num_rows > 0) { 
                                                    foreach ($data2 as $row) {

                                                        ?>

                                                        <tr>
                                                            <td> <input class="form-control py-3" id="studName" name="studName" value="<?php echo $row['studName']?>" type="text" readonly placeholder="Enter comitte name" /></td>
                                                            <td><input class="form-control py-3" id="studPhone" name="studPhone" value="<?php echo $row['studPhone']?>" type="text" readonly placeholder="Enter comitte phone" /></td>
                                                            <td><input class="form-control py-3" id="studMatric" name="studMatric" value="<?php echo $row['studMatric']?>" type="text" readonly placeholder="Enter comitte matric" /></td>
                                                               <input type="hidden" name="progChair" value="<?php echo $row['studID']?>">
                                                        </tr>

                                                    <?php } 

                                                }
                                                ?>
                                            </table>
                                            <table>
                                                <tr>
                                                    <th class="small mb-1">Program Co Chair Name</th>
                                                    <th class="small mb-1">Program Chair Phone No.</th>
                                                    <th class="small mb-1">Program Chair Matric ID</th>
                                                </tr>
                                                <?php

                                                if ($result3->num_rows > 0) { 
                                                    foreach ($data3 as $row3) {

                                                        ?>

                                                        <tr>
                                                            <td> <input class="form-control py-3" id="studName" name="studName" value="<?php echo $row3['studName']?>" type="text" readonly placeholder="Enter comitte name" /></td>
                                                            <td><input class="form-control py-3" id="studPhone" name="studPhone" value="<?php echo $row3['studPhone']?>" type="text" readonly placeholder="Enter comitte phone" /></td>
                                                            <td><input class="form-control py-3" id="studMatric" name="studMatric" value="<?php echo $row3['studMatric']?>" type="text" readonly placeholder="Enter comitte matric" /></td>
                                                               <input type="hidden" name="progCoChair" value="<?php echo $row3['studID']?>">
                                                        </tr>

                                                    <?php } 

                                                }
                                                ?>
                                            </table>
                                            <table>
                                                <tr>
                                                    <th class="small mb-1">Program Main Name</th>
                                                    <th class="small mb-1">Program Main Phone No.</th>
                                                    <th class="small mb-1">Program Main Matric ID</th>
                                                </tr>
                                                <?php

                                                if ($result4->num_rows > 0) { 
                                                    foreach ($data4 as $row4) {

                                                        ?>

                                                        <tr>
                                                            <td> <input class="form-control py-3" id="studName" name="studName" value="<?php echo $row4['studName']?>" type="text" readonly placeholder="Enter comitte name" /></td>
                                                            <td><input class="form-control py-3" id="studPhone" name="studPhone" value="<?php echo $row4['studPhone']?>" type="text" readonly placeholder="Enter comitte phone" /></td>
                                                            <td><input class="form-control py-3" id="studMatric" name="studMatric" value="<?php echo $row4['studMatric']?>" type="text" readonly placeholder="Enter comitte matric" /></td>
                                                            <input type="hidden" name="progMain" value="<?php echo $row4['studID']?>">
                                                        </tr>

                                                    <?php } 

                                                }
                                                ?>
                                            </table>
                                            <table>
                                                <tr>
                                                    <th class="small mb-1">Program Sub Name</th>
                                                    <th class="small mb-1">Program Sub Phone No.</th>
                                                    <th class="small mb-1">Program Sub Matric ID</th>
                                                </tr>
                                                <?php

                                                if ($result5->num_rows > 0) { 
                                                    foreach ($data5 as $row5) {

                                                        ?>

                                                        <tr>
                                                            <td> <input class="form-control py-3" id="studName" name="studName" value="<?php echo $row5['studName']?>" type="text" readonly placeholder="Enter comitte name" /></td>
                                                            <td><input class="form-control py-3" id="studPhone" name="studPhone" value="<?php echo $row5['studPhone']?>" type="text" readonly placeholder="Enter comitte phone" /></td>
                                                            <td><input class="form-control py-3" id="studMatric" name="studMatric" value="<?php echo $row5['studMatric']?>" type="text" readonly placeholder="Enter comitte matric" /></td>
                                                               <input type="hidden" name="progSub" value="<?php echo $row5['studID']?>">
                                                        </tr>

                                                    <?php } 

                                                }
                                                ?>
                                            </table> -->
                                              <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="progChair">Program Chair</label>
                                                        <select  id="progChair" name="progChair" required="true">
                                                              <?php 
                                                            $sql3 = "SELECT * FROM program RIGHT JOIN student ON program.progChair = student.studID WHERE student.studID='$progChair'"; 
                                                            $result3 = mysqli_query($conn,$sql3);
                                                           
                                                                $test = $result3->fetch_assoc(); ?>
                                                                   <option value="<?php echo $test["studID"]; ?>" selected="selected"><?php echo $test["studMatric"];?></option>             
                                                            <?php  if ($result2->num_rows > 0) {

                                                     while($row = $result2->fetch_assoc())  {
                                                        
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
                                                            <?php 
                                                            $sql3 = "SELECT * FROM program RIGHT JOIN student ON program.progCo = student.studID WHERE  student.studID='$progCoChair'"; 
                                                            $result3 = mysqli_query($conn,$sql3);
                                                           
                                                                $test = $result3->fetch_assoc(); ?>
                                                                   <option value="<?php echo $test["studID"]; ?>" selected="selected"><?php echo $test["studMatric"];?></option>   
                                                               
                                                                   
                                                            <?php 
                                                            $sql2 = "SELECT * FROM student";
                                                            $result2 = mysqli_query($conn,$sql2);
                                                            if ($result2->num_rows > 0) {

                                                     while($row = $result2->fetch_assoc())  {
                                                        
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
                                                               <?php 
                                                            $sql3 = "SELECT * FROM program RIGHT JOIN student ON program.progMain = student.studID WHERE student.studID='$progMain'"; 
                                                            $result3 = mysqli_query($conn,$sql3);
                                                           
                                                                $test = $result3->fetch_assoc(); ?>
                                                                   <option value="<?php echo $test["studID"]; ?>" selected="selected"><?php echo $test["studMatric"];?></option>         
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
                                                              <?php 
                                                            $sql3 = "SELECT * FROM program RIGHT JOIN student ON program.progSub = student.studID WHERE student.studID='$progSub'"; 
                                                            $result3 = mysqli_query($conn,$sql3);
                                                           
                                                                $test = $result3->fetch_assoc(); ?>
                                                                   <option value="<?php echo $test["studID"]; ?>" selected="selected"><?php echo $test["studMatric"];?></option>        
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
                                            </div>
                                             <div class="form-row">
                                             <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="proof">Upload Event Proof</label><br>
                                                        <!-- <input class="form-control py-5" id="proof" name="proof" value="<?php echo $data['progProof'] ?>" type="file" placeholder="Participants number" /> -->

                                                        
                                                        <img src="<?="../proof/".$data['progProof']?>" id="proof" name="proof" alt="no_doc" width="100" height="105" border="2" overflow:hidden;><br>
	                									<input type="text" id="photoname" value="<?=$data['progProof']?>" size="10" readonly><br>
	                									<button type="button"  name="button" onclick="document.getElementById('fileName').click()">Select a file</button>
                                                        
                                                        <input type='file' name="photofile" id="fileName" style="display:none">

                                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                        <button type="button"  name="button" onclick="document.getElementById('uploadFile').click()">Upload File</button>
                                                        <input type='button' id="uploadFile" style="display:none" onclick="return readURL();">
							                
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- <input type="hidden" name="approval" id="approval" value="0"> -->
                                        <input type="submit" name="Submit" value = "Update" class="btn btn-primary btn-block">
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
                alert('Must Select a photo for upload!');
                nme.focus();
                return false;
            }
        }

    </script>
    </body>
</html> 
