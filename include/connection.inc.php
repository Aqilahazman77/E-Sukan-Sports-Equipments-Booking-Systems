<?php
/* php& mysqldb connection file */
$user = "root"; //mysqlusername
$pass = ""; //mysqlpassword
$host = "localhost"; //server name or ipaddress
$dbname= "sukandb"; //your db name

$conn= mysqli_connect($host, $user, $pass, $dbname);

if(!$conn) {
  die("Connection Failed:".mysqli_connect_error());
}
?>