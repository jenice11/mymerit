<?php require_once '../db_connect.php';
// Escape user inputs for security
$eventname = mysqli_real_escape_string($link, $_REQUEST['eventname']);
$eventDesc = mysqli_real_escape_string($link, $_REQUEST['eventDesc']);
$date = mysqli_real_escape_string($link, $_REQUEST['date']);
$merit = mysqli_real_escape_string($link, $_REQUEST['merit']);
$location = mysqli_real_escape_string($link, $_REQUEST['location']);
$participants = mysqli_real_escape_string($link, $_REQUEST['participants']);
// $proof = mysqli_real_escape_string($link, $_REQUEST['proof']);
$approval = mysqli_real_escape_string($link, $_REQUEST['approval']);
// $proof = mysqli_real_escape_string($link, time() . $_FILES['photofile']['name']);
$proof = time() . $_FILES['photofile']['name'];


$target_dir = "../proof/";

        //target file to save in directory
$target_file = $target_dir . basename($_FILES["photofile"]["name"]);

        // Select file type
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
$extensions_arr = array("jpg","jpeg","png","gif");
move_uploaded_file($_FILES['photofile']['tmp_name'],$target_dir.$proof);


$t = array();
foreach($_POST["committee"] as $committee)
    $t[] = addslashes($committee) ;
$t = implode("," , $t);


// $data = array();
// foreach($_POST["Hobby"] as $hobby)
//     $data[] = addslashes($hobby);
// $data = implode("," , $data);

// Attempt insert query execution
$sql = "INSERT INTO program (progName, progDesc, progDate, progMerit, progLocation, progExpected, progProof, progApproval,studMatric) VALUES ('$eventname', '$eventDesc', '$date', '$merit','$location', '$participants', '$proof', '$approval','$t')";
if(mysqli_query($link, $sql)){
    $message = "New event added!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'programList.php';</script>";
}
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>