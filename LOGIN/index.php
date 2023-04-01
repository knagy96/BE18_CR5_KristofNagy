<?php
    session_start();

    if(isset($_SESSION["user"])){
        header("Location: home.php");
    }
    if(isset($_SESSION["adm"])){
        header("Location: dashboard.php");
    }

    require_once "components/db_connect.php";

    function cleanInput($param){
        $clean = trim($param);
        $clean = strip_tags($clean);
        $clean = htmlspecialchars($clean);

        return $clean;
    }

    $emailError = $email = $passwordError = "";
    
    if(isset($_POST["btn-login"])){
        $error = false;

        $email = cleanInput($_POST["email"]);
        $password = cleanInput($_POST["password"]);

        if (empty($email)) {
            $error = true;
            $emailError = "Please enter your email address.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "Please enter valid email address.";
        }
      
        if (empty($password)) {
            $error = true;
            $passwordError = "Please enter your password.";
        }

        if(!$error){
            $password = hash("sha256", $password);

            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($connect, $sql);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            if($count == 1){
                if($row["status"] == "adm"){
                    $_SESSION["adm"] = $row["id"];
                    header("Location: dashboard.php");
                }else {
                    $_SESSION["user"] = $row["id"];
                    header("Location: home.php");
                }
            }
        }

    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Registration System</title>
  <?php require_once 'components/boot.php' ?>
</head>

<body>
  <div class="container">
      <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']); ?>" autocomplete="off">
          <h2>Login</h2>
          <hr />
          <?php
          if (isset($errMSG)) {
              echo $errMSG;
          }
          ?>

          <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Your Email" value="<?= $email; ?>" maxlength="40" />
          <span class="text-danger"><?= $emailError; ?></span>

          <input type="password" name="password" class="form-control" placeholder="Your Password" maxlength="15" />
          <span class="text-danger"><?= $passwordError; ?></span>
          <hr />
          <button class="btn btn-block btn-primary" type="submit" name="btn-login">Sign In</button>
          <hr />
          <a href="register.php">Not registered yet? Click here</a>
      </form>
  </div>
</body>
</html>