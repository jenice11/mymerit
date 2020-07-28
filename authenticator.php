<?php
/*Filename: authenticator(user).php
Purpose: To verify user identity in accessing this website.
Note: Include this file in every protected page to avoid
unauthorized user enter.
*/
  //Start session
  session_start();

  //Check wether the login status is true or not
  if(!isset($_SESSION['STATUS']) || !$_SESSION['STATUS'] == true) {
  header("location: ../login.php");
  exit();
  }
?>
