<?php
require_once '../components/db_connect.php';


session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../index.php");
}

if(isset($_SESSION["user"])) {

    header("Location:../home.php");
}



if($_GET["id"]) {
    $animal_id = $_GET["id"];
    $sql= "SELECT * FROM animals WHERE animal_id = {$animal_id}";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $animal_name = $data['animal_name'];
        $species_of_animal = $data['species_of_animal'];
        $animal_age = $data['animal_age'];
        $location = $data['location'];
        $vacinated = $data['vacinated'];
        $status = $data['status'];
        $animal_picture = $data['animal_picture'];

        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);


    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Product</title>
        <?php require_once '../components/boot.php'?>
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }  
            .img-thumbnail{
                width: 70px !important;
                height: 70px !important;
            }     
        </style>
    </head>
    <body>
        <fieldset>
            <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='<?php echo  $animal_picture ?>' alt="<?php echo $name ?>"></legend>
            <form action="actions/a_update.php"  method="post" enctype="multipart/form-data">
                <table class="table">
                <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="animal_name"  placeholder="Name" value="<?php echo $animal_name ?>"/></td>
                    </tr>    
                    <tr>
                        <th>Age</th>
                        <td><input class='form-control' type="number" name= "animal_age" placeholder="Age" step="any" value="<?php echo $animal_age ?>" /></td>
                    </tr>
                    <tr>
                        <th>Species of animal</th>
                        <td><input class='form-control' type="text" name= "species_of_animal" placeholder="" step="any" value="<?php echo $species_of_animal ?>"/></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><input class='form-control' type="text" name= "location" placeholder="location" step="any" value="<?php echo $location ?>" /></td>
                    </tr>
                    <tr>
                        <th>Vacinated</th>
                        <td>
                            <select class='form-control' type="number" name= "vacinated" placeholder="" step="any" value="<?php echo $vacinated ?>" >
                                <option value="available">Yes</option>
                                <option value="available">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <select class='form-control' type="number" name= "status" placeholder="" step="any"  value="<?php echo $status ?>">
                                <option value="available">Available</option>
                                <option value="available">Reserved</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Picture</th>
                        <td><input class='form-control' type="file" name="animal_picture" /></td>
                    </tr>
                    
                    <tr>
                        <input type= "hidden" name= "animal_id" value= "<?php echo $data['animal_id'] ?>" />
                        <input type= "hidden" name= "animal_picture" value= "<?php echo $data['animal_picture'] ?>" />
                        <td><button class="btn btn-success" type= "submit">Save Changes</button></td>
                        <td><a href= "index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>