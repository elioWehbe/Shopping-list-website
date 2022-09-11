<?php
session_start();
include 'config.php';
include 'template.html';
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}
global $listeId;
if(isset($_GET['listeId'])){
    $listeId=$_GET['listeId'];
    $listQu="
    SELECT *
    FROM liste
    WHERE listeId='$listeId'
    ";
    $listQue=mysqli_query($con,$listQu);
    while ($listQuery=mysqli_fetch_assoc($listQue)) {
        $listeId = $listQuery['listeId'];
        $listeName = $listQuery['nom'];
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
<form method="get" action="updateListName.php">
        <input type="hidden" name="listeId" value="<?php echo $listeId; ?>"> <br>
    List Name : <input type='text' name='listeName' value="<?php echo $listeName;?>" ><br>

        <input type="submit" value="Update" name="sub" class="butt" >
    <?php } ?>
    <?php
    if (isset($_GET['sub'])) {
        echo "tes";
        $listeNameUp = $_GET['listeName'];
        $listeNameUpd = mysqli_real_escape_string($con, $listeNameUp);
        $listeId = $_GET['listeId'];
        $listeIdUpd = mysqli_real_escape_string($con, $listeId);
        $updateQue = "UPDATE 'liste' set nom='$listeNameUpd' where listeId='$listeIdUpd'";
        echo $updateQue;
        $updateQue = mysqli_query($con, $updateQue)or die(mysqli_close($con));
        if ($updateQue != 0) {
            echo "Update Succeful";


        }

mysqli_close($con);
}
?>
</form>
