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
    $uploadError = '';
    //this function exists in the service file upload.
    $picture = file_upload($_FILES['animal_picture'], "animal");  
   
    $sql = "INSERT INTO `animals` (`animal_name`, `species_of_animal`, `animal_age`, `location`, `vacinated`, `status`, `animal_picture` ) VALUES ('$animal_name', '$species_of_animal','$animal_age','$location','$vacinated','$status','$animal_picture->fileName')";

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $animal_name </td>
            <td> $species_of_animal </td>
            </tr></table><hr>";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
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
                <h1>Create request response</h1>
            </div>
            <div class="alert alert-<?=$class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>