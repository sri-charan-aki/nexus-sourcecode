  <?php
      $msg_id = $_POST['msg_id'];
      $conn = new mysqli("localhost","root","","nexus");
      $sql = "UPDATE chats SET deleted_by_sender = '1' WHERE msg_id = '$msg_id'";
      if(mysqli_query($conn,$sql)==TRUE){
          echo 'message deleted';
      }
      else{
        echo 'message not deleted';
      }
    ?>
