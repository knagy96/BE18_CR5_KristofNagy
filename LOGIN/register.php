<?php
require_once "components/db_connect.php";
require_once "components/file_upload.php";

session_start();

if(isset($_SESSION["user"])){
    header("Location: home.php");
}
if(isset($_SESSION["adm"])){
    header("Location: dashboard.php");
}

function cleanInput($param) {
    $clean = trim($param);
    $clean = strip_tags($clean);
    $clean = htmlspecialchars($clean);


    return $clean;
}

$fnameError = $lnameError = $emailError = $passwordError = $dateError = $first_name = $last_name = $email ="";


if(isset($_POST["register"])) {
    $error = false;


    $first_name = cleanInput($_POST["first_name"]);
    $last_name = cleanInput($_POST["last_name"]);
    $password = cleanInput($_POST["password"]);
    $email = cleanInput($_POST["email"]);
    $date_of_birth= cleanInput($_POST["date_of_birth"]);


   if(empty($first_name)) {
    $error = true;
    $fnameError= "Please enter your First Name";
   } elseif (strlen($first_name) < 3) {
    $error =true;
    $fnameError = "First name must have at least 3 chars";
   } elseif(!preg_match("/^[a-zA-Z]+$/", $first_name)) {
    $error = true;
    $fnameError= "First name must containe only letter and no spaces";
   }

   if(empty($last_name)) {
    $error = true;
    $lnameError= "Please enter your Last Name";
   } elseif (strlen($last_name) < 3) {
    $error =true;
    $lnameError = "Last name must have at least 3 chars";
   } elseif(!preg_match("/^[a-zA-Z]+$/", $last_name)) {
    $error = true;
    $lnameError= "last name must containe only letter and no spaces";
   }

   if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Please enter a valid email address";
   } else {
    $query = "SELECT email FROM users WHERE email ='$email'";
    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) !=0) {
        $error = true;
        $emailError = "Provided email is already in use.";
    }
   }

   if(empty($date_of_birth)) {
    $error = true;
    $dateError = "Please enter your date of birth.";
   }

   if(empty($password)) {
    $error = true;
    $passwordError = "Please enter password.";
   } elseif (strlen($password) < 6) {
    $error = true;
    $passwordError = "Password must have at least 6 charachters";
   }

   $password = hash("sha256", $password);

   $picture = file_upload($_FILES["picture"]);

   if(!$error) {
    $sql = "INSERT INTO `users`(`first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`) VALUES
     ('$first_name' , '$last_name', '$password' , '$date_of_birth' , '$email' , '$picture->fileName')";
    $res = mysqli_query($connect, $sql);
    if($res) {
        $errType = "success";
        $errMsg = "Successfully registere, you may log in now";
        $uploadError = ($picture ->error !=0) ? $picture -> ErrorMessage : "";
    } else {
        $errType = "danger";
        $errMsg = "Something went wrong try again later";
        $uploadError = ($picture ->error !=0) ? $picture -> ErrorMessage : "";
    }
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "components/boot.php"; ?>
    <title>Document</title> 
</head>
<body>
    
    
    <div class="container">
    <h1 >Registration form</h1>
    <?php 
    if(isset($errMsg)) {
        ?>
<div class="alert alert-<?= $errType  ?>" role="alert">
        <?= $errMsg  ?>
        <?= $uploadError  ?>

    </div>
        <?php
    }
    
    ?>
    
    <form class="w-75" method="POST" action="<?=htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>" enctype="multipart/form-data">
        <input type="text" placeholder="Please type your first name" class="form-control" name="first_name" value="<?= $first_name ?>">
        <span class="text-danger"><?= $fnameError ?></span>
        <input type="text" placeholder="Please type your last name" class="form-control" name="last_name" value="<?= $last_name ?>">
        <span class="text-danger"><?= $lnameError ?></span>
        <input type="email" placeholder="Please type your email" class="form-control" name="email" value="<?= $email ?>">
        <span class="text-danger"><?= $emailError ?></span>
        <input type="password" placeholder="Please type your password" class="form-control" name="password">
        <span class="text-danger"><?= $passwordError ?></span>
        <input type="date"  class="form-control" name="date_of_birth">
        <span class="text-danger"><?= $dateError ?></span>
        <input type="file"  class="form-control" name="picture">
        <input type="submit"  class="form-control" name="register" value="Register">

    </form>
    </div>
</body>
</html>