<!DOCTYPE html>
<html lang="en">
  <head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126708478-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-126708478-3');
</script>

    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="pragma" content="no-cache">
    <link rel="shortcut icon" href="Images/favicon.png">
    <link rel="stylesheet" href="NonHTML/CSS/Style2.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="NonHTML/JS/main.js"></script>
    <script>
      function show(par) {
        par.form.pwd.type = 'text';
        par.innerHTML = 'Hide';
        par.setAttribute('onClick', 'hide(this)');
      }

      function hide(par2) {
        par2.form.pwd.type = 'password';
        par2.innerHTML = 'Show';
        par2.setAttribute('onClick', 'show(this)');
      }
    </script>
    <title>Sign Up</title>
    <style>
    a {
      text-decoration: none;
      font-size: 12px;
      color: #484848;
      font-family: monospace;
    }

    .crt {
      text-align: center;
      font-size: 12px;
      font-family: monospace;
      color: #484848;
    }
    </style>
  </head>
  <body class="lb">
  <form method="get">
  <br>
  <br>
  <input maxlength="30" type="text" name="uns" placeholder="Enter your username" size="35" style="display:block;margin-left:auto;margin-right:auto;" onkeypress="return event.charCode != 32;" required>
  <br>
  <div style="display:block;margin-left:35%;margin-right:35%;">
  <input type="password" name="pwds" placeholder="Enter your password (numbers only!)" size="30" maxlength="30" onkeyup="this.value=this.value.replace(/[^0-9]+/g, '')" required>
  <button type="button" onclick="show(this)">Show</button>
  </div>
  <br>
  <input id="submit" type="submit" style="display:block;margin-left:auto;margin-right:auto;" value="Sign Up"><br>
  <div class="crt">
    Already a user?
    <a href="Chat.php">Log In</a>
  </div>
  </form>
  <?php
    // Create connection
    $conn = new mysqli("localhost", "root", "password", "world");

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } else {
      echo "<js>";
      echo "\n<script>console.log('Connection to MySQL Database Successful')</script>";
      echo "\n</js>";
      echo "\n";
    }
    $uns = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['uns']));
    $pwds = htmlspecialchars(mysqli_real_escape_string($conn, password_hash($_GET['pwds'], PASSWORD_BCRYPT)));
    // htmlspecialchars for extra-precaution (user doesn't enter tags like <>)
    if (isset($uns) && isset($pwds)) {
      $query = mysqli_query($conn, "INSERT INTO chat (UN, PWD) VALUES ('$uns', '$pwds')");
      if ($query) {
        echo "<script>console.log(\"Success\");</script>";
      } else {
        echo "<script>console.log(\"Error: " . $sql . mysqli_error($conn)."\");</script>";
      }
    } else {}
  ?>
  </body>
</html>
