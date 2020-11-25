
    <?php
      $msg_id = $_POST['msg_id'];
      $conn = new mysqli("localhost","root","","nexus");
      $sql = "select * from chats where msg_id = '$msg_id'";
      $result = mysqli_query($conn,$sql);
      $row_user = mysqli_fetch_array($result);
      echo $row_user['title'];
    ?>
