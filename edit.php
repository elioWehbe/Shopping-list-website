<?php
session_start();
include 'config.php';
include 'template.html';
error_reporting(0);
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}
$name = $_SESSION['username'];
echo "<h3>Your Lists:</h3>";

echo "<div class='form-box'>";

$sqlId = "SELECT id FROM users WHERE username='$name'";
$executeId = mysqli_query($con, $sqlId);
while ($row = mysqli_fetch_assoc($executeId)) {
    $id = $row['id'];

}
$listQ="SELECT * FROM liste where id='$id' ";

$listQu=mysqli_query($con,$listQ);
while ($listQue=mysqli_fetch_assoc($listQu)) {
    $idList=$listQue['listeId'];
    $nomList=$listQue['nom'];

    $sumQ="SELECT SUM(prixTotal) FROM item WHERE listeId='$idList'";
    $sumQu=mysqli_query($con,$sumQ);
    while ($sumQue=mysqli_fetch_assoc($sumQu)){
        $sumQuery= $sumQue['prixTotal']=$sumQue['SUM(prixTotal)'];

        if($sumQuery>0) {

            echo "<a href='listView.php?listeId=$idList'>";
            echo "$nomList </a>";
            echo "$sumQuery$ ";
            echo "<a href='updateListName.php?listeId=$idList'>Update Liste Name</a>";


        }

        else{
            echo "<a href='listView.php?listeId=$idList'>";
            echo $nomList ."</a>" .":  0$";
            echo "<a href='updateListName.php?listeId=$idList'>Update Liste Name</a>";
        }

    }
echo "<br>";


}
global $idList;
global $nomList;



echo "</div>";
echo "<h3>Freinds Lists :</h3>";
echo "<div class='form-box'>";
$freindQ="SELECT * FROM sharablelist where id='$id'";

$freindQu=mysqli_query($con,$freindQ);
while ($freindQue=mysqli_fetch_assoc($freindQu)){
    $personId=$freindQue['id'];
    $listId=$freindQue['listId'];
    $personIdSharedBy=$freindQue['idShared'];
}
global $personId;
global $listId;
global $personIdSharedBy;
$freindL="SELECT * from liste where listeId='$listId' and id='$personIdSharedBy'";

$freindLi=mysqli_query($con,$freindL) or die(mysqli_error($con));

while ($listOfFreinds=mysqli_fetch_assoc($freindLi)) {

    $freindsListe = $listOfFreinds['nom'];
    $freindListId=$listOfFreinds['listeId'];
}

if($freindListId!=0) {
    echo "<a href='listView.php?listeId=$freindListId'>";
    echo "$freindsListe : ";
    echo '</a>';

    global $freindsListe;


    $totalPriceOfSha = "SELECT SUM(prixTotal) FROM item WHERE listeId='$listId'";

    $totalPriceOfShar = mysqli_query($con, $totalPriceOfSha);
    while ($totalPriceOfShare = mysqli_fetch_assoc($totalPriceOfShar)) {
        $totalPriceOfShare['prixTotal'] = $totalPriceOfShare['SUM(prixTotal)'];
        $priceTo = $totalPriceOfShare['prixTotal'];

        if ($priceTo > 0) {
            echo " $priceTo$";

        } else {
            echo "0$";
        }
    }
}else{
    echo "No List shared yet";
}
?>


</div>