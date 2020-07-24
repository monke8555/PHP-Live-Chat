<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="pragma" content="no-cache">
    <!-- Because caching causes errors sometimes -->
    <link rel="stylesheet" href="NonHTML/CSS/Style2.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="NonHTML/JS/main.js"></script>
    <script>
      // Functions to show and hide the password
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
    <title>Login</title>
  </head>
  <body class="lb">
  <form method="get" action="MainChat.php">
  <br>
  <br>
  <input maxlength="30" type="text" name="un" placeholder="Enter your username" size="35" style="display:block;margin-left:auto;margin-right:auto;" onkeypress="return event.charCode != 32;" required>
  <br>
  <div style="display:block;margin-left:35%;margin-right:35%;">
  <input type="password" name="pwd" placeholder="Enter your password (numbers only!)" size="35" maxlength="30" onkeyup="this.value=this.value.replace(/[^0-9]+/g, '')" required>
  <button type="button" onclick="show(this)">Show</button>
  </div>
  <br>
  <input id="submit" type="submit" style="display:block;margin-left:auto;margin-right:auto;" value="Log In">
  </form>
  <?php
    if (isset($_GET['unswr'])) {
      echo "<p style='font-size:50px;'><b><i>You have entered a wrong username or password. Please try again.</i></b></p>";
    }

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
    $unp = $_POST['un'];
    $query = mysqli_query($conn, "SELECT UN, PWD FROM chat WHERE UN = '$unp'");
    while ($row = mysqli_fetch_assoc($query)) {
        if (password_verify($_POST['pwd'], $row["PWD"])) {
          echo '<p style="text-align:center;font-size:25px;">Correct Password! Redirecting.</p>';
          sleep(2.5);
          echo '<form method="post" action="/MainChat.php"><input type="hidden" value="'.$row["UN"].'" name="un"><input type="submit" id="submitb"></form>';
          echo '<script>document.getElementById("submitb").click()</script>';
        } else {
          echo "Wrong Password or Username!";
        }
    }
    if ($query) {
      mysqli_num_rows($query);
      echo "<script>console.log(\"Success\");</script>";
    } else {
      echo "<script>console.log(\"Error: " . $sql . mysqli_error($conn)."\");</script>";
    }
  ?>
  </body>
</html>
