<?php
if(isset($_POST['worker-submit'])){
  session_start();
  $conn = new mysqli("localhost","root","","nexus");
  if($conn->connect_error){
      die("connection didn't established");
  }
  $username = clean($_POST['username']);
  $password = clean($_POST['password']);

  $select_user = "select * from workers where user_name='$username' AND password='$password'";
  if($conn->query($select_user) == TRUE){
    $result = $conn->query($select_user);
    $check = $result->num_rows;

    if($check == 1){
      $_SESSION['user_name'] = $username;

      $get_user = mysqli_query($conn, "select * from workers where user_name='$username'");
      $user_row = mysqli_fetch_array($get_user);

      $session_user = $user_row['user_name'];
      echo "<script> window.open('login/worker.php?user_name=$session_user', '_self')</script>";
    }
    else{?>
    <script type="text/javascript">
      alert('Invalid Credentials');
    </script>
    <?php
    }
  }
}
 ?>
