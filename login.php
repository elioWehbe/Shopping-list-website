<?php
session_start();
include 'config.php';
if (isset($_POST['login_user'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $username = mysqli_real_escape_string($con, $user);
    $password = mysqli_real_escape_string($con, $pass);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($con, $query);
    $count = mysqli_num_rows($results);

    if ($count == 1) {
        $_SESSION['username'] = $username;

        $queryTwo = "select * from `users` where `username`='$username'";
       $resultsTwo=mysqli_query($con,$queryTwo);
        while ($row=mysqli_fetch_array($resultsTwo)){

           if($row['userType']==1){

               header('location:index.php');

       }
           elseif ($row['userType']==2){
           header('location:selectionUser.php');
           }}
       }

    }

?>


<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>




</head>
<body>
<div class="form-box">
    <div class="head">Please Login First</div>
    <form method="post" action="login.php" id="login-form">
        <div class="form-group">
            <label class="label-control">
                <span class="label-text">Username</span>
            </label>
            <input type="username" name="username" class="form-control" />
            <span class="spin"></span>
        </div>
        <div class="form-group">
            <label class="label-control">
                <span class="label-text">Password</span>
            </label>
            <input type="password" name="password" class="form-control" />
            <span class="spin"></span>
        </div>
        <input type="submit" name="login_user" value="Login" class="btn" />
        <span class="spin"></span>
        <p class="text-p">Don't have an account? <a href="signup.php">Sign up</a> </p>
    </form>
</div>
<script type="text/javascript">

    $('.form-group input').on('focus blur', function (e) {
        $(this).parents('.form-group').toggleClass('active', (e.type === 'focus' || this.value.length > 0));
    }).trigger('blur');
</script>
</body>
</html>