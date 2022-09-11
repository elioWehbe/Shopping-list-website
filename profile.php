<?php
session_start();
include 'template.html';
include 'config.php';
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
$username=$_SESSION['username'];

$sql="SELECT * FROM `users` WHERE `username`='$username'";
$result=mysqli_query($con,$sql)
or die("Error: ".mysqli_error($con));
while ($row=mysqli_fetch_array($result))
{

?>


<link rel="stylesheet" type="text/css" href="style.css">
<style>
    .butt{
    background-color: #6498fe;
    border-radius: 4px;
    border: #1565c0;
    color: white;
    padding: 9px 17px;
    text-decoration: none;
    margin: 8px 4px;
    cursor: pointer;}
</style>
<title>Profile</title>
<form action="profile.php" method="post">

    <div class="form-box">
        <div class="head"><?php

            echo $_SESSION['username']; ?></div>
        <form class="form-group">
            Phone Number :<?php echo $row['number'];
            echo "<br>"; ?>
            Mail :<?php echo $row['mail'];
            echo "<br>";
            ?>

            <?php
          $userId=$row['id'];
            $name = $_SESSION['username'];
            $queryList = "select * from liste where id='$userId'";
            $listIdResult = mysqli_query($con, $queryList);
            echo "<select name='nomList' class='selectField'>";
            while ($ligne = mysqli_fetch_assoc($listIdResult)) {
                echo '<option>' . $ligne['nom'] . '</option>';
            }


            if (isset($_POST['sub'])) {
                $listName = $_POST['nomList'];
                $_SESSION['listName'] = $listName;

            }
            }



    ?>

            <input type="submit" name="sub" value="Submit" class="butt">
    </form>