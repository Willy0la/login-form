<?php
class Form{

  public function handle(){


    if($_SERVER['REQUEST_METHOD']==="POST"){

      $errors= [];

      if(empty($_POST['user'])){

        $errors[]= "Kindly input your username";
        
      }
      if(empty($_POST['password'])){

        $errors[]= "Kindly input your password";

      }

      $remember = isset($_POST['remember'])?"Remebered":"Not Remembered";   

      if(!empty($errors)){

        foreach($errors as $error){

        echo "<div style='color:red;'> $error</div>";
        }}else{

        $fileName = "user.json";
        $file = fopen('./'. $fileName, 'r');
        $json_Text = '';
        $line = fgets($file);

        while($line!== false){

          $json_Text.= $line;

          $line = fgets($file);
        }

        fclose($file);

        if(empty($json_Text)){

          $contact = [];
        }else{
          $contact = json_decode($json_Text, true);

        }

      $contact[] = [

        "user" => $_POST['user'],
        "password" => $_POST['password'],
        "remember"=> $remember,
        "date" => date("Y-m-d:H-i-s")
      ];

      $json_contact = json_encode($contact);

      $file = fopen('./'. $fileName, 'w');
      fwrite($file,$json_contact);

      fclose($file);
      echo "Data submitted submitted";
       

      }


        }

            }
}

$handle = new Form();

echo$handle->handle();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Willy & Finzy</title>
    <!-- BOXICONS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/styles.css" />
</head>
<body>

<div class="wrapper">
    <form action="" method="post">
        <div class="login-header">
            <span class="">Login</span>
        </div>
        
    <!-- username and password -->

    <?php include("partials/user.php"); ?>

        <div class="remember-forgot">
            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember" />
                <label for="remember">Remember me</label>
            </div>
            <div class="forgot">
                <a href="#">Forgot password?</a>
            </div>
        </div>
        <div class="input_box">
            <input type="submit" class="input-submit" value="Login" />
        </div>
        <div class="register">
            <span>Don't have an account? <a href="register.php">Register</a></span>
        </div>
    </form>
</div>

</body>
</html>
