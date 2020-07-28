<?php
/*
Filename: sessionHandler.php
Purpose: To handele login information and create a session for that user
*/
  //Start session
  session_start();

  //Validation error flag
  $errflag = false;

  //Input Validations
  if($_POST['username'] == '') {
  $errmsg_arr[] = 'Login email missing';
  $errflag = true;
  }
  if($_POST['password'] == '') {
  $errmsg_arr[] = 'Password missing';
  $errflag = true;
  }

  //If thre are input validations, redirect back to the login form
  if($errflag) {
  $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
  session_write_close();
  header("location: login.php");
  exit();
  }

  // to make a connection with database
  $conn = mysqli_connect("localhost", "root", "") or die(mysqli_error());

  // to select the targeted database
  mysqli_select_db($conn, "mymerit") or die(mysqli_error());

  // to create a query to be executed in sql
  $username = $_POST['username'];
  $password = $_POST['password'];
  $category = $_POST['category'];

  if($category == 'stud'){
  $query = "SELECT * FROM student WHERE studUsername = '$username' AND studPassword = '$password'";

  //to run sql query in database
  $result = mysqli_query($conn, $query) or die(mysqli_error());

  //Check wether the query was successful or not
  if(isset($result)) {
  if(mysqli_num_rows($result) == 1) {

    //Login Succesfull
    session_regenerate_id();
    $member = mysqli_fetch_assoc($result);
    $_SESSION['studID'] = $member['studID'];
    $_SESSION['studName'] = $member['studName'];
    $_SESSION['studUsername'] = $member['studUsername'];
    $_SESSION['studEmail'] = $member['studEmail'];
    $_SESSION['studMatric'] = $member['studMatric'];
    $_SESSION['studPhone'] = $member['studPhone'];
    $_SESSION['STATUS'] = true;
    session_write_close();
    header("location: Student/studentEventList.php");
    exit();
    }
    else {
      //Login failed
      $message = "Login failed!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = 'login.php';
      </script>";
      exit();
      }
    }
}
    // if category was coordinator
    else if($category == 'coord'){
    $query = "SELECT * FROM coordinator WHERE coordUsername = '$username' AND coordPassword = '$password'";

    //to run sql query in database
    $result = mysqli_query($conn, $query) or die(mysqli_error());

    //Check wether the query was successful or not
    if(isset($result)) {
    if(mysqli_num_rows($result) == 1) {

      //Login Succesfull
      session_regenerate_id();
      $member = mysqli_fetch_assoc($result);
      $_SESSION['coordID'] = $member['coordID'];
      $_SESSION['coordUsername'] = $member['coordUsername'];
      $_SESSION['coordEmail'] = $member['coordEmail'];
      $_SESSION['STATUS'] = true;
      session_write_close();
      header("location: Coordinator/programList.php");
      exit();
      }
      else {
        //Login failed
        $message = "Login failed!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'login.php'
        </script>";
        exit();
        }
      }
    }

    else if($category == 'admin'){
    $query = "SELECT * FROM administrator WHERE adminUsername = '$username' AND adminPassword = '$password'";

    //to run sql query in database
    $result = mysqli_query($conn, $query) or die(mysqli_error());

    //Check wether the query was successful or not
    if(isset($result)) {
    if(mysqli_num_rows($result) == 1) {

      //Login Succesfull
      session_regenerate_id();
      $member = mysqli_fetch_assoc($result);
      $_SESSION['adminID'] = $member['adminID'];
      $_SESSION['adminUsername'] = $member['adminUsername'];
      $_SESSION['adminEmail'] = $member['adminEmail'];
      $_SESSION['STATUS'] = true;
      session_write_close();
      header("location: Admin/dashboard.php");
      exit();
      }
      else {
        //Login failed
        $message = "Login failed!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'login.php'
        </script>";
        // header("location: login.php");
        exit();
        }
      }
    }
      else {
      die("Query failed");
        }
      ?>
