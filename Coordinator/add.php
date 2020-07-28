<?php require_once '../libs/database.php';
// Escape user inputs for security
$eventname = mysqli_real_escape_string($conn, $_REQUEST['eventname']);
$eventDesc = mysqli_real_escape_string($conn, $_REQUEST['eventDesc']);
$date = mysqli_real_escape_string($conn, $_REQUEST['date']);
$merit = mysqli_real_escape_string($conn, $_REQUEST['merit']);
$location = mysqli_real_escape_string($conn, $_REQUEST['location']);
$participants = mysqli_real_escape_string($conn, $_REQUEST['participants']);
$approval = mysqli_real_escape_string($conn, $_REQUEST['approval']);
$proof = time() . $_FILES['photofile']['name'];
$progChair = mysqli_real_escape_string($conn, $_REQUEST['progChair']);
$progCoChair = mysqli_real_escape_string($conn, $_REQUEST['progCoChair']);
$progMain = mysqli_real_escape_string($conn, $_REQUEST['progMain']);
$progSub = mysqli_real_escape_string($conn, $_REQUEST['progSub']);
$coord = mysqli_real_escape_string($conn, $_REQUEST['coord']);
// $progSub = $_POST['progSub'];


$target_dir = "../proof/";

 //target file to save in directory
$target_file = $target_dir . basename($_FILES["photofile"]["name"]);

// Select file type
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Valid file extensions
$extensions_arr = array("jpg","jpeg","png","gif");
move_uploaded_file($_FILES['photofile']['tmp_name'],$target_dir.$proof);


// $t = array();
// foreach($_POST["committee"] as $committee)
//     $t[] = addslashes($committee) ;
// $t = implode("," , $t);



// Attempt insert query execution
$sql = "INSERT INTO program (coordID,progName, progDesc, progDate, progMerit, progLocation, progExpected, progProof, progApproval,progChair,progCo,progMain,progSub) VALUES ('$coord','$eventname', '$eventDesc', '$date', '$merit','$location', '$participants', '$proof', '$approval','$progChair','$progCoChair','$progMain','$progSub')";
if(mysqli_query($conn, $sql)){
    $message = "New event added!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'programList.php';</script>";
}
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
mysqli_close($conn);
?>