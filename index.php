<?php
session_start();
include 'config.php';
include 'template.html';
//error_reporting(0);

//check if user is logged in
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

//get the name of user
$name = $_SESSION['username'];

//get the id of user
$sqlId = "SELECT id FROM users WHERE username='$name'";
$executeId = mysqli_query($con, $sqlId);
while ($row = mysqli_fetch_row($executeId)) {
    $id = $row[0];

}

if(isset($_POST['insert'])) {
    $allowed = array('png', 'jpeg', 'jpg');
    $filename = $_FILES['file']['name'];
    $text = pathinfo($filename, PATHINFO_EXTENSION);
    //Start upload image
    $filepath = "image/item/";
    $rand1 = rand(1, 1000000); //299
    $target_path1 = $filepath . $rand1 . basename($_FILES['file']['name']);
    if (basename($_FILES['file']['name']) <> "") {
        $var1 = $rand1 . basename($_FILES['file']['name']);
        $filepath = "image/item/" . $var1;
    }

    echo "<br>";
    $date = date("Y-m-d h:i:sa");
    $nameItem = $_POST['itemName'];
    $prix = $_POST['prix'];
    $quantity = $_POST['quantity'];
    $listeType=$_POST['nomList'];
    $idList="select listeId from liste where id='$id' and nom='$listeType'";

    $que=mysqli_query($con,$idList);
    while ($ligneListeId=mysqli_fetch_assoc($que)){
    $lignelisteId = $ligneListeId['listeId'];
}
    $nameItemSec = mysqli_real_escape_string($con, $nameItem);
    $prixSec = mysqli_real_escape_string($con, $prix);
    $quantitySec = mysqli_real_escape_string($con, $quantity);
    $priceInt = intval($prixSec);
    $quantityInt = intval($quantitySec);
    $price = $prixSec * $quantitySec;
    $price = intval($price);





    if (in_array($text, $allowed)) {
        move_uploaded_file($_FILES['file']['tmp_name'], $target_path1);
        $query = "INSERT INTO item (itemName, prixUnitaire, quantity, prixTotal, image, listeId,date) VALUES ('$nameItemSec','$priceInt','$quantityInt','$price','$filepath','$lignelisteId', '$date')";

        $queryEx = mysqli_query($con, $query) or die(mysqli_error($con));

        if($queryEx!=0){
            $Succ="Item inserted sucesfully";
            echo "<h1>$Succ</h1>";
        }
        else{
            echo "Failure";
        }
    }
}


?>



<style>
    .resp-table-caption {

        font-size: 30px;
        text-align: center;
    }
    .table-body-cell{
        display: table-cell;
    }
    0

    .choose{
        background-color: #6498fe;
        border-radius: 4px;
        border: #1565c0;
        color: white;
        padding: 16px 32px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
    }
    .file{
        border: 5px solid #6498fe;
        height: 100%;

    }
    .butt{


        background-color: #6498fe;
        border-radius: 4px;
        border: #1565c0;
        color: white;
        padding: 9px 17px;
        text-decoration: none;
        margin: 8px 4px;
        cursor: pointer;}
    .inputF{
        width: 100%;

    }


</style>
<form method="post" action="index.php" enctype="multipart/form-data" >
    <div class="resp-table" >
        <div class="resp-table-caption" >Add an item</div>
        <div id="resp-table-body">
            <div class="border">
                <div class="table-body-cell">  Item Name:&nbsp;&nbsp; </div><div class="table-body-cell"><input type="text" align="left" name="itemName" class="inputF"></div></div>

            <div class="table-body-cell">      Prix :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </div><div class="table-body-cell"><input type="number" align="left" name="prix" class="inputF"><br></div></div>

        <div class="table-body-cell"> Quantity : &nbsp;&nbsp;&nbsp;&nbsp;</div><div class="table-body-cell"> <input type="number" align="left" name="quantity" class="inputF"><br></div></div>
    <div class="table-body-cell"> List Name:&nbsp;&nbsp;
        <?php
        $queryList = "select * from liste where id='$id'";
        $listIdResult = mysqli_query($con, $queryList);
        echo "<select name='nomList' class='selectField'>";
        while ($ligne = mysqli_fetch_assoc($listIdResult)) {
            echo '<option>' . $ligne['nom'] . '</option>';
        }


        ?>
    </div>

<br>





    <div class="table-body-cell">   <input type="file" name="file"  capture="camera" class="file" ><br></div>

    <div class="table-body-cell">  <input type="submit" name="insert" value="Insert" class="butt"></div></form>



</div>
