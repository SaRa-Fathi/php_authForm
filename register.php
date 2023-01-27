<?php
$email= $passwd="";
if(!empty($_POST['SignUp']) && isset($_POST['SignUp'])){
    require_once "config.php";
    $sql = "INSERT INTO UserLogin(Email , Passwd)
    VALUES ( ?, ?)";
    $stmt = mysqli_stmt_init($connect);
    if(!mysqli_stmt_prepare($stmt ,$sql))
    {
    die('Could not insert to table: ' . mysqli_error($connect));

    }
    if (empty($_POST["email"])) 
    {
        echo "E-mail is required";
    } 
    else 
    {
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
        {
            $email = $_POST["email"];
        }
        else
        {
            echo "Invalid email format :must be like email@domain.com";
        }
    }
    if (empty($_POST["gender"])) 
    {
        echo "Password is required";
    } 
    else 
    {
        $passwd = $_POST["passwd"];
    }
    
    if(!empty($_POST['email']) && !empty($_POST('passwd')))
    {
        mysqli_stmt_bind_param($stmt , "ss" ,$email ,$passwd);

        if(mysqli_stmt_execute($stmt))
        {
            echo "<div style='border:2px solid red;'><hr>";
            echo "Data inserted to table successfully\n";
            echo "<hr></div>";
            header('Location:login.php');
    exit();
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUpForm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="registerbody">
<div class="container mt-5 ">
<div class="row d-flex justify-content-center align-items-center">
<div class="col-12 col-md-8 col-lg-6 col-xl-5"> 
<div class="login">   
        <form action="#" method="post">
            <h2 class="sr-only">SignUp Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email']))echo $email;?>"></div>
            <div class="form-group"><input class="form-control" type="password" name="passwd" placeholder="Password" value="<?php  if(isset($_POST['passwd'])) echo $passwd;?>"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="SignUp">SignUp</button></div>
            <a href="login.php" class="forgot">Have an account? Login</a>
        </form>
</div>
</div>
</div>    
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>