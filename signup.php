
<?php
include 'config.php';

if(isset($_POST['signup'])){
$name=$_POST['user'];
$num=$_POST['phone'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$passTwo=$_POST['pass2'];
$userExist="select * from `users` where `username`='$name'";
$execute=mysqli_query($con,$userExist);
if(empty($name)){
	echo " enter name";
exit();
}
elseif(empty($num)){
echo " enter phone number";
exit();
}
elseif(empty($email)){
    echo " enter e-mail";
    exit();
}
elseif(empty($pass)){
	echo "enter password";
	exit();
	}
	elseif(empty($passTwo)) {
        echo "re-enter password";
        exit();

    }
elseif ($pass!=$passTwo){
echo "enter the same password";
        exit();

    }
if(mysqli_num_rows($execute)>=1){
    echo"name already exists";
  exit();
}
else {


    $pinCode = rand(1000, 9999);
    echo " Your Verrification code is $pinCode";
    $pin = $_POST['pin'];

    if ($pin = $pinCode) {
        $nameMod = mysqli_real_escape_string($con, $name);
        $numMod = mysqli_real_escape_string($con, $num);
        $passMod = mysqli_real_escape_string($con, $pass);
        $passMod2 = mysqli_real_escape_string($con, $passTwo);
        $pinMod = mysqli_real_escape_string($con, $pin);
        $emailMod = mysqli_real_escape_string($con, $email);
        $addUser = "INSERT INTO users(username, number, password, verrification_code,userType, mail) VALUES ('$nameMod ','$numMod','$passMod','$pinMod',1,'$emailMod')";
        mysqli_query($con, $addUser);
        $id="SELECT * from users where username='$nameMod' ";
        $que=mysqli_query($con, $id);
        while ($row=mysqli_fetch_row($que)) {
            $userId = $row[0];


        $addList="INSERT INTO  liste (nom,id) values ('Supermarche','$userId')";
        $addList2="INSERT INTO  liste (nom,id) values ('Marche','$userId')";
        $addList3="INSERT INTO  liste (nom,id) values ('Divers','$userId')";
       mysqli_query($con, $addList);
       mysqli_query($con, $addList2);
       mysqli_query($con, $addList3);
    }}
}
}?>

<html>
<head>

    <meta name="viewport" content="width=device-width initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<div class="form-box">
    <div class="head">Sign Up</div>
    <form  method="post" action="signup.php" id="login-form">
        <div class="form-group">
            <label class="label-control">
                <span class="label-text">UserName</span>
            </label>
            <input type="username" name="user" class="form-control" />
        </div>
        <div class="form-group">
            <label class="label-control">

                <span class="label-text">Email</span>
            </label>
            <input type="email" name="email" class="form-control" />
        </div>
        <div class="form-group">
            <label class="label-control">
                <span class="label-text">Password</span>
            </label>
            <input type="password" name="pass" class="form-control" />
        </div>
        <div class="form-group">
            <label class="label-control">

                <span class="label-text">Re-Enter Password</span>

            </label>
            <input type="password" name="pass2" class="form-control" />
        </div>
            <div class="form-group">
                <label class="label-control">
                    <span class="label-text">Phone Number</span>

                </label>
                <input type="phone" name="phone" class="form-control" name="signup" />
        </div>
        <input type="submit" value="Sign Up" class="btn" name="signup" />
        <div class="form-group">
            <label class="label-control">
                <span class="label-text">Verrify Code</span>

            </label>
            </body>
            <input type='pin' name="pin" class="form-control" />
        </div>
        <input type="submit" value="Verrify" class="btn" name="verrify" />

        <p class="text-p">Have an account?<a href="login.php">Login</a> </p>

</div>
<script type="text/javascript">

    $('.form-group input').on('focus blur', function (e) {
        $(this).parents('.form-group').toggleClass('active', (e.type === 'focus' || this.value.length > 0));
    }).trigger('blur');
</script>
</form>
</html>
