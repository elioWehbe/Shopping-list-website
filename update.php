<?php
session_start();
include 'template.html';
include 'config.php';
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}
global $itemId;
if (isset($_GET['itemId'])) {

$itemId = $_GET['itemId'];

$putVal = "SELECT * FROM item where itemId='$itemId'";
echo $putVal;

$putValu = mysqli_query($con, $putVal);
while ($putValue = mysqli_fetch_assoc($putValu)) {

    $itemName = $putValue['itemName'];
    $itemPrix = $putValue['prixUnitaire'];
    $itemQuantity = $putValue['quantity'];

}

?>
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
<form method="get" action="update.php">
    <input type="hidden" name="itemId" value="<?php echo $itemId; ?>"> <br>
    Item Name : <input type='text' name='itemName' value="<?php echo $itemName; ?>"><br>
    Item Quantity:<input type='text' name='itemQuantity' value="<?php echo $itemQuantity; ?>"><br>
    Item Price:<input type='text' name='itemQuantity' value="<?php echo $itemPrix; ?>"><br>
    <input type="submit" value="Update" name="sub" class="butt">

    <?php
    }
    if (isset($_GET['sub'])) {

        echo 'test';
        $itemNameUp = $_GET['itemName'];
        $itemQuantityUp = $_GET['itemQuantity'];
        $itemPriceUp = $_GET['itemQuantity'];
        $itemId = $_GET['itemId'];
        $itemNameUpd = mysqli_real_escape_string($con, $itemNameUp);
        $itemQuantityUpd = mysqli_real_escape_string($con, $itemQuantityUp);
        $itemPriceUpd = mysqli_real_escape_string($con, $itemPriceUp);
        $prixTotal = $itemQuantityUpd * $itemPriceUpd;

        $updateQue = "UPDATE item set itemName='$itemNameUpd',prixUnitaire='$itemPriceUpd',quantity='$itemQuantityUpd',prixTotal='$prixTotal' where itemId='$itemId'";
        echo $updateQue;
        $updateQuer = mysqli_query($con, $updateQue) or die(mysqli_error($con));
        if ($updateQuer != 0) {
            echo "Update Succeful";


        }
        mysqli_close($con);
    }
    ?>

