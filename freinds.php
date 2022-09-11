<?php
session_start();
include 'config.php';
include 'template.html';
error_reporting(0);

$username = $_SESSION['username'];

//get the id of user
$sqlId = "SELECT id FROM users WHERE username='$username'";
$executeId = mysqli_query($con, $sqlId);
while ($row = mysqli_fetch_row($executeId)) {
    $id = $row[0];

}
//get the names of the liste for users
echo "<br>";
$queryList = "select * from liste where id='$id'";
$listIdResult = mysqli_query($con, $queryList);
echo "
<form action='freinds.php' method='get'>
<select name='nomList' class='selectF' >";
while ($ligne = mysqli_fetch_assoc($listIdResult)) {
    echo '<option>' . $ligne['nom'] . '</option>';


}echo '</select>';
if(isset($_GET['search'])) {
    $listeName = $_GET['nomList'];
    $name = $_GET['query'];
    $name = htmlspecialchars($name);
    $name = mysqli_real_escape_string($con, $name);
    $raw_results = mysqli_query($con, "SELECT * FROM users
            WHERE (`username` LIKE '%" . $name . "%') ") or die(mysqli_error($con));
    if (mysqli_num_rows($raw_results) > 0) {
        while ($results = mysqli_fetch_array($raw_results)) {

            echo "<p><h3> You shared your liste with" . $results['username'] . "</h3></p>";
            $idpeopleget = $results['id'];



         $sqlQuery = "select * from liste where nom='$listeName' and id='$id'";

       $sqlQuery = mysqli_query($con, $sqlQuery) or die (mysqli_error($con));

           if ($fetch = mysqli_num_rows($sqlQuery) == 1) {
             while ($resulta = mysqli_fetch_array($sqlQuery)) {
                  $listeId = $resulta['listeId'];
;
             }
            }



                $ahowList = "select * from sharablelist where id='$idpeopleget' and listId='$listeId' ";
                $showListQuery = mysqli_fetch_array(mysqli_query($con, $ahowList));
                if ($showListQuery == 0) {
                    if($idpeopleget!=$id) {
                        $sharableList = "insert into sharablelist(id, listId,idShared) values ('$idpeopleget','$listeId','$id')";
                        mysqli_query($con, $sharableList) or die(mysqli_error($con));
                    }else{
                        echo "You cannot share your list with your account";
                    }
                }
        }

    }else{
        echo "0 results";
    }

}

?>


<style>
    .input{
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }
    .selectF{
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        border: 1px solid #C2C2C2;
        box-shadow: 1px 1px 4px #EBEBEB;
        -moz-box-shadow: 1px 1px 4px #EBEBEB;
        -webkit-box-shadow: 1px 1px 4px #EBEBEB;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        padding: 7px;
        margin: 0;
        width: 100%;
        outline: none;
    }
    .but{
        background-color: #6498fe;
        border-radius: 4px;
        border: #1565c0;
        color: white;
        padding: 9px 17px;
        text-decoration: none;
margin: 0;
        width: 100%;
        cursor: pointer;
    }

    </style>
        <br>
        <br>

        <input type="text" name="query" class="input"/>
        <br>
        <br>
        <input type="submit" name="search" value="Search and Share" class=" but"/><br>


    <br>


</form>
