<?php
session_start();
require_once 'config.php';
function login_redirect(){
    header('Location:home.php?loginSuccess');
    exit();
}
if(isset($_SESSION['email'])){
    login_redirect();
}
$msg=$passwd ='';
if(isset($_POST['submit'])){
    $email =mysqli_real_escape_string($connect ,$_POST['email']);
    $passwd =mysqli_real_escape_string($connect ,$_POST['passwd']);

    if($email == '' || $passwd == ''){
        $msg = "<div class='alert alert-danger alert-dismissible' >
        <a href='#' class = 'close' date-dismiss='alert' aria-label='close'>&times;</a>Email or Password can not be empty! </div>";
    }
    else{
        $sql = $connect ->query("SELECT ID ,Email ,Passwd FROM UserLogin WHERE Email ='$email' ");
        if($sql->num_rows > 0){
            //fetching a user data
            $user = $sql->fetch_array();
            if(password_verify($passwd , $user['passwd'])){

                if(!empty($_POST['email']) && !empty($_POST['passwd'])){
                    setcookie("email" ,$email , time()+30*24*60*60);
                    setcookie("passwd" ,$passwd , time()+30*24*60*60);
                }
                else
                {
                    setcookie("email" , "");
                    setcookie("passwd" , "");
                }
                $email = $_SESSION['email'];
                //log user in
                login_redirect();

            }
            else
            {
                $msg = "<div class='alert alert-danger alert-dismissible' >
                    <a href='#' class = 'close' date-dismiss='alert' aria-label='close'>&times;</a>Wrong Email or Password! </div>";
            }

            
        }
        else
        {
            $msg = "<div class='alert alert-danger alert-dismissible' >
                <a href='#' class = 'close' date-dismiss='alert' aria-label='close'>&times;</a>plz check ur inputs! </div>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginForm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="loginBody">
<body class="registerbody">
<div class="container mt-5 ">
<div class="row d-flex justify-content-center align-items-center">
<div class="col-12 col-md-8 col-lg-6 col-xl-5"> 
    <div class="login">
        <form action="home.php" method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" ></div>
            <div class="form-group"><input class="form-control" type="password" name="passwd" placeholder="Password" ></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="submit">Log In</button></div>
            <a href="register.php" class="forgot">Do not have an account? SignUp</a>
        </form>
    </div>
</div>
</div>
</div>    
</div>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>