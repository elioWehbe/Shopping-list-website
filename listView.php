<?php
session_start();
include 'config.php';
include 'template.html';
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}
echo "<div class='form-box'>";
if(isset($_GET['itemId'])){
    $itemId=$_GET['itemId'];
    $sql="Delete  from item where itemId='$itemId'";
    mysqli_query($con,$sql);

}

if (isset($_GET['listeId'])){
$listeId=$_GET['listeId'];
$listeI="
SELECT *
FROM item
WHERE listeId='$listeId'
";
$listeIt=mysqli_query($con,$listeI);
while ($listeItem=mysqli_fetch_assoc($listeIt)){
   $listeImage= $listeItem['image'];

echo "<div class='left'> <img src='$listeImage' width='100px'><br>";

    $ItemName=$listeItem['itemName'];
    $itemQuantite=$listeItem['quantity'];
    $itemPrix=$listeItem['prixUnitaire'];
    $totalPriceItem=$listeItem['prixTotal'];
    $itemId=$listeItem['itemId'];

    $itemDate=$listeItem['date'];
    echo "Item Name : $ItemName </br>";
    echo "Item Quantity : $itemQuantite</br>";
    echo "Item Price : $itemPrix $</br>";
    echo "Total Price of items : $totalPriceItem $</br>";
    echo "Date Inserted : $itemDate</br>";
echo "</div>";
echo '<div class=right>';
echo "
<style>

.buttonLink{
    background-color: #6498fe;
    color: white;
    padding: 0;
    text-align: center;
    text-decoration: none;
    
}
</style>
";
  echo "<a href='listView.php?itemId=$itemId' class='buttonLink'>Delete</a><br>";
  echo "<a href='update.php?itemId=$itemId' class='buttonLink'>Update</a><br>";


   echo '</div>';
}
}
?>



