<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- ===== CSS ===== -->
  <link rel="stylesheet" href="../assets/css/login.css" />
  <link rel="stylesheet" href="../assets/css/login-nav.css" />
  <link rel="stylesheet" href="../assets/css/alert-notification.css" />

  <!-- ===== BOX ICONS ===== -->
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />

  <title>Document</title>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css" />
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
  <!-- Always shows a header, even in smaller screens. -->
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">Title</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation. We hide it in small screens. -->
        <nav class="mdl-navigation mdl-layout--large-screen-only">
          <a class="mdl-navigation__link" href="">Link</a>
          <a class="mdl-navigation__link" href="../php/login.php">Log In</a>
          <a class="mdl-navigation__link" href="../php/signup.php">Sign Up</a>
          <a class="mdl-navigation__link" href="">Link</a>
        </nav>
      </div>
    </header>
    <main class="mdl-layout__content">
      <div class="page-content">
        <div class="container" id="container">
          <div class="form-container sign-in-container">
            <form action="../include/signup.inc.php" method="post" autocomplete="off">
              <h1>Sign Up</h1>
              <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
              </div>
              <span>or use our in house solution</span>
              <input type="name" name="name" placeholder="Full Name" />
              <input type="phone" name="phone" placeholder="Phone number" />
              <input type="faculty" name="faculty" placeholder="Faculty" />
              <input type="email" name="email" placeholder="Email" />
              <input type="username" name="username" placeholder="Username" />
              <input type="password" name="pwd" placeholder="Password" />
              <input type="password" name="pwdRepeat" placeholder="Repeat Password" />
              <input type="submit" name="submit" class="login__button" value="Sign Up"></input>
            </form>
          </div>
          <div class="overlay-container">
            <div class="overlay"></div>
          </div>
        </div>
      </div>
      <?php

      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Fill all the required fields!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        } else if ($_GET["error"] == "invalidusername") {
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Invalid Username!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        } else if ($_GET["error"] == "invalidemail") {
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Invalid Email!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        } else if ($_GET["error"] == "passwordsdontmatch") {
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Password does not match!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        } else if ($_GET["error"] == "usernametaken") {
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Ops sorry, but this username has already been taken!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        } else if ($_GET["error"] == "stmtfailed") {
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Something when wrong. Try again!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        } else if ($_GET["error"] == "none") {
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
                <p class="sub">you have successfully Sign Up.</p>
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
    </main>
  </div>
  <!-- ===== JQUERY CDN ===== -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- ===== LOGIN JS ===== -->
  <script type="text/javascript" src="../assets/js/signup.js"></script>
  <script type="text/javascript" src="../assets/js/login-nav.js"></script>
  <script src="../assets/js/alert-notification.js"></script>
</body>

</html>