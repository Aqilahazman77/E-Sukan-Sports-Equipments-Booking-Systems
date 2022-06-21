<?php

if (isset($_POST["submit"])) {

  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $faculty = $_POST["faculty"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdRepeat"];

  require_once 'connection.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignup($name, $phone, $faculty, $email, $username, $pwd, $pwdRepeat) !== false) {
    header("location: ../php/signup.php?error=emptyinput");
    exit();
  }
  if (invalidUid($username) !== false) {
    header("location: ../php/signup.php?error=invalidusername");
    exit();
  }
  if (invalidEmail($email) !== false) {
    header("location: ../php/signup.php?error=invalidemail");
    exit();
  }
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../php/signup.php?error=passwordsdontmatch");
    exit();
  }
  if (uidExists($conn, $username, $email) !== false) {
    header("location: ../php/signup.php?error=usernametaken");
    exit();
  }

  createUser($conn, $name, $phone, $faculty, $email, $username, $pwd);
} else {
  header("location: ../php/signup.php");
  exit();
}
