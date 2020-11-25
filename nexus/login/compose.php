<?php
$conn=new mysqli('localhost','root','','nexus');
$to=$from=$subject=$type=$content='';
if(isset($_POST['send'])){
    $from = $_POST['from'];
    $type = $_POST['from_type'];
    $to=$_POST['to'];
    $title=$_POST['subject'];
    $content=$_POST['content'];
    $sql_worker="select * from workers where user_name='$to';";
    $result_worker=$conn->query($sql_worker);
    $sql_customer="select * from customers where user_name='$to';";
    $result_customer=$conn->query($sql_customer);
    $sql_public="select * from public where user_name='$to';";
    $result_public=$conn->query($sql_public);
    if($result_worker->num_rows!=0 || $result_customer->num_rows!=0 || $result_public->num_rows!=0){
    $sql="insert into chats(sender,receiver,title,content) values('$from','$to','$title','$content');";
    $result=$conn->query($sql);
    if($result==true){
        echo'<script>alert("message sent");</script>';
    }
    else{
        echo' '.$conn->error;
    }}
    else{
      echo'<script>alert("invalid user name");</script>';
    }
    if ($type == "contractor") {
      // code...
      echo "<script> window.open('contractor.php?user_name=$from', '_self')</script>";
    }
    if ($type == "public") {
      // code...
      echo "<script> window.open('public.php?user_name=$from', '_self')</script>";
    }
    if ($type == "worker") {
      // code...
      echo "<script> window.open('worker.php?user_name=$from', '_self')</script>";

    }
}
?>
<form action='compose.php' method='post'>
<input type="text" name="from" value="<?php echo "$username"; ?>" style="display:none">
<input type="text" name="from_type" value="<?php echo "$from_type"; ?>" style="display:none">
<label for='to'>To:</label>
<input type='text' name='to' style='border:none;outline:none;width:90%;' value=""><hr>
<label for=subject>Subject:</label>
<input type='text' name='subject' style='width:90%;outline:none;border:none;' value=""><hr>
<label for='content'>
<textarea name='content' style='width:100%;height:200px;outline:none;border:hidden;resize:none;font-weight:normal;' placeholder='content' value=''></textarea>
<input type='submit' name='send' value='send' class="btn btn-primary btn-outline-primary btn-lg btn-block" style='float:right'>
</form>
