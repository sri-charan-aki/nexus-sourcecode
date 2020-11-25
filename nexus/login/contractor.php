<?php
function clean($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
define('br', nl2br("\n"));
$nameerr2=$ageerr2=$phoneerr2='';

session_start();
$username = $_SESSION['user_name'];
// to update the information
if(isset($_POST['contractor-submit'])){
  $name=$age=$gender=$phone=$email=$address=$aadhar=$user=$password='';
  $name=clean($_POST['name']);
  $age=clean($_POST['age']);
  $gender=clean($_POST['gender']);
  $phone=clean($_POST['phone']);
  $address=clean($_POST['address']);
  $email=clean($_POST['email']);
  $password=clean($_POST['password']);

  if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
      $nameerr2="name should contain only letters and whitespaces";
  }
  if($age<18||$age>60){
      $ageerr2="we are  not takinng people under 18 years age and above 60 years age";
  }
  if(!preg_match("/[0-9]{10}/",$phone)){
      $phoneerr2="invalid phone number";
  }
  if($nameerr2==""&&$ageerr2==""&&$phoneerr2==""){

    $conn = new mysqli("localhost","root","","nexus");
    if($conn->connect_error){
        die("connection didn't established");
    }
    $get_user = mysqli_query($conn, "select * from customers where user_name='$username'");
    $user_row = mysqli_fetch_array($get_user);
    $session_password=$user_row['password'];
    if($password==$session_password){
    $user_update = "update customers set name='$name', age='$age', gender='$gender', phone_number='$phone', address='$address', email='$email' where user_name='$username' ";
    $update = mysqli_query($conn, $user_update);}
    else{ ?>
    <script type="text/javascript">
      alert('wrong password try again with correct password');
    </script>
    <?php
    }
  }
  else {
    echo $nameerr2 ;
    echo $ageerr2 ;
    echo $phoneerr2;
  }


}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>nexus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="one-third col-md-4">
      <?php
      $conn = new mysqli("localhost","root","","nexus");
      $get_user = mysqli_query($conn, "select * from customers where user_name='$username'");
      $user_row = mysqli_fetch_array($get_user);
      $session_user = $user_row['user_name'];
      $session_name = $user_row['name'];
      // $session_bio = $user_row['bio'];
      $session_age = $user_row['age'];
      $session_gender = $user_row['gender'];
      $session_aadhar = $user_row['aadhar'];
      $session_contact = $user_row['phone_number'];
      $session_email = $user_row['email'];
      $session_address = $user_row['address'];

       ?>
       <h3>Your Details</h3>
      <div class="table-bordered">
        <table id='details' class="table">
          <!-- to show his details -->

          <tr>
            <td><strong>Name: </strong> </td>
            <td><span> <?php echo $session_name; ?></span></td>
          </tr>
          <tr>
            <td><strong>Age: </strong> <span></td>
            <td><?php echo $session_age; ?></span></td>
          </tr>
          <tr>
            <td><strong>Gender: </strong></td>
            <td><span> <?php echo $session_gender; ?></span></td>
          </tr>
          <tr>
            <td><strong>Aadhar: </strong> </td>
            <td><span> <?php echo $session_aadhar; ?></span></td>
          </tr>
          <tr>
            <td><strong>Contact: </strong> <span></td>
            <td> <?php echo $session_contact; ?></span></td>
          </tr>
          <tr>
            <td><strong>E-mail: </strong></td>
            <td> <span> <?php echo $session_email; ?></span></td>
          </tr>
          <tr>
            <td><strong>Address:</strong> </td>
            <td><span><?php echo $session_address; ?></span></td>
          </tr>
        </table>
        <button class="btn btn-outline-dark btn-lg btn-block"type="submit" id="edit-button" onclick="edit()">edit details</button>
      </div>

       <br><br>
      <!-- after clicking edit details button -->
      <form id="edit-details" action="contractor.php?user_name=<?php echo $username;?>" method="post" style="display: none;">
        <div class="form-group row">
          <label for='name' class="col-sm-2 col-form-label">name</label>
          <div class="col-sm-10">
            <input type='text' name='name' class="form-control" required value="<?php echo $session_name; ?>"><br>
          </div>
        </div>
        <div class="form-group row">
          <label for="age" class="col-sm-2 col-form-label">age</label>
          <div class="col-sm-10">
            <input type='number' name='age' class="form-control" required value="<?php echo $session_age; ?>"><br>
          </div>
        </div>
        <div class="form-group row">
          <label for='gender' class="col-sm-2 col-form-label">gender</label>
          <div class="col-sm-10">
            <select class="custom-select" name="gender" required>
              <option value='male'>male</option>
              <option value='female'>female</option>
              <option value='others'>others</option>
            </select><br><br>
          </div>
        </div>
        <div class="form-group row">
          <label for='phone' class="col-sm-2 col-form-label">phone number</label>
          <div class="col-sm-10">
            <input type='text' name='phone' class="form-control" required value="<?php echo $session_contact; ?>"><br>
          </div>
        </div>
        <div class="form-group row">
          <label for='email' class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type='email' name='email'class="form-control" required value='<?php echo $session_email; ?>'><br><br>
          </div>
        </div>
        <div class="form-group row">
          <label for='address' class="col-sm-2 col-form-label">address</label>
          <div class="col-sm-10">
            <textarea name='address' class="form-control" required><?php echo $session_address; ?></textarea><br><br>
          </div>
        </div>
        <div class="form-group row">
          <!-- <label for="password" class="col-sm-2 col-form-label">enter your password to update</label> -->
          <div class="col-sm-10">
            <input type="password" class="form-control" name="password" value="" placeholder="Enter password to proceed" required>
          </div>
        </div>
        <input type='submit' name='contractor-submit' class="btn btn-outline-dark" value='submit'><br>
      </form>


      <!-- php for add workers -->
      <?php
      if(isset($_POST['add-worker'])){
        $conn = new mysqli("localhost","root","","nexus");
        $new_worker = clean($_POST['new-worker-id']);
        $new_worker_details = "select * from workers where user_name = '$new_worker'";
        $run_worker_details = mysqli_query($conn, $new_worker_details);
        $row_worker_details = mysqli_fetch_array($run_worker_details);
        if ($row_worker_details) {
          if ($row_worker_details['customer'] == 'NULL') {
            $worker_update = mysqli_query($conn, "UPDATE workers SET customer = '$username' WHERE user_name = '$new_worker'");
          }
          else {?>
          <script type="text/javascript">
            alert("already working under another contractor");
          </script>
        <?php }}
          else { ?>
            <script type="text/javascript">
              alert("no such worker exist");
            </script>

      <?php } }?>

      <!-- add worker -->
      <form id="add-worker" action="contractor.php?user_name=<?php echo $username;?>" method="post">
        <div class="form-group row">
          <div class="col-md-6">
            <input type="text" name="new-worker-id" value="" placeholder="Enter worker id" required>
          </div>
          <div class="col-md-2">
            <input type='submit' name='add-worker' class="btn btn-outline-dark" value='add worker'><br>
          </div>
        </div>
      </form>


      <h3>Your workers</h3>
      <!-- to get workers details -->
      <?php
      if(isset($_POST['worker-details'])){

        $conn = new mysqli("localhost","root","","nexus");
        $get_username = $_POST['worker-user-name'];
        $get_user = "select * from workers where user_name = '$get_username'";
        $run_user = mysqli_query($conn, $get_user);
        $row_user = mysqli_fetch_array($run_user);
        $get_phone = $row_user['phone_number'];
        $get_name = $row_user['name'];
        $get_username = $row_user['user_name'];
        $get_age = $row_user['age'];
        $get_gender = $row_user['gender'];
        $get_address = $row_user['address'];
        $get_aadhar = $row_user['aadhar'];
        $get_skillset = $row_user['skill_set'];
        $get_semiskillset = $row_user['semi_skill_set'];
        // $get_rating = $row_user['rating'];


      ?>

    <?php } ?>

      <?php
      $get_workers = mysqli_query($conn, "select * from workers where customer='$session_user'");
      $i = 0;
      while($workers = mysqli_fetch_array($get_workers)){  //to show all the worker names
      $i += 1;
      ?>


      <form class="" action="contractor.php" method="post">
        <input type="text" name="i" value="<?php echo $i; ?>" style="display:none">
        <input type="text" name="worker-user-name" value="<?php echo $workers['user_name']; ?>" style="display:none">
        <input type="submit" class="btn btn-primary btn-sm btn-block" name="worker-details" value="<?php echo $workers['name']; ?>" >


      </form>
      <!-- after clicking on worker names..... -->
      <?php if(isset($_POST['worker-details'])){ ?>
      <?php if($_POST['i'] == $i ){ ?>
      <div id="about-worker" style="display:none">
        <img src="arrow-back-ios.png" onclick="worker_detail_close()" style="cursor:pointer">
        <div class="table-bordered">
          <table class="table">
            <tr>
                <td>
                  <strong>Name: </strong>
                </td>
                <td><?php echo $get_name; ?></td>
            </tr>
            <tr>
              <td>
                <strong>Age: </strong>
              </td>
              <td><?php echo $get_age; ?></td>
            </tr>
            <tr>
              <td>
                <strong>Gender: </strong>
              </td>
              <td><?php echo $get_gender; ?></td>
            </tr>
            <tr>
              <td>
                <strong>Aadhar: </strong>
              </td>
              <td><?php echo $get_aadhar; ?></td>
            </tr>
            <tr>
              <td>
                <strong>Contact: </strong>
              </td>
              <td><?php echo $get_phone; ?></td>
            </tr>
            <tr>
              <td>
                <strong>Address: </strong>
              </td>
              <td><?php echo $get_address; ?></td>
            </tr>
            <tr>
              <td>
                <strong>user name: </strong>
              </td>
              <td><?php echo $get_username; ?></td>
            </tr>
          </table>

        </div>
      </div>

      <script type="text/javascript">
      document.getElementById('about-worker').style.display = 'block';
      </script>
    <?php } ?>
  <?php } }?>
  </div>
  <div class="col-md-6">
    <h3>Mail Box</h3>
    <div class="btn-group btn-group-toggle">
      <button type="button" name="button" class="btn btn-secondary-active" onclick="inbox()">Inbox</button>
      <button type="button" name="button" class="btn btn-secondary" onclick="outbox()">Outbox</button>
      <button type="button" name="button" class="btn btn-secondary" onclick="compose()">Compose</button>
    </div>
    <div id="inbox">
      <?php include 'inbox.php'; ?>
    </div>
    <div id="outbox" style="display:none">
      <?php include 'outbox.php'; ?>
    </div>
    <div id="compose" style="display:none">
      <?php
      $from_type = "contractor";
      include 'compose.php'; ?>
    </div>

  </div>
    <!-- for logout -->
    <div class="logout col-md-2">
      <form class="" action="logout.php" method="post">
        <input type="submit" class="btn btn-danger btn-md"name="logout" value="logout">
      </form>
    </div>


    <script type="text/javascript">
      function edit() {
        document.getElementById('details').style.display = 'none';
        document.getElementById('edit-button').style.display = 'none';
        document.getElementById('edit-details').style.display = 'block';
      }
      function worker_detail_close() {
        //document.getElementById('workers-list').style.display = 'block';
        document.getElementById('about-worker').style.display = 'none';
      }
      function inbox() {
        document.getElementById('inbox').style.display = 'block';
        document.getElementById('outbox').style.display = 'none';
        document.getElementById('compose').style.display = 'none';
      }
      function outbox() {
        document.getElementById('inbox').style.display = 'none';
        document.getElementById('outbox').style.display = 'block';
        document.getElementById('compose').style.display = 'none';
      }
      function compose() {
        document.getElementById('inbox').style.display = 'none';
        document.getElementById('outbox').style.display = 'none';
        document.getElementById('compose').style.display = 'block';
      }


    </script>
  </body>
</html>
