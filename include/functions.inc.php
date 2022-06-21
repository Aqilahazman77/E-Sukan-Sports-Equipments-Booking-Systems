<?php

function emptyInputSignup($name, $phone, $faculty, $email, $username, $pwd, $pwdRepeat)
{
  $result = false;
  if (empty($name) || empty($phone) || empty($faculty) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function emptyInputEquipment($equ_name, $equ_qty, $equ_status)
{
  $result = false;
  if (empty($equ_name) || empty($equ_qty) || empty($equ_status)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function invalidUid($username)
{
  $result = false;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function invalidEmail($email)
{
  $result = false;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
  $result = false;
  if ($pwd !== $pwdRepeat) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function uidExists($conn, $username, $email)
{
  $sql = "SELECT * FROM user WHERE username = ? OR email = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $phone, $faculty, $email, $username, $pwd)
{
  $sql = "INSERT INTO user (name, us_phone_num, us_faculty, email, username, password, level_id) VALUES (? ,? ,? ,? ,? ,? ,'2');";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/signup.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssssss", $name, $phone, $faculty, $email, $username, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/signup.php?error=none");
  exit();
}

function addEquipment($conn, $equ_name, $equ_qty, $equ_status)
{
  $sql = "INSERT INTO equipment (equ_name, equ_qty, equ_status) VALUES (? ,? ,?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/equipment.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sss", $equ_name, $equ_qty, $equ_status);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/equipment.php?error=none");
  exit();
}

function insertUserContact($conn, $address, $postcode, $city, $phone, $state, $userId)
{
  $sql = "INSERT INTO userscontact (address, postcode, city, phoneNum, stateId, usersId)
  VALUES (?,?,?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/accounts.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssss", $address, $postcode, $city, $phone, $state, $userId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/accounts.php?action=insertsuccess");
  exit();
}

function updateUserContact($conn, $address, $postcode, $city, $phone, $state, $userId)
{

  $sql = "UPDATE userscontact SET address=?, postcode=?, city=?, phoneNum=?, stateId=? WHERE usersId=?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/accounts.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssss", $address, $postcode, $city, $phone, $state, $userId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/accounts.php?action=updatesuccess");
  exit();
}

function emptyInputLogin($username, $pwd)
{
  $result = false;
  if (empty($username) || empty($pwd)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function loginUser($conn, $username, $pwd)
{
  $uidExists = uidExists($conn, $username, $username);

  if ($uidExists === false) {
    header("location: ../php/login.php?error=invalidusernameorpwd");
    exit();
  }

  $pwdHashed = $uidExists["password"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if ($checkPwd === false) {
    header("location: ../php/login.php?error=invalidpassword");
    exit();
  } else if ($checkPwd === true) {

    session_start();
    $_SESSION["userid"] = $uidExists["user_id"];
    $_SESSION["useruid"] = $uidExists["username"];
    $_SESSION["usertypes"] = $uidExists["level_id"];
    $_SESSION["username"] = $uidExists["name"];
    $_SESSION["useremail"] = $uidExists["email"];

    if ($_SESSION["usertypes"] == 1) {

      header("location: ../php/dashboard.php?action=loginsuccess");
      exit();
    } else if ($_SESSION["usertypes"] == 2) {

      header("location: ");
      exit();
    }
  }
}

function insertOrd($conn, $size, $quantity, $orderCode, $productCode)
{
  $sql = "INSERT INTO ord (size, quantity, orderCode, productCode)
  VALUES (?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/invoice.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssss", $size, $quantity, $orderCode, $productCode);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function insertOrders($conn, $orderCode, $orderDate, $orderTime, $total, $usersId)
{
  $sql = "INSERT INTO orders (orderCode, orderDate, orderTime, orderPrice, usersId, statusId)
  VALUES (?,?,?,?,?,1);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/invoice.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sssss", $orderCode, $orderDate, $orderTime, $total, $usersId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function deleteUser($conn, $userid)
{
  $sql = "DELETE FROM user WHERE user_id = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/users.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $userid);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/users.php?action=deletesuccess");
  exit();
}

function deleteEquipment($conn, $equ_id)
{
  $sql = "DELETE FROM equipment WHERE equ_id = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/equipment.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $equ_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/equipment.php?action=deletesuccess");
  exit();
}
