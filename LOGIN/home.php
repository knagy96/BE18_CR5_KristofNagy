<?php

session_start();

if(isset($_SESSION["adm"])) {
    header("Location: dashboard.php");
} elseif(!isset($_SESSION["user"])) {
    header("Location: index.php");
}




require_once "components/db_connect.php";


$sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

$sql ="SELECT * FROM animals";

    $result = mysqli_query($connect, $sql);

    $body = "";
    $nOR = mysqli_num_rows($result);

    if($nOR == 0) {
        $body = "No results";
    } else {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach($rows as $val) {
            $body .= '<div class=" mb-5 col col-12 col-sm-12 col-md-6 col-lg-3 d-flex align-items-stretch">
            <div class="row g-1 container-fluid card shadow-lg bg-card-color">
            <div class="";">
            <img style="width:100%; height:220px; object-fit: cover;" src='.$val["animal_picture"].' class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <h5 class="card-title">'.$val["animal_name"].'</h5>
              <hr>
              <p class="card-text">'.$val["species_of_animal"].'<br> '.$val["location"].'</p>
              <a href="show.php?id='.$val["animal_id"].'" class="m-1 btn btn-warning">Show More Details</a>
              <a href="adopt.php?id='.$val["animal_id"].'" class="m-1 btn btn-primary">Take Me Home</a>
            </div>
            </div>
            </div>
          </div>
          ';
        }
    }
mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?= $row['first_name']; ?></title>
    <?php require_once 'components/boot.php' ?>
    <style>
        .userImage {
            width: 200px;
            height: 200px;
        }

        .hero {
            background: rgb(2, 0, 36);
            background: linear-gradient(24deg, rgba(2, 0, 36, 1) 0%, rgba(0, 212, 255, 1) 100%);
        }
    </style>
</head>
<body>

<?php require_once 'components/navbar.php' ?>

<div class="container">
    <div class="hero shadow">
        <img class="userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
        <p class="text-white" >Hi <?php echo $row['first_name']; ?></p>
    </div>
    <a style="width: 180px;" class="btn btn-danger" href="logout.php?logout">Sign Out</a> <br>
    <a style="width: 180px; margin-top:0.5em; margin-bottom:0.5em;" class="btn btn-primary" href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a>
    <h2 class="text-center m-5">Our Pets whos wants to be adopted</h2>
    <div class="row">
    <?= $body ?>


</div>
</div>
<?php require_once 'components/footer.php' ?>
</body>
</html>

