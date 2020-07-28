<?php
include("../authenticator.php");

  // connect to database
  $conn = mysqli_connect('localhost', 'root', '', 'mymerit');

  // Check connection
  if($conn === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  // select all admin
  $admin_query = "select * from administrator";
  $admin_result = mysqli_query($conn, $admin_query);

  // select all coordinator
  $coord_query = "select * from coordinator";
  $coord_result = mysqli_query($conn, $coord_query);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Add Coordinator</title>
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
        <?php include("sidebar.php"); ?>
            <div id="layoutSidenav_content">

              <!-- body content -->
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Add Coordinator</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Coordinator</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="mb-0">
                                  Add New Coordinator
                                </h5>
                            </div>
                        </div>

              <div class="row justify-content-center">

                <div class="col-xl-7">
                <div class="card shadow-lg border-0 rounded-lg mb-5">
                    <!-- <div class="card-header"><h4 class="text-center font-weight-light my-4">Add Admin/Coordiantor</h4></div> -->
                    <div class="card-body">
                        <form method="post" action="manageCoord.php" enctype='multipart/form-data'>
                    <div class="text-center pb-5">

                         <img src="../uploads/default.png" id="image" class="rounded" alt="no image" style="margin-bottom:20px;width:270px;height:280px">
                         <div class="row justify-content-center">
                         <table>
                           <tr>
                             <td>
                              <form>
                                 <button type="button" name="button" class="btn btn-md btn-primary" onclick="document.getElementById('fileName').click()">Select a file</button>
                                 <input type='file' name="photofile" id="fileName" style="display:none">
                               </form>
                             </td>
                           </tr>
                           <tr>
                             <td>
                               <form>
                                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                 <button type="button" name="button" class="btn btn-md btn-success mt-3" onclick="document.getElementById('uploadFile').click()">Upload Photo</button>
                                 <input type='button' id="uploadFile" style="display:none" onclick="return readURL();">
                               </form>
                             </td>
                           </tr>
                         </table>

                          <!-- <input type="hidden" id="photoname" value="" size="10" readonly> -->

                    </div>
                  </div>

                        <div class="form-group">
                            <label class="small mb-1" for="coordName">Name</label>
                            <input class="form-control py-4" id="coordName" name="coordName" type="text" placeholder="Enter name" required/>
                        </div>

                        <div class="form-group">
                            <label class="small mb-1" for="coordUsername">Username</label>
                            <input class="form-control py-4" id="coordUsername" type="text" name="coordUsername" placeholder="Enter username" required/>
                        </div>

                            <div class="form-group">
                                <label class="small mb-1" for="coordEmail">Email</label>
                                <input class="form-control py-4" id="coordEmail" name="coordEmail" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required/>
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="coordPassword">Password</label>
                                <input class="form-control py-4" id="coordPassword" name="coordPassword" type="password" placeholder="Enter password" required minlength="6" title="Six or more characters"/>
                            </div>

                            <div class="form-group mt-4 mb-0"><button class="btn btn-lg btn-primary btn-block" type="submit" name="add">Add</button></div>
                        </form>
                    </div>
                </div>
              </div>
            </div>

                    <!-- Coordinator Table -->
                    <div class="col-xl-12">
                          <div class="card mb-4">
                              <div class="card-header">
                                  <i class="fas fa-table mr-1"></i>
                                  All Coordinator
                              </div>
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                          <thead>
                                              <tr>
                                                  <th>No</th>
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Username</th>
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                          <!-- <tfoot>
                                              <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Action</th>
                                              </tr>
                                          </tfoot> -->
                                          <tbody>

                                          <?php
                                              $i = 1;
                                                    while($row = mysqli_fetch_array($coord_result)){
                                                 echo "<tr>"
                                                  . "<td>".$i."</td>"
                                                         . "<td>" .$row['coordName']."</td>"
                                                         . "<td>". $row['coordEmail']. "</td>"
                                                         . "<td>". $row['coordUsername']. "</td>";
                                                    ?>
                                                      <td>
                                                        <div class="" style="display:flex;">
                                                          <form id='delete_coord' method='post' action="manageCoord.php">
                                                            <input type='hidden' id='OrderProductID[<?=$row['coordID']?>]' name='coordID' value='<?=$row['coordID']?>'>
                                                          <button type='submit' name='delete' class='btn btn-danger' onclick="return confirm('Are you sure you want to delete?');">DELETE</button>
                                                        </form>
                                                        <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#message<?php echo $row['coordID'];?>">VIEW</button>
                                                        </div>


                                                    <!-- Modal -->
                                                   <div class="modal fade" id="message<?php echo $row['coordID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                     <div class="modal-dialog" role="document">
                                                       <div class="modal-content">
                                                          <form method="post" action="manageCoord.php" enctype='multipart/form-data'>
                                                         <div class="modal-header">
                                                           <h5 class="modal-title" id="exampleModalLabel">Coordinator Info</h5>
                                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                             <span aria-hidden="true">&times;</span>
                                                           </button>
                                                         </div>
                                                         <div class="modal-body">
                                                           <div class="table-responsive-xl">
                                                           <table class="table table-borderless">
                                                             <tr>
                                                               <td colspan="2">
                                                                 <div class="row justify-content-center">
                                                                    <div class="text-center">
                                                                   <img src="<?=$row['image']?>" id="image<?php echo $row['coordID'];?>" class="rounded" alt="..." style="margin-bottom:20px;width:270px;height:280px"onerror="this.src='uploads/default.png';">
                                                                       </div>
                                                                 <table>
                                                                   <tr><td>
                                                                     <form>
                                                                       <button type="button" name="button<?php echo $row['coordID'];?>" id="<?php echo $row['coordID'];?>" class="btn btn-md btn-primary" onclick="document.getElementById('fileName<?php echo $row['coordID'];?>').click()">Select a file</button>
                                                                       <input type='file' name="photofile<?php echo $row['coordID'];?>" id="fileName<?php echo $row['coordID'];?>" style="display:none">
                                                                     </form>
                                                                   </td></tr>

                                                                   <tr><td>
                                                                     <form>
                                                                       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                                       <button type="button" name="button<?php echo $row['coordID'];?>" id="<?php echo $row['coordID'];?>" class="btn btn-md btn-success mt-3" onclick="document.getElementById('uploadFile<?php echo $row['coordID'];?>').click()">Upload Photo</button>
                                                                       <input type='button' id="uploadFile<?php echo $row['coordID'];?>" style="display:none" onclick="return readURL<?php echo $row['coordID'];?>();">
                                                                     </form>
                                                                     </td></tr>
                                                                 </table>
                                                               </div>
                                                                </td>
                                                              </tr>
                                                              <tr>
                                                               <td><span style="font-weight:bold">Name: </span> </td>
                                                               <td><input class="form-control" type="text" name="coordName" value="<?=$row['coordName']?>"></td>
                                                             </tr>

                                                             <tr>
                                                               <td><span style="font-weight:bold">Username: </span></td>
                                                               <td><input class="form-control" type="text" name="coordUsername" value="<?=$row['coordUsername']?>"></td>
                                                             </tr>

                                                             <tr>
                                                               <td><span style="font-weight:bold">Email: </span></td>
                                                               <td><input class="form-control" type="email" name="coordEmail" value="<?=$row['coordEmail']?>"></td>
                                                             </tr>

                                                             <tr>
                                                               <td><span style="font-weight:bold">Password: </span></td>
                                                               <td><input class="form-control" type="password" id="coordPassword<?php echo $row['coordID'];?>" name="coordPassword" value="<?=$row['coordPassword']?>">
                                                               <br><input type="checkbox" onclick="myFunction<?php echo $row['coordID'];?>()"> Show Password</td>
                                                             </tr>
                                                              <input type="hidden" name="coordID" value="<?php echo $row['coordID'];?>" readonly></td>
                                                           </table>
                                                         </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                           <button type="submit" name="update" class="btn btn-secondary">UPDATE</button>
                                                         </div>
                                                      </form>
                                                       </div>
                                                     </div>
                                                   </div>
                                                     </td>

                                                     <script type="text/javascript">
                                                     function myFunction<?php echo $row['coordID'];?>() {
                                                       var x = document.getElementById("coordPassword<?php echo $row['coordID'];?>");
                                                       if (x.type === "password") {
                                                         x.type = "text";
                                                       } else {
                                                         x.type = "password";
                                                       }
                                                     }

                                                     var fileName<?php echo $row['coordID'];?>,input<?php echo $row['coordID'];?>;
                                                       var input<?php echo $row['coordID'];?> = document.getElementById( 'fileName<?php echo $row['coordID'];?>' );
                                                       input<?php echo $row['coordID'];?>.addEventListener( 'change', showFileName<?php echo $row['coordID'];?> );

                                                       function showFileName<?php echo $row['coordID'];?>( event ) {
                                                        input<?php echo $row['coordID'];?> = event.srcElement;
                                                        fileName<?php echo $row['coordID'];?> = input<?php echo $row['coordID'];?>.files[0].name;
                                                       }

                                                       function readURL<?php echo $row['coordID'];?>() {
                                                       if (input<?php echo $row['coordID'];?>.files && input<?php echo $row['coordID'];?>.files[0]) {
                                                       var reader<?php echo $row['coordID'];?> = new FileReader();

                                                         reader<?php echo $row['coordID'];?>.onload = function(e) {
                                                           $('#image<?php echo $row['coordID'];?>').attr('src', e.target.result);
                                                         }

                                                           reader<?php echo $row['coordID'];?>.readAsDataURL(input<?php echo $row['coordID'];?>.files[0]); // convert to base64 string
                                                             }
                                                         }

                                                     
                                                     </script>

                                                    <?php
                                                    echo "</tr>";
                                                    $i++;
                                                      }
                                                    ?>
                                              </tbody>
                                      </table>
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
        var fileName,input;
          var input = document.getElementById( 'fileName' );
          input.addEventListener( 'change', showFileName );

          function showFileName( event ) {
           input = event.srcElement;
           fileName = input.files[0].name;
          }

          function readURL() {
          if (input.files && input.files[0]) {
          var reader = new FileReader();

            reader.onload = function(e) {
              $('#image').attr('src', e.target.result);
            }

              reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/main.js"></script>
    </body>
</html>
