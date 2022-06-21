<?php
session_start();

$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index.html");
  exit();
}

require_once 'header.php';
require_once 'equipmentsFunction.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0" />

  <!-- ===== LINE AWESOME ICONS ===== -->
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

  <!-- ===== BOX ICONS ===== -->
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />

  <!-- ===== MAIN CSS FOR USERS ===== -->
  <link rel="stylesheet" href="../assets/css/main.css" />
  <link rel="stylesheet" href="../assets/css/shop.css" />
  <link rel="stylesheet" href="../assets/css/alert-notification.css" />

  <link rel="icon" href="../assets/img/logo MYTECC (white outline).png" />
  <title>MYTECC | Users</title>
</head>

<body>
  <?php
  if (!empty($_GET['action'])) {
    if ($_GET['action'] == 'deletesuccess') {
      echo '
        <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_warning">
              <div class="icon data_icon">
                <i class="bx bxs-error-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Warning:</span>
                  User action warning
                </p>
                <p class="sub">You have successfully deleted this equipment!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
        ';
    }
  }
  ?>
  <input type="checkbox" id="nav-toggle" />

  <!--SIDEBAR-->
  <?php require_once 'sideBar.php'; ?>

  <div class="main-content">

    <!--HEADER-->
    <?php headerBar('Equipment'); ?>

    <main>
      <!-- ===== AddEquipments ===== -->
      <section class="featured__container">
        <div class="orders">
          <div class="card">
            <div class="card-header">
              <h3> Add Equipment</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table width="100%">
                  <thead>
                    <tr>
                      <td>Equipment Name</td>
                      <td>Equipment Quantity</td>
                      <td>Equipment Status</td>
                      <td>Add Equipment</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <form action="../include/equipment.inc.php" method="post" autocomplete="off">
                        <td><input type="text" name="equ_name"></td>
                        <td><input type="text" name="equ_qty"></td>
                        <td><input type="text" name="equ_status"></td>
                        <td><input type="submit" name="submit" value="submit"></input></td>
                      </form>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
      <br>
      <!-- ===== Equipments ===== -->
      <section class="featured__container">
        <div class="orders">
          <div class="card">
            <div class="card-header">
              <?php

              require '../include/connection.inc.php';
              $sql = "SELECT COUNT('equ_name') FROM equipment";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              echo '<h3>' . $row[0] . ' Equipments found</h3>';

              ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table width="100%">
                  <thead>
                    <tr>
                      <td>Equipment Id</td>
                      <td>Equipment Name</td>
                      <td>Equipment Quantity</td>
                      <td>Equipment Status</td>
                      <td>Delete Equipment</td>
                      <td></td>
                    </tr>
                  </thead>
                  <?php

                  $result = getEquipmentDetails();
                  while ($row = mysqli_fetch_assoc($result)) {
                    dispEquipmentDetails($row['equ_id'], $row['equ_name'], $row['equ_qty'], $row['equ_status']);
                  }
                  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>

  <!-- ===== JQUERY CDN ===== -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- ===== WHATSAPP WIDGET ===== -->
  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
  <div class="elfsight-app-cb77e803-0fac-46dc-ab86-1d1dfd9b488c"></div>

  <!-- ===== MAIN JS ===== -->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/alert-notification.js"></script>
</body>

</html>