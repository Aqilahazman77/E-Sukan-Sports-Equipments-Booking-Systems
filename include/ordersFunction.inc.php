<?php

function getOrders()
{
  require '../include/connection.inc.php';

  $sql = "SELECT booking.boo_id, equipment.equ_name, sn.serialNum, user.name, guarantor.gua_name, booking.bookDate, booking.returnDate, booking.approvedDate,
  booking.boo_status
  FROM booking
  JOIN equipment ON equipment.equ_id = booking.equ_id
  JOIN sn ON sn.sn_id = booking.sn_id
  JOIN user ON user.user_id = booking.user_id
  JOIN guarantor on guarantor.gua_id = booking.gua_id";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function getOrdersDashboard()
{
  require '../include/connection.inc.php';

  $sql = "SELECT equipment.equ_name, sn.serialNum, equipment.equ_qty, user.name, booking.boo_status
  FROM booking
  JOIN sn ON sn.sn_id = booking.sn_id
  JOIN equipment ON equipment.equ_id = booking.equ_id
  JOIN user ON user.user_id = booking.user_id
  ORDER BY booking.bookDate DESC";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function Orders($orderCode, $usersName, $address, $postcode, $city, $state, $price, $status)
{
  $color = '';
  if ($status == 'pending') {
    $color = 'color:#ffbb33';
  } else if ($status == 'processing') {
    $color = 'color:#33b5e5';
  } else if ($status == 'delivered') {
    $color = 'color:#00c851';
  } else if ($status == 'failed') {
    $color = 'color:#eb6060';
  }

  $element = '
  <tbody>
    <tr style="border-bottom: 1px solid #f0f0f0;">
      <form method="post" action="../php/invoice-users">
        <td><input type="hidden" name="invoice" value="' . $orderCode . '"><button type="submit" name="submit" style="width:100%;border:none;font-weight:500;cursor:pointer;background-color:#fff;">' . $orderCode . '</button></input></td>
        <td>' . $usersName . '</td>
        <td>' . $address . ', ' . $postcode . ', ' . $city . ', ' . $state . '</td>
        <td>RM' . $price . '</td>
        <td style="' . $color . ';font-weight:600;">' . $status . '</td>
      </form>
      <form action="../include/orders.inc.php" method="post">
        <td style="margin-top:1rem;width:16%;">  
          <select name="status" class="text-box">
            <option value="1">pending</option>  
            <option value="4">failed</option>  
            <option value="2">processing</option>  
            <option value="3">delivered</option> 
          <select>
          <input type="hidden" name="invoice" value="' . $orderCode . '">
          <button type="submit" name="update" class="inv-btn">update</button>
        </td>
        <td style="padding:30px;">
          <button type="submit" name="delete" style="border:none;background-color:#fff;"><i class="bx bx-trash" style="font-size:1.1rem;cursor:pointer;"></i></button>
        </td>
      </form>
    </tr>
  </tbody>
  ';
  echo $element;
}

function dispOrdersDashboard($productName, $serialNum, $quantity, $usersName, $status)
{
  $color = '';
  if ($status == 'Pending') {
    $color = 'color:#ffbb33';
    $colors = 'orange';
  } else if ($status == 'Approved') {
    $color = 'color:#00c851';
    $colors = 'green';
  } else if ($status == 'Denied') {
    $color = 'color:#eb6060';
    $colors = 'red';
  }

  $element = '

  <tbody>
    <tr>
      <td>' . $productName . '</td>
      <td style="text-align:center;">' . $serialNum . '</td>
      <td style="text-align:center;">' . $quantity . '</td>
      <td>' . $usersName . '</td>
      <td style="' . $color . ';font-weight:600;"><span class="status ' . $colors . '"></span>' . $status . '</td>
    </tr>
  </tbody>

  ';
  echo $element;
}

function dispOrders($boo_id, $productName, $serialNum, $name, $guarantor, $bookingDate, $returnDate, $approvedDate, $status)
{
  $color = '';
  if ($status == 'Pending') {
    $color = 'color:#ffbb33';
    $colors = 'orange';
  } else if ($status == 'Approved') {
    $color = 'color:#00c851';
    $colors = 'green';
  } else if ($status == 'Denied') {
    $color = 'color:#eb6060';
    $colors = 'red';
  }

  $element = '

  <tbody>
    <tr>
      <td>' . $boo_id . '</td>
      <td style="text-align:center;">' . $productName . '</td>
      <td style="text-align:center;">' . $serialNum . '</td>
      <td style="text-align:center;">' . $name . '</td>
      <td>' . $guarantor . '</td>
      <td>' . $bookingDate . '</td>
      <td style="text-align:center;">' . $returnDate . '</td>
      <td style="text-align:center;">' . $approvedDate . '</td>
      <td style="' . $color . ';font-weight:600;"><span class="status ' . $colors . '"></span>' . $status . '</td>
      <input type="hidden" name="equ_id" value="' . $boo_id . '"></input>
        <td style="text-align:center"><button type="submit" name="delete" style="border:none;background-color:#fff;"><i class="bx bx-trash" style="font-size:1.1rem;cursor:pointer;"></i></button></td>
        <td></td>
    </tr>
  </tbody>

  ';
  echo $element;
}

function getInvoiceUsersDetails($conn, $orderCode)
{
  $sql = "SELECT orders.orderCode, orders.orderDate, orders.orderTime, orders.orderPrice,
  users.usersName, users.usersEmail,
  usersContact.phoneNum, usersContact.address, usersContact.postcode, usersContact.city, state.stateName
  FROM orders
  JOIN users ON users.usersId = orders.usersId
  JOIN usersContact ON usersContact.usersId = users.usersId
  JOIN state ON state.stateId = usersContact.stateId
  WHERE orders.orderCode = '$orderCode';";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function getInvoiceOrderDetails($conn, $orderCode)
{
  $sql = "SELECT product.productName, product.price, ord.size, ord.quantity
  FROM ord
  JOIN orders ON orders.orderCode = ord.orderCode
  JOIN product ON product.productCode = ord.productCode
  WHERE orders.orderCode = '$orderCode';";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function updateOrder($conn, $statusId, $orderCode)
{
  $sql = "UPDATE orders SET statusId=? WHERE orderCode =?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/ordersAdmin?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $statusId, $orderCode);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/ordersAdmin?action=updatesuccess");
  exit();
}

function getOrdersUser($conn, $usersId)
{
  $sql = "SELECT product.productImg, product.productName, product.price,
  ord.size, ord.quantity, orders.orderDate, ord.orderCode, status.statusName
  FROM ord
  JOIN product ON product.productCode = ord.productCode
  JOIN orders ON orders.orderCode = ord.orderCode
  JOIN status ON status.statusId = orders.statusId
  JOIN users ON users.usersId = orders.usersId
  WHERE users.usersId = '$usersId';";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function deleteOrder($conn, $orderCode)
{
  $sql = "DELETE FROM orders WHERE orderCode = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/ordersAdmin?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $orderCode);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/ordersAdmin?action=deletesuccess");
  exit();
}
