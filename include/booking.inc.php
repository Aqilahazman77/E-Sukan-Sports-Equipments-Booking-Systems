<?php

if (isset($_POST["submit"])) {

  $equ_name = $_POST["equ_name"];
  $equ_qty = $_POST["equ_qty"];
  $equ_status = $_POST["equ_status"];

  require_once 'connection.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputEquipment($equ_name, $equ_qty, $equ_status) !== false) {
    header("location: ../php/equipment.php?error=emptyinput");
    exit();
  }

  addEquipment($conn, $equ_name, $equ_qty, $equ_status);
} else {
  header("location: ../php/equipment.php");
  exit();
}
