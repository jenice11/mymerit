<?php 

require_once '../libs/database.php';

if($_POST) {

    $eventname = $_POST['eventname'];
   
    $merit = $_POST['merit'];
    $location = $_POST['location'];
    $participants = $_POST['participants'];
    $proof = time() . $_FILES['photofile']['name'];
  
    $progChair = $_POST['progChair'];
    $progCoChair = $_POST['progCoChair'];
    $progMain = $_POST['progMain'];
    $progSub = $_POST['progSub'];

        //target file to save in directory
      $target_dir = "../proof/";
    $target_file = $target_dir . basename($_FILES["photofile"]["name"]);

        // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");
    // move_uploaded_file($_FILES['photofile']['tmp_name'],$target_dir.$proof);
    
    $id = $_POST['progID'];

// Attempt insert query execution
    if(empty($_FILES['photofile']['tmp_name'])){

            //don't update image.
            $sql =  "UPDATE program SET progName = '$eventname',  progMerit = '$merit', progLocation = '$location', progExpected = '$participants' , progChair = '$progChair', progCo = '$progCoChair', progMain = '$progMain', progSub = '$progSub' WHERE progID = '$id'";

          }

        else{
            //update image.
            if(in_array($imageFileType,$extensions_arr) ){

            $sql =  "UPDATE program SET progName = '$eventname',  progMerit = '$merit', progLocation = '$location', progExpected = '$participants', progProof = '$proof', progChair = '$progChair', progCo = '$progCoChair', progMain = '$progMain', progSub = '$progSub' WHERE progID = '$id'";


            unlink("../proof/".$oldphoto);

            move_uploaded_file($_FILES['photofile']['tmp_name'],$target_dir.$proof);

            }
          }

    if(mysqli_query($conn,$sql) === TRUE) {
        $message = "Succesfully Updated!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'editEvent.php?progID=$id&progChair=$progChair&progCoChair=$progCoChair&progMain=$progMain&progSub=$progSub';</script>";
      
    } else {
        echo "Erorr while updating record : ".  mysqli_error($conn);
    }
    
    mysqli_close($conn);

}
?>