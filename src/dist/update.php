<?php 

require_once '../db_connect.php';

if($_POST) {
    $eventname = $_POST['eventname'];
    //$eventDesc = $_POST['eventDesc'];
    // $date = $_POST['date'];
    $merit = $_POST['merit'];
    $location = $_POST['location'];
    $participants = $_POST['participants'];
    // list($progID, $oldphoto) = explode("-", $_POST['data'], 2); 
    $proof = time() . $_FILES['photofile']['name'];
    $target_dir = "../proof/";

        //target file to save in directory
    $target_file = $target_dir . basename($_FILES["photofile"]["name"]);

        // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");
    move_uploaded_file($_FILES['photofile']['tmp_name'],$target_dir.$proof);
    
    $id = $_POST['progID'];

    // $t = array();
    // foreach($_POST["title"] as $title){
    //     $t[] = addslashes($title) ;
    // }
    // $t = implode("," , $t);


    // $data = array();
    // foreach($_POST["Hobby"] as $hobby){
    //     $data[] = addslashes($hobby);
    // }
    // $data = implode("," , $data);
// Attempt insert query execution
    
    $sql = "UPDATE program SET progName = '$eventname',  progMerit = '$merit', progLocation = '$location', progExpected = '$participants', progProof = '$proof' WHERE progID = '$id'";
    if($link->query($sql) === TRUE) {
        $message = "Succesfully Updated!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'editEvent.php?progID=$id';</script>";
        // echo "<a href='edit.php?progID=".$id."'><button type='button'>Back</button></a>";
        // echo "<a href='programList.php'><button type='button'>Home</button></a>";
    } else {
        echo "Erorr while updating record : ". $link->error;
    }
    
    $link->close();

}
?>