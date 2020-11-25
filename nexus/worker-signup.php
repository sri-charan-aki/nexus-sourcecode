<?php
function clean($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
$name=$age=$gender=$phone=$address=$skill=$semi=$aadhar=$user=$password='';
$nameerr1=$ageerr1=$phoneerr1=$aadharerr1=$success1='';
if(isset($_POST['worker-submit'])){
    $name=$age=$gender=$phone=$address=$skill=$semi=$aadhar=$user=$password='';
    $name=clean($_POST['name']);
    $age=(int)clean($_POST['age']);
    $gender=clean($_POST['gender']);
    $phone=clean($_POST['phone']);
    $address=clean($_POST['address']);
    $skill=clean($_POST['skill']);
    $semi=clean($_POST['semi-skill']);
    $aadhar=clean($_POST['aadhar']);
    $user=clean($_POST['user']);
    $password=clean($_POST['password']);

    if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
        $nameerr1="name should contain only letters and whitespaces";
    }
    if($age<18||$age>60){
        $ageerr1="we are  not taking people under 18 years age and above 60 years age";
    }
    if(!preg_match("/[0-9]{10}/",$phone)){
        $phoneerr1="invalid phone number";
    }
    if(!preg_match("/[0-9]{12}/",$aadhar)){
        $aadharerr1="invalid aadhar number";
    }
    if($nameerr1==""&&$ageerr1==""&&$phoneerr1==""&&$aadharerr1==""){
        $conn=new mysqli("localhost","root","","nexus");
        if($conn->connect_error){
            die("connection didn't established");
        }
        $sql="insert into workers(name,age,gender,phone_number,address,skill_set,
        semi_skill_set,aadhar,user_name,password,customer) values('$name','$age','$gender','$phone','$address','$skill','$semi','$aadhar','$user','$password','null');";
        if($conn->query($sql)==TRUE){ ?>
          <script type="text/javascript">
            alert("Your account has been created, please login");
            window.open('index.php', '_self');
          </script>
        <?php
        }
        else{$success1=$conn->error;}
    }
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>worker-signup.php</title>
     <link rel="stylesheet" href="signup-styles.css">
     <link rel="icon" href="favicon.ico">
   </head>
   <body>
     <?php require 'header.php'; ?>
     <h1 id="heading">WORKER SIGNUP</h1>
     <div class="after" id="worker" >
       <form action="worker-signup.php" method='POST'>
       <label for='name'>name</label>
       <input type='text' name='name' value='<?php echo $name; ?>'required><br>
       <h3 class="red"><?php echo $nameerr1;?></h3><br>
       <label for="age">age</label>
       <input type='number' name='age' value="<?php echo $age; ?>"required><br>
       <h3 class="red"><?php echo $ageerr1;?></h3><br>
       <label for='gender' required>gender</label>
       <select name="gender" required>
       <option value='male'>male</option>
       <option value='female'>female</option>
       <option value='others'>others</option>
       </select><br><br>
       <label for='phone'>phone number</label>
       <input type='text' name='phone' value="<?php echo $phone; ?>"required><br>
       <h3 class="red"><?php echo $phoneerr1;?></h3><br>
       <label for='address'>address</label>
       <textarea name='address' placeholder='enter your address here' value="<?php echo $address; ?>" required></textarea><br><br>
       <label for='skill'>skill set</label>
       <textarea name='skill' placeholder='enter your skills' required value="<?php echo $skill; ?>"></textarea><br><br>
       <label for='semi-skill'>semi-skill set</label>
       <textarea name='semi-skill' placeholder='enter your semi-skills' required value="<?php echo $semi; ?>"></textarea><br><br>
       <label for='aadhar'>aadhar number</label>
       <input type='text' name='aadhar' value="<?php echo $aadhar ?>"required><br>
       <h3 class="red"><?php echo $aadharerr1;?></h3><br>
       <label for='user'>user name</label>
       <input type='text' name='user' required><br><br>
       <label for='password'>password</label>
       <input type='text' name='password' required><br><br>
       <input type='submit' name='worker-submit' value='submit'><br>
       <h3 class="green"><?php echo $success1;?></h3><br><br>
       </form>
     </div>
   </body>
 </html>
