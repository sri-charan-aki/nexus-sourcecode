<?php
function clean($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
$name=$age=$gender=$phone=$email=$address=$aadhar=$user=$password='';
$nameerr3=$ageerr3=$phoneerr3='';

session_start();
$username = $_SESSION['user_name'];
if(isset($_POST['public-submit'])){
    $name=$age=$gender=$phone=$email=$address=$password='';
    $name=clean($_POST['name']);
    $age=(int)clean($_POST['age']);
    $gender=clean($_POST['gender']);
    $phone=clean($_POST['phone']);
    $address=clean($_POST['address']);
    $email=clean($_POST['email']);
    $password=clean($_POST['password']);

    if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
        $nameerr3="name should contain only letters and whitespaces";
    }
    if($age<18){
        $ageerr3="you are not eligible as you are less than 18 years old";
    }
    if(!preg_match("/[0-9]{10}/",$phone)){
        $phoneerr3="invalid phone number";
    }

    if($nameerr3==""&&$ageerr3==""&&$phoneerr3==""){

      $conn = new mysqli("localhost","root","","nexus");
      if($conn->connect_error){
          die("connection didn't established");
      }
      $get_user = mysqli_query($conn, "select * from public where user_name='$username'");
      $user_row = mysqli_fetch_array($get_user);
      $session_password=$user_row['password'];
      if($password==$session_password){
      $user_update = "update public set name='$name', age='$age', gender='$gender', contact='$phone', address='$address', email='$email' where user_name='$username' ";
      $update = mysqli_query($conn, $user_update);}
      else{?>
      <script type="text/javascript">
        alert('wrong password try again with correct password');
      </script>
      <?php}
    }
    else {
      echo $nameerr3 ;
      echo $ageerr3  ;
      echo $phoneerr3;
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
        $get_user = mysqli_query($conn, "select * from public where user_name='$username'");
        $user_row = mysqli_fetch_array($get_user);
        $session_user = $user_row['user_name'];
        $session_name = $user_row['name'];
        // $session_bio = $user_row['bio'];
        $session_age = $user_row['age'];
        $session_gender = $user_row['gender'];
        $session_aadhar = $user_row['aadhar'];
        $session_contact = $user_row['contact'];
        $session_email = $user_row['email'];
        $session_address = $user_row['address'];
      ?>
      <h3>Your Details</h3>
      <div class="table-bordered">
        <table id='details' class="table">

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
        <button type="submit" class="btn btn-outline-dark btn-lg btn-block" id="edit-button" onclick="edit()">edit details</button>
      </div>


      <form id="edit-details" action="public.php?user_name=<?php echo $username;?>" method="post" style="display: none;">
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
        <input type='submit' name='public-submit' class="btn btn-outline-dark" value='submit'><br>
      </form>
      </form>
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
        $from_type = "public"; 
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
