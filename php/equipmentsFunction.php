<?php

//get users from the database
function getEquipment()
{
  require '../include/connection.inc.php';

  $sql = "SELECT * FROM equipment";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    return $result;
  }
}

//get users join usersContact from the database
function getEquipmentDetails()
{
  require '../include/connection.inc.php';

  $sql = "SELECT equ_id, equ_name, equ_qty, equ_status
  FROM equipment";
  $result = mysqli_query($conn, $sql);
  return $result;
}

//display users details at users.php
function dispEquipmentDetails($equ_id, $equ_name, $equ_qty, $equ_status)
{
  $element = '
  <form method="post" action="../include/delete.inc.equipment.php">
    <tbody>
      <tr style="border-bottom: 1px solid #f0f0f0;">
        <td style="padding:27px;">' . $equ_id . '</td>
        <td>' . $equ_name . '</td>
        <td>' . $equ_qty . '</td>
        <td>' . $equ_status . '</td>
        <input type="hidden" name="equ_id" value="' . $equ_id . '"></input>
        <td style="text-align:center"><button type="submit" name="delete" style="border:none;background-color:#fff;"><i class="bx bx-trash" style="font-size:1.1rem;cursor:pointer;"></i></button></td>
        <td></td>
      </tr>
    </tbody>
  </form>
  ';
  echo $element;
}
