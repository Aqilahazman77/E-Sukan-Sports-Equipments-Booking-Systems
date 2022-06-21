<?php
session_start();

if (isset($_POST['delete'])) {

  $equ_id = $_POST["equ_id"];

  require_once 'connection.inc.php';
  require_once 'functions.inc.php';

  deleteEquipment($conn, $equ_id);
} else {
  header("location: ../php/equipment.php");
  exit();
}
