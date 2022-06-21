
<?php

if (($_SESSION["usertypes"]) == 1) {

  $item = '
  <li>
    <a href="dashboard.php" class="Active">
    <span class="bx bx-category"></span><span> Dashboard</span></a>
  </li>
  <li>
    <a href="users.php" class="Active">
    <span class="las la-users"></span><span> Users</span></a>
  </li>
  <li>
    <a href="equipment.php" class="Active">
    <span class="las la-users"></span><span> Equipments</span></a>
  </li>
  <li>
    <a href="ordersAdmin.php" class="Active">
    <span class="bx bx-basket"></span><span> Bookings</span></a>
  </li>';
} else if (($_SESSION["usertypes"]) == 2) {

  $item = '
  <li>
    <a href="shop" class="Active">
    <span class="bx bx-store"></span><span> Shop</span></a>
  </li>
  <li>
    <a href="ordersUser" class="Active">
    <span class="bx bx-basket"></span><span> Orders</span></a>
  </li>
  <li>
    <a href="accounts" class="Active">
    <span class="bx bx-user-circle"></span><span> Accounts</span></a>
  </li>
  ';
}

echo '
<div class="sidebar">
  <div class="sidebar-brand">
    <h2>
      <span class="la-ESSBS"><img src="../assets/img/JSP.png" class="sidebar-logo width="60" height="60" /></span>
      <span>ESSBS</span>
    </h2>
  </div>

  <div class="sidebar-menu" id="sidebar-menu" class="active">
    <ul class="sidebarMenu">
    ' . $item . '
    </ul>
    <ul>
      <li>
        <a href="../include/logout.inc.php" class="logout-icon">
        <span class="bx bx-log-out"></span><span> Log Out</span></a>
      </li>
    </ul>
  </div>
</div>';
