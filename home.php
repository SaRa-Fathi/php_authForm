<?php
session_start();
if(isset($_SESSION['ID']) && isset($_SESSION['email'])){
    header('Location: login.php');
    exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h6><?php echo $_SESSION['email'] . '  :)'?></h6>
    <a href="logout.php">
        <span><strong>Log Out</strong></span>
    </a>
</body>
</html>
<?php
}
else{
    header("Location: login.php");
    exit();
}
?>