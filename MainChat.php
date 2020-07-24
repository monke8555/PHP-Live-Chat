<?php
  session_start();
  $_SESSION['un'] = $_GET['un'];
  $_SESSION['pwd'] = $_GET['pwd'];
  $uns = $_SESSION['un'];
  $pwd = $_SESSION['pwd'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="pragma" content="no-cache">
    <?php
    if (empty($uns)) {
      echo '<meta http-equiv = "refresh" content = "0; url = /Chat.php?unswr=yes">';
      // So that no one can use without password
      // unswr means username, password wrong
      // see Chat.php:41; it says wrong password or username if it is set
    }
    ?>
    <script>
      // so that when page reloads post remains intact
      function set() {
        var hidden = document.getElementById("hidden");
        var inner = "<form id='fo' method='post'>\n</input type='hidden' value='"+<?php echo '"'.$uns.'"'; ?>+"'>\n</form>"
        hidden.innerHTML = inner;
        document.getElementById("fo").submit();
      }

      // messages are sent with cookies
      function setcookie(val) {
        const regex = /\n/gi;
        var valrep = val.replace(regex, "<br>");
        document.cookie = "msg=" + valrep + ";path=/";
        set();
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Chat</title>
    <link rel="stylesheet" href="NonHTML/CSS/Style2.css" type="text/css">
    <script src="NonHTML/JS/main.js"></script>
  </head>
  <body class="lb" onunload="set()">
  <iframe src="/msgs.html" width="100%" height="350" frameBorder="0"></iframe>
  <!-- it uses iframes for messages -->
  <form method="post" id="chat">

  <div class="content">
  <textarea style="margin-left:2%" name="msg" id="msg" cols="75" rows="3" placeholder="Your message goes here..."></textarea>
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <div class="dropup" style="float:right;position:relative;right:0px;">
  <button class="dropbtn">Additions</button>
    <div class="dropup-content">
      <a onclick="openForm('image')">Image</a>
      <a onclick="openForm('fonts')">Fonts</a>
      <a onclick="additions('italic')">Italic</a>
      <a onclick="additions('bold')">Bold</a>
      <a onclick="additions('codeSnippet')">Code Snippet</a>
    </div>
  </div>
  </div>
  </form>
<div class="form-popup" id="fonts">
  <form class="form-container">
    <h1>Fonts</h1>
      <div class="vertical-menu">
        <a onclick="addFont(this)">Andale Mono</a>
        <a onclick="addFont(this)">Arial</a>
        <a onclick="addFont(this)">Bodoni</a>
        <a onclick="addFont(this)">Calibri</a>
        <a onclick="addFont(this)">Calisto MT</a>
        <a onclick="addFont(this)">Cambria</a>
        <a onclick="addFont(this)">Candara</a>
        <a onclick="addFont(this)">Century Gothic</a>
        <a onclick="addFont(this)">Consolas</a>
        <a onclick="addFont(this)">Copperplate Gothic</a>
        <a onclick="addFont(this)">Courier New</a>
        <a onclick="addFont(this)">Didot</a>
        <a onclick="addFont(this)">Franklin Gothic</a>
        <a onclick="addFont(this)">Georgia</a>
        <a onclick="addFont(this)">Gill Sans</a>
        <a onclick="addFont(this)">Helvetica</a>
        <a onclick="addFont(this)">Impact</a>
        <a onclick="addFont(this)">Optima</a>
        <a onclick="addFont(this)">Palatino</a>
        <a onclick="addFont(this)">Perpetua</a>
        <a onclick="addFont(this)">Rockwell</a>
        <a onclick="addFont(this)">Segoe UI</a>
        <a onclick="addFont(this)">Tahoma</a>
        <a onclick="addFont(this)">Trebuchet MS</a>
        <a onclick="addFont(this)">Verdana</a>
      </div>
      <br>
    <button type="button" class="cancelbtn" onclick="closeForm('fonts')">Close</button>
  </form>
</div>
<div class="form-popup" id="image">
  <form class="form-container">
    <h1>Send an image</h1>
    <input type="url" placeholder="Enter the image's url" id="imgurl" size="24" autocomplete="off">
    <br>
    <br>
    <button type="button" class="cancelbtn" onclick="addImage(this.form.imgurl.value)">Add</button>
    <br>
    <br>
    <button type="button" class="cancelbtn" onclick="closeForm('image')">Close</button>
  </form>
</div>
<script src="NonHTML/JS/main.js"></script>
<script>
  function chval() {
    document.getElementById("msg").value += "<br>";
  }

  $('textarea').on('keydown', function(event) {
    if (event.keyCode == 13)
      if (!event.shiftKey) $('#chat').submit();
      else if (event.shiftKey = true) {
    }
  });
  $('#chat').on('submit', function() {
    setcookie(document.getElementById('msg').value);
  });
  </script>
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
    $unp = $_GET['un'];
    $querymy = mysqli_query($conn, "SELECT UN, PWD FROM chat WHERE UN = '$unp'");
    while ($row = mysqli_fetch_assoc($querymy)) {
        if (password_verify($_GET['pwd'], $row["PWD"]) && !empty($row["PWD"])) {
        } else {
          echo "<script>location.href='Chat.php?unswr=yes'</script>";
        }
    }
    if (mysqli_num_rows($querymy)!=1) {
      echo "<script>location.href='Chat.php?unswr=yes'</script>";
    }
    if ($querymy) {
      mysqli_num_rows($querymy);
      echo "<script>console.log(\"Success\");</script>";
    } else {
      echo "<script>console.log(\"Error: " . $sql . mysqli_error($conn)."\");</script>";
    }


    $msg = $_COOKIE['msg'];
    $toput = "  <div id='msg' class='a'><h5><b><i>&nbsp&nbsp&nbspFrom ".$_SESSION['un']." at ".gmdate("M d Y H:i")."<br></i></b></h5>"."<p>".$msg."</p></div><br>\n";
    if (strlen($msg) > 0) {
      file_put_contents('msgs.html', $toput, FILE_APPEND);
    } else {}

    mysqli_close($conn);
    echo $_POST['hidden'];
  ?>
  <div id="hidden"></div>
  </body>
</html>
