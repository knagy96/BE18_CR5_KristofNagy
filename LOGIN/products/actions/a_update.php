<?php
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../../index.php");
}

if(isset($_SESSION["user"])) {

    header("Location:../../home.php");
}

if ($_POST) {    
    $animal_name = $_POST['animal_name'];
    $species_of_animal = $_POST['species_of_animal'];
    $animal_age = $_POST['animal_age'];
    $location = $_POST['location'];
    $vacinated = $_POST['vacinated'];
    $status = $_POST['status'];
    $animal_picture = $_POST['animal_picture'];
    $animal_id = $_POST['animal_id'];
    //variable for upload pictures errors is initialised
    $uploadError = '';

    $animal_picture = file_upload($_FILES['animal_picture'], "animals");//file_upload() called  
    if($animal_picture->error===0){
        ($_POST["animal_picture"]=="animal.png")?: unlink("../pictures/$_POST[picture]");           
        $sql = "UPDATE `animals` SET `animal_name` = '$animal_name', `species_of_animal` = '$species_of_animal', `animal_age` = '$animal_age', `location` ='$location', `vacinated`= '$vacinated', `status`= '$status', `animal_picture` = '$animal_picture->fileName'  WHERE animal_id = {$animal_id}";
    }else{
        $sql = "UPDATE `animals` SET `animal_name` = '$animal_name', `species_of_animal` = '$species_of_animal', `animal_age` = '$animal_age', `location` ='$location', `vacinated`= '$vacinated', `status`= '$status',   WHERE animal_id = {$animal_id}";
    }    
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($animal_picture->error !=0)? $animal_picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($animal_picture->error !=0)? $animal_picture->ErrorMessage :'';
    }
    mysqli_close($connect);    
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Update</title>
        <?php require_once '../../components/boot.php'?> 
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Update request response</h1>
            </div>
            <div class="alert alert-<?php echo $class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../update.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
                <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>