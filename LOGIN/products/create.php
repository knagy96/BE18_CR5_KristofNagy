<?php
session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../index.php");
}

if(isset($_SESSION["user"])) {

    header("Location:../home.php");
}

?>




<!DOCTYPE html>



<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../components/boot.php'?>
        <title>Add Animal</title>
        <style>
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }       
        </style>
    </head>
    <body>
        <fieldset>
            <legend class='h2'>Add Animal</legend>
            <form action="actions/a_create.php" method= "post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="animal_name"  placeholder="Name" /></td>
                    </tr>    
                    <tr>
                        <th>Age</th>
                        <td><input class='form-control' type="number" name= "animal_age" placeholder="Age" step="any" /></td>
                    </tr>
                    <tr>
                        <th>Species of animal</th>
                        <td><input class='form-control' type="text" name= "species_of_animal" placeholder="" step="any" /></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><input class='form-control' type="text" name= "location" placeholder="location" step="any" /></td>
                    </tr>
                    <tr>
                        <th>Vacinated</th>
                        <td>
                            <select class='form-control' type="number" name= "vacinated" placeholder="" step="any" >
                                <option value="available">Yes</option>
                                <option value="available">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <select class='form-control' type="number" name= "status" placeholder="" step="any" >
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
                        <td><button class='btn btn-success' type="submit">Insert Product</button></td>
                        <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>