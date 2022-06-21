<?php 
include ("../login/session.php");
session_start();

if (!isset($_SESSION['username'])) {
       header('Location: ../login');
		} 
		
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
<!-- form style -->
* {box-sizing: border-box}

/* Full-width input fields */
  input[type=text], input[type=password] {
  width: 30%;
  padding: 15px;
  margin: 5px 0 2px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 20.5%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}




<!-- file style -->
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 6px 6px 32px;
  text-decoration: none;
  font-size: 18px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 200px; /* Same as the width of the sidenav */
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div class="sidenav">
  <a href="#">About</a>
  <a href="#">Cake</a>
  <a href="#">Cookies</a>
  <a href="#">Contact</a>

  <!--<a href="../signup/index.html">SignUp</a>-->
  <a href="#">Personal Data</a>
   <ul>
     <li><a href="viewuser.php">View</a></li>
	 <li><a href="#">Update</a></li>
   </ul>
  <a href="#">Order</a>
    <ul>
     <li><a href="#">View</a></li>
	 <li><a href="#">Update</a></li>
   </ul>
   
   <a href="../login/logout.php">Logout</a>
  
</div>

<div class="main">
  <h2>Cake House</h2>
  <p>&nbsp;</p>
</div>

<div class="main">
<h3>WELCOME <?php echo $_SESSION['username'];?></h3>


   
   
</div>
   
</body>
</html> 


























