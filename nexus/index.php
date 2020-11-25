<?php
function clean($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }
require 'login/public-login.php';
require 'login/contractor-login.php';
require 'login/worker-login.php';

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles/index-styles.css">
    <link rel="icon" href="favicon.ico">
  </head>
  <body>
    <?php require 'header.php'; ?>
     <div class="main">
      <div class="one-third" onclick="worker()" id="worker-button"style="cursor: pointer">
        <h1>I'M</h1>
        <h1>A</h1>
        <h1>WORKER</h1>
      </div>
      <div class="one-third" id="worker" style="display: none">
        <form class="" action="index.php" method="POST">
          <label for='username'></label>
          <input type="text" name='username' placeholder="username"><br><br>
          <label for='password'></label>
          <input type='password' name='password' placeholder="password"><br><br>
          <input type='submit' value='login' name='worker-submit'>
        </form>
        <p>new here?<a href="signup.php">signup</a></p>
      </div>

      <div class="one-third" onclick="contractor()" id="contractor-button"style="cursor: pointer">
        <h1>I'M</h1>
        <h1>A</h1>
        <h1>CONTRACTOR</h1>
      </div>

      <div class="one-third" id="contractor" style="display: none">
        <form class="" action="index.php" method="POST">
          <label for='username'></label>
          <input type="text" name='username' placeholder="username"><br><br>
          <label for='password'></label>
          <input type='password' name='password' placeholder="password"><br><br>
          <input type='submit' value='login' name='contractor-submit'>
        </form>
        <p>new here?<a href="signup.php">signup</a></p>
      </div>

      <div class="one-third" onclick="public()" id="public-button"style="cursor: pointer">
        <h1>I</h1>
        <h1>WANT TO</h1>
        <h1>HIRE</h1>
      </div>




       <div class="one-third" id="public" style="display: none">
         <form class="" action="index.php" method="POST">
           <label for='username'></label>
           <input type="text" name='username' placeholder="username"><br><br>
           <label for='password'></label>
           <input type='password' name='password' placeholder="password"><br><br>
           <input type='submit' value='login' name='public-submit'>
         </form>
         <p>new here?<a href="signup.php">signup</a></p>
       </div>
     </div>
       <script type="text/javascript">
         function worker() {
           document.getElementById('worker-button').style.display = 'none'
           document.getElementById('worker').style.display = 'inline-block'
           document.getElementById('contractor-button').style.display = 'inline-block'
           document.getElementById('contractor').style.display = 'none'
           document.getElementById('public-button').style.display = 'inline-block'
           document.getElementById('public').style.display = 'none'
         }
         function contractor() {
           document.getElementById('worker-button').style.display = 'inline-block'
           document.getElementById('worker').style.display = 'none'
           document.getElementById('contractor-button').style.display = 'none'
           document.getElementById('contractor').style.display = 'inline-block'
           document.getElementById('public-button').style.display = 'inline-block'
           document.getElementById('public').style.display = 'none'
         }
         function public(){
           document.getElementById('worker-button').style.display = 'inline-block'
           document.getElementById('worker').style.display = 'none'
           document.getElementById('contractor-button').style.display = 'inline-block'
           document.getElementById('contractor').style.display = 'none'
           document.getElementById('public-button').style.display = 'none'
           document.getElementById('public').style.display = 'inline-block'
         }


       </script>
  </body>
</html>
<?php include 'footer.php'; ?>
