<?php
// connect to database
$conn = mysqli_connect('localhost', 'root', '', 'mymerit');

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['add'])){



    // add function
    $coordName = $_POST['coordName'];
    $coordEmail = $_POST['coordEmail'];
    $coordUsername = $_POST['coordUsername'];
    $coordPassword = $_POST['coordPassword'];


    $query = "select * from coordinator where coordEmail ='".$coordEmail."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) <= 0) {



      // add image function
      $target_file = basename($_FILES["photofile"]["name"]);

      // Select file type
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Valid file extensions
      $extensions_arr = array("jpg","jpeg","png","gif");

      // Check extension
      if( in_array($imageFileType,$extensions_arr) ){

        // Convert to base64
        $image_base64 = base64_encode(file_get_contents($_FILES['photofile']['tmp_name']) );
        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;





    $querys = "insert into coordinator(coordName,coordUsername,coordEmail,coordPassword,image)
      values('$coordName','$coordUsername','$coordEmail','$coordPassword','$image')";



      if(mysqli_query($conn, $querys)) {
        $message = "Success Register!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'admin_add.php';
        </script>";
        exit();
      }
    } else {
        echo 'ERROR' . mysqli_error($conn);
      }

      } else {
        $message = "Already Registered!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'admin_add.php';
        </script>";
        exit();
      }
  }


// update function
  if(isset($_POST['update'])) {

    $coordName = $_POST['coordName'];
    $coordEmail = $_POST['coordEmail'];
    $coordUsername = $_POST['coordUsername'];
    $coordPassword = $_POST['coordPassword'];
    $coordID = $_POST['coordID'];

    // add image function
    $target_file = basename($_FILES["photofile".$coordID]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){

      // Convert to base64
      $image_base64 = base64_encode(file_get_contents($_FILES['photofile'.$coordID]['tmp_name']) );
      $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

    $sql = "UPDATE coordinator SET coordName='$coordName', coordEmail='$coordEmail', coordEmail='$coordEmail',
     coordPassword='$coordPassword', image='$image' WHERE coordID = '$coordID' ";

    if(mysqli_query($conn, $sql)) {
      $message = "Success Update!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = 'admin_add.php';</script>";

    }
      }else {
        echo "Error update record: " . mysqli_error($conn);
    }
}

    // delete function
    if(isset($_POST['delete'])) {
      $coordID = $_POST['coordID'];

      $query = "DELETE FROM coordinator WHERE coordID = '$coordID' ";

      if (mysqli_query($conn, $query)) {
        $message = "Success Delete!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'admin_add.php';
        </script>";
      } else {
          echo "Error deleting record: " . mysqli_error($conn);
      }
    }


?>
