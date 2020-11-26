<style media="screen">
.worker-box:hover{
  box-shadow: 5px 10px 2px 2px #767c77;
}
</style>
<?php
if(isset($_POST['search'])){
  $work=$_POST['working'];}
else {
  $work = '';
}
?>
<form action="public.php" method='post'>
<input type="text" name='working' required value="<?php echo $work; ?>">

<input type='submit' name='search' value='search'>
</form>
<?php
$conn=new mysqli('localhost','root','','nexus');
if($conn->connect_error){
    die('unable to connect');
}
else{
    if(isset($_POST['search'])){
        $work=$_POST['working'];
        $sql="select * from workers where skill_set like '%$work%' or semi_skill_set like '%$work%';";
        $result=$conn->query($sql);
        $i=-1;
        while($row=$result->fetch_assoc()){
            $i+=1; ?>
        <div class="worker-box">
          <table>
            <tr>
              <td>
              <h3><?php echo $row['name']; ?></h2>
              <p>Location: <?php echo $row['address']; ?></p>
              <p>Skills: <?php echo $row['skill_set']; ?></p>
              <p>Semi-skills: <?php echo $row['semi_skill_set']; ?></p>
              <p>Age: <?php echo $row['age']; ?></p>

            </td>
              <input type="text" name="worker-user-id" class="worker-user-id" value="<?php echo $row['user_name'];?>" style="display:none">
              <td>
                <button type="button" name="button" class="btn btn-info" onclick="worker_msg(<?php echo $i; ?>)">message</button>
                <br>
                <br>
                <p>Contact: <?php echo $row['phone_number']; ?></p>
              </td>
            </tr>
          </table>
        </div>
       <?php
    }
    if ($i == -1) { ?>
      <h5>Currently we dont have workers from this category.</h5>
      <h5>We'll try to add in future.</h5>
    <?php
    }
}}
?>

<script>
  function worker_msg(k){
    var worker_user_name = document.getElementsByClassName('worker-user-id');
    document.getElementById('inbox').style.display = 'none';
    document.getElementById('outbox').style.display = 'none';
    document.getElementById('compose').style.display = 'block';
    document.getElementById('to').value = worker_user_name[k].value;
  }
</script>
