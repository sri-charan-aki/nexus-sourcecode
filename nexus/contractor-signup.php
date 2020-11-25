<?php
function clean($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
$name=$age=$gender=$phone=$email=$address=$aadhar=$user=$password='';
$nameerr2=$ageerr2=$phoneerr2=$aadharerr2=$success2='';
if(isset($_POST['contractor-submit'])){
    $name=$age=$gender=$phone=$email=$address=$aadhar=$user=$password='';
    $name=clean($_POST['name']);
    $age=clean($_POST['age']);
    $gender=clean($_POST['gender']);
    $phone=clean($_POST['phone']);
    $address=clean($_POST['address']);
    $email=clean($_POST['email']);
    $aadhar=clean($_POST['aadhar']);
    $user=clean($_POST['user']);
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
    if(!preg_match("/[0-9]{12}/",$aadhar)){
        $aadharerr2="invalid aadhar number";
    }
    if($nameerr2==""&&$ageerr2==""&&$phoneerr2==""&&$aadharerr2==""){
        $conn=new mysqli("localhost","root","","nexus");
        if($conn->connect_error){
            die("connection didn't established");
        }
        $sql="insert into customers(name,age,gender,phone_number,address,email,aadhar,user_name,password) values('$name','$age','$gender','$phone','$address','$email','$aadhar','$user','$password');";
        if($conn->query($sql)==TRUE){
            $success2="data inserted successfully.<a href='index.php'>click here to login</a>";
        }
        else{$success2=$conn->error;}
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>contractor-signup</title>
    <link rel="stylesheet" href="signup-styles.css">
    <link rel="icon" href="favicon.ico">
  </head>
  <body>
    <?php require 'header.php'; ?>
    <h1 id="heading">CONTRACTOR SIGNUP</h1>
    <div class="after">
      <form action='contractor-signup.php' method='POST'>
      <label for='name'>name</label>
      <input type='text' name='name' required value="<?php echo $name; ?>"><br>
      <h3 class="red"><?php echo $nameerr2;?></h3><br>
      <label for="age">age</label>
      <input type='number' name='age' required value="<?php echo $age; ?>"><br>
      <h3 class="red"><?php echo $ageerr2;?></h3><br>
      <label for='gender'>gender</label>
      <select name="gender" required>
      <option value='male'>male</option>
      <option value='female'>female</option>
      <option value='others'>others</option>
      </select><br><br>
      <label for='phone'>phone number</label>
      <input type='text' name='phone' required value="<?php echo $phone;?>"><br>
      <h3 class="red"><?php echo $phoneerr2;?></h3><br>
      <label for='email'>Email</label>
      <input type='email' name='email' required><br><br>
      <label for='address'>address</label>
      <textarea name='address' placeholder='enter your address here' required></textarea><br><br>
      <label for='aadhar'>aadhar number</label>
      <input type='text' name='aadhar' required value="<?php echo $aadhar; ?>"><br>
      <h3 class="red"><?php echo $aadharerr2;?></h3><br>
      <label for='user'>user name</label>
      <input type='text' name='user' required><br><br>
      <label for='password'>password</label>
      <input type='text' name='password' required><br><br>
      <input type='submit' name='contractor-submit' value='submit'><br>
      <h3 class="green"><?php echo $success2;?></h3><br><br>
      </form>
    </div>

  </body>
</html>
