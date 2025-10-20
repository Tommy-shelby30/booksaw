<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKSAW - Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="login-container">
        <div class="text-center">
            <a href="index.html"><img src="images/main-logo.png" alt="logo"></a>
            <p class="subtitle">Login in to continue</p>
        </div>
        
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" name="submit" class="btn btn-login btn-dark">Login</button>
            

        </form>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("admin/conn.php");
if(isset($_POST["submit"])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "select * from signup where email = '$email' and password = '$password'";
    $run = mysqli_query($conn, $query);
    $totalrows = mysqli_num_rows($run);
    if($totalrows > 0) {
        $_SESSION['email'] = $email;
        header('location:admin/dashboard.php');
    }
    else{
        echo "user not found";
    }
}
?>