<?php
session_start();

$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index");
  exit();
}

require_once 'header.php';
require_once 'usersFunction.php';
require_once '../include/ordersFunction.inc.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dashboard</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ===== LINE AWESOME ICONS ===== -->
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

  <!-- ===== BOX ICONS ===== -->
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />

  <!-- ===== MAIN CSS ===== -->
  <link rel="stylesheet" href="../assets/css/main.css" />
  <link rel="stylesheet" href="../assets/css/alert-notification.css" />

  <!-- ===== MDL ===== -->
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css" />

</head>

<body>
  <?php
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'loginsuccess') {
      echo '
          <div class="alert_wrapper active1">
            <div class="alert_backdrop"></div>
            <div class="alert_inner">
              <div class="alert_item alert_success">
                <div class="icon data_icon">
                  <i class="bx bxs-check-circle" ></i>
                </div>
                <div class="data">
                  <p class="title"><span>Success:</span>
                    User action success
                  </p>
                  <p class="sub">You have successfully Log In.</p>
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
    <?php headerBar('Dashboard'); ?>

    <main>
      <div class="cards">
        <div class="card-single">
          <div>
            <?php

            require '../include/connection.inc.php';
            $sql = "SELECT COUNT(name) FROM user WHERE level_id = 2";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            echo '<h1>' . $row[0] . '</h1>';

            ?>
            <span>Users</span>
          </div>
          <div>
            <span class="las la-users"></span>
          </div>
        </div>

        <div class="card-single">
          <div>
            <?php

            require '../include/connection.inc.php';
            $sql = "SELECT COUNT(boo_id) FROM booking";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            echo '<h1>' . $row[0] . '</h1>';

            ?>
            <span>Booking</span>
          </div>
          <div>
            <span class="bx bx-basket"></span>
          </div>
        </div>

        <div class="card-single">
          <div>
            <?php

            require '../include/connection.inc.php';
            $sql = "SELECT COUNT(equ_id) FROM equipment";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            echo '<h1>' . $row[0] . '</h1>';

            ?>
            <span>Equipments</span>
          </div>
          <div>
            <span class="bx bx-store"></span>
          </div>
        </div>
      </div>

      <div class="recent-grid">
        <div class="orders">
          <div class="card">
            <div class="card-header">
              <h3>Recent Bookings</h3>

              <button><a href="ordersAdmin.php" style="color:#fff;">See all<span class="bx bx-right-arrow-alt"></span></a></button>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table width="100%">
                  <thead>
                    <tr>
                      <td>Equipment Name</td>
                      <td>Serial Number</td>
                      <td>Quantity</td>
                      <td>Customers</td>
                      <td>Booking Status</td>
                    </tr>
                  </thead>
                  <?php

                  $result = getOrdersDashboard();
                  while ($row = mysqli_fetch_assoc($result)) {
                    dispOrdersDashboard($row['equ_name'], $row['serialNum'], 1, $row['name'], $row['boo_status']);
                  }

                  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="customers">
          <div class="card">
            <div class="card-header">
              <h3>Users</h3>

              <button><a href="users.php" style="color:#fff;">See all<span class="bx bx-right-arrow-alt"></span></a></button>
            </div>

            <?php

            $result = getUsersDetailsDashboard();
            while ($row = mysqli_fetch_assoc($result)) {
              users($row['username'], $row['level_desc'], $row['email'], $row['us_phone_num']);
            }

            ?>
          </div>
        </div>
      </div>
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